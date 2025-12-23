<?php

namespace App\Console\Commands;

use App\Mail\SharedAlbumMail;
use App\Models\SharedLink;
use Illuminate\Console\Command;
use Mail;

class SendScheduledSharedLinks extends Command
{
    protected $signature = 'shared-links:send-scheduled';
    protected $description = 'Send scheduled shared album emails';

    public function handle()
    {
        // $links = SharedLink::whereNotNull('deliver_at')
        //     ->where('deliver_at', '<=', now())
        //     ->whereDoesntHave('emailSent') // You might want to add a flag to track if email was sent
        //     ->get();

        // foreach ($links as $link) {
        //     try {
        //         Mail::to($link->email)->send(new SharedAlbumMail($link));
        //         $this->info("Sent email to {$link->email} for album: {$link->album->title}");
                
        //         // Optionally mark as sent by updating deliver_at to null or adding a 'sent' flag
        //         // $link->update(['deliver_at' => null]);
                
        //     } catch (\Exception $e) {
        //         $this->error("Failed to send email to {$link->email}: {$e->getMessage()}");
        //     }
        // }

        // $this->info("Processed {$links->count()} scheduled emails.");
        // return 0;
    }
}
