<?php

namespace App\Jobs;

use App\Mail\SharedAlbumMail;
use App\Models\SharedLink;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSharedAlbumEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public SharedLink $sharedLink;

    public function __construct(SharedLink $sharedLink)
    {
        $this->sharedLink = $sharedLink;
    }

    public function handle(): void
    {
        // Prevent double sending
        if ($this->sharedLink->sent_at) return;

        Mail::to($this->sharedLink->email)
            ->send(new SharedAlbumMail($this->sharedLink));

        $this->sharedLink->update([
            'sent_at' => now(),
        ]);
    }
}
