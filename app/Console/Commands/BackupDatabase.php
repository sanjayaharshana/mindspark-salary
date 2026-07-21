<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup
        {--daily-keep=2 : Number of daily backups to retain}
        {--weekly-keep=8 : Number of weekly backups to retain}
        {--monthly-keep=12 : Number of monthly backups to retain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump the database and file it into daily/weekly/monthly backup folders with retention';

    public function handle(): int
    {
        $connection = config('database.default');
        $db = config("database.connections.{$connection}");

        if (($db['driver'] ?? null) !== 'mysql') {
            $this->error('Only the mysql driver is supported by this backup command.');
            return self::FAILURE;
        }

        $baseDir = storage_path('app/backups');
        $dailyDir = $baseDir . '/daily';
        $weeklyDir = $baseDir . '/weekly';
        $monthlyDir = $baseDir . '/monthly';

        foreach ([$dailyDir, $weeklyDir, $monthlyDir] as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }

        $timestamp = now()->format('Y-m-d_His');
        $filename = "backup_{$db['database']}_{$timestamp}.sql";
        $sqlPath = $dailyDir . '/' . $filename;

        $this->info('Dumping database...');

        $process = new Process([
            'mysqldump',
            '-h', $db['host'],
            '-P', (string) $db['port'],
            '-u', $db['username'],
            '--single-transaction',
            '--quick',
            '--skip-lock-tables',
            '--no-tablespaces',
            '--set-gtid-purged=OFF',
            '--result-file=' . $sqlPath,
            $db['database'],
        ]);

        // Pass the password via env var so it never appears in the process list.
        if (!empty($db['password'])) {
            $process->setEnv(['MYSQL_PWD' => $db['password']]);
        }
        $process->setTimeout(600);
        $process->run();

        if (!$process->isSuccessful()) {
            if (file_exists($sqlPath)) {
                unlink($sqlPath);
            }
            $this->error('mysqldump failed: ' . $process->getErrorOutput());
            throw new ProcessFailedException($process);
        }

        $this->info('Compressing dump...');

        $gzipProcess = new Process(['gzip', '-f', $sqlPath]);
        $gzipProcess->run();

        if (!$gzipProcess->isSuccessful()) {
            $this->error('gzip failed: ' . $gzipProcess->getErrorOutput());
            throw new ProcessFailedException($gzipProcess);
        }

        $gzPath = $sqlPath . '.gz';
        $gzFilename = $filename . '.gz';

        $this->info('Backup created: ' . $gzFilename . ' (' . $this->formatBytes(filesize($gzPath)) . ')');

        // Also file this dump under weekly/ on Sundays and monthly/ on the 1st of the month.
        if (now()->isSunday()) {
            copy($gzPath, $weeklyDir . '/' . $gzFilename);
            $this->info('Filed as weekly backup.');
        }

        if (now()->day === 1) {
            copy($gzPath, $monthlyDir . '/' . $gzFilename);
            $this->info('Filed as monthly backup.');
        }

        $this->prune($dailyDir, (int) $this->option('daily-keep'));
        $this->prune($weeklyDir, (int) $this->option('weekly-keep'));
        $this->prune($monthlyDir, (int) $this->option('monthly-keep'));

        $this->info('Done.');

        return self::SUCCESS;
    }

    /**
     * Keep only the newest $keep files in $dir, deleting the rest.
     */
    private function prune(string $dir, int $keep): void
    {
        $files = collect(glob($dir . '/*.sql.gz'))
            ->sortByDesc(fn (string $path) => filemtime($path))
            ->values();

        foreach ($files->slice($keep) as $path) {
            unlink($path);
            $this->line('Pruned old backup: ' . basename($path));
        }
    }

    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        $size = $bytes;
        while ($size >= 1024 && $i < count($units) - 1) {
            $size /= 1024;
            $i++;
        }
        return round($size, 2) . ' ' . $units[$i];
    }
}
