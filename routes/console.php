<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Dumps the database once a day; the command itself also files the dump
// into weekly/ (Sundays) and monthly/ (1st of month) with its own retention.
Schedule::command('db:backup')->dailyAt('01:30')->withoutOverlapping();
