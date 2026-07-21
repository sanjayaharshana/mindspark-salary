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
        DB::statement('ALTER TABLE `promoters` MODIFY COLUMN `identity_card_no` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `promoters` MODIFY COLUMN `phone_no` VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE `promoters` SET `identity_card_no` = '' WHERE `identity_card_no` IS NULL");
        DB::statement("UPDATE `promoters` SET `phone_no` = '' WHERE `phone_no` IS NULL");
        DB::statement('ALTER TABLE `promoters` MODIFY COLUMN `identity_card_no` VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE `promoters` MODIFY COLUMN `phone_no` VARCHAR(255) NOT NULL');
    }
};
