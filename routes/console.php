<?php

use App\Jobs\SendSharedAlbumEmail;
use App\Models\SharedLink;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    SharedLink::whereNull('sent_at')
        ->whereNotNull('deliver_at')
        ->where('deliver_at', '<=', now())
        ->chunkById(50, function ($links) {
            foreach ($links as $link) {
                SendSharedAlbumEmail::dispatch($link);
            }
        });
})->everyMinute();