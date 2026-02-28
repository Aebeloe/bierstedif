<?php

use App\Models\Shift;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    Shift::where('end_time', '<', now()->subDays(7))->delete();
})->daily()->description('Delete shifts older than 7 days');
