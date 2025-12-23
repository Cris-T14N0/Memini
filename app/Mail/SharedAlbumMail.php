<?php

namespace App\Mail;

use App\Models\SharedLink;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SharedAlbumMail extends Mailable
{
    use Queueable, SerializesModels;

    public SharedLink $sharedLink;

    public function __construct(SharedLink $sharedLink)
    {
        $this->sharedLink = $sharedLink;
    }

    public function build()
    {
        return $this
        ->subject('Álbum Partilhado')
        ->view('emails.shared-album');
    }
}
