<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BackupController extends Controller
{
    private const TYPES = ['daily', 'weekly', 'monthly'];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view backups')->only(['index']);
        $this->middleware('permission:run backups')->only(['run']);
        $this->middleware('permission:download backups')->only(['download']);
    }

    /**
     * Display the backups page, grouped into daily/weekly/monthly.
     */
    public function index()
    {
        $backups = [];

        foreach (self::TYPES as $type) {
            $backups[$type] = $this->listBackups($type);
        }

        return view('admin.backups.index', compact('backups'));
    }

    /**
     * Run the backup command immediately (manual trigger).
     */
    public function run(Request $request)
    {
        try {
            Artisan::call('db:backup');

            return redirect()->route('admin.backups.index')
                ->with('success', 'Backup completed successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.backups.index')
                ->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }

    /**
     * Stream a backup file for download.
     */
    public function download(string $type, string $filename): StreamedResponse
    {
        if (!in_array($type, self::TYPES, true)) {
            abort(404);
        }

        // basename() strips any path traversal attempt (../, absolute paths, etc.)
        $safeFilename = basename($filename);
        $path = storage_path("app/backups/{$type}/{$safeFilename}");

        if (!str_ends_with($safeFilename, '.sql.gz') || !is_file($path)) {
            abort(404);
        }

        return response()->streamDownload(function () use ($path) {
            readfile($path);
        }, $safeFilename, [
            'Content-Type' => 'application/gzip',
        ]);
    }

    /**
     * List backup files of a given type, newest first.
     */
    private function listBackups(string $type): array
    {
        $dir = storage_path("app/backups/{$type}");

        if (!is_dir($dir)) {
            return [];
        }

        $files = collect(glob($dir . '/*.sql.gz'))
            ->map(function (string $path) use ($type) {
                return [
                    'filename'   => basename($path),
                    'size'       => $this->formatBytes(filesize($path)),
                    'created_at' => \Illuminate\Support\Carbon::createFromTimestamp(filemtime($path)),
                    'type'       => $type,
                ];
            })
            ->sortByDesc(fn (array $file) => $file['created_at'])
            ->values()
            ->all();

        return $files;
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
