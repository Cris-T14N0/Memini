<?php

namespace App\Http\Controllers;

use App\Models\SharedLink;

class SharedAlbumController extends Controller
{
    public function show($token)
    {
        $sharedLink = SharedLink::where('token', $token)->firstOrFail();

        if (!$sharedLink->isValid()) {
            return view('shared.expired');
        }

        $album = $sharedLink->album()->with('media')->firstOrFail();

        return view('livewire.shared.show-shared-album', compact('album', 'sharedLink'));
    }
}
