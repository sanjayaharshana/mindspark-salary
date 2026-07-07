<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            // SQLite uses string columns — no ENUM modification needed
        } else {
            // Rename old 'approved' rows to 'complete'
            DB::statement("UPDATE `salary_sheet` SET `status` = 'complete' WHERE `status` = 'approved'");

            // Set the enum to the final desired set in one step.
            // Including 'approve' here prevents data truncation if rows with that
            // value already exist (added manually before this migration ran).
            DB::statement("ALTER TABLE `salary_sheet` MODIFY COLUMN `status` ENUM('draft', 'complete', 'reject', 'approve', 'paid') NOT NULL DEFAULT 'draft'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            // No-op for SQLite
        } else {
            DB::statement("UPDATE `salary_sheet` SET `status` = 'approved' WHERE `status` = 'complete'");
            DB::statement("UPDATE `salary_sheet` SET `status` = 'draft'    WHERE `status` = 'reject'");
            DB::statement("ALTER TABLE `salary_sheet` MODIFY COLUMN `status` ENUM('draft', 'approved', 'paid') NOT NULL DEFAULT 'draft'");
        }
    }
};
