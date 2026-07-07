<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            // Check current enum values — skip if 'approve' is already present
            $col = DB::select("SHOW COLUMNS FROM `salary_sheet` LIKE 'status'");
            if (!empty($col) && str_contains($col[0]->Type, "'approve'")) {
                return;
            }
            DB::statement("ALTER TABLE `salary_sheet` MODIFY COLUMN `status` ENUM('draft', 'complete', 'reject', 'approve', 'paid') NOT NULL DEFAULT 'draft'");
        }
        // For SQLite, no change needed as it uses string type
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("UPDATE `salary_sheet` SET `status` = 'complete' WHERE `status` = 'approve'");
            DB::statement("ALTER TABLE `salary_sheet` MODIFY COLUMN `status` ENUM('draft', 'complete', 'reject', 'paid') NOT NULL DEFAULT 'draft'");
        }
    }
};
