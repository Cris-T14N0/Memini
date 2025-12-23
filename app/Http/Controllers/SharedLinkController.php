<?php

namespace App\Http\Controllers;

use App\Models\SharedLink;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class SharedLinkController extends Controller
{
    /**
     * Show the shared album page by token
     */
    public function show($token)
    {
        $sharedLink = SharedLink::with('album.media')->where('token', $token)->firstOrFail();

        if ($sharedLink->isExpired()) {
            abort(403, 'This link has expired.');
        }

        $album = $sharedLink->album;
        $media = $album->media; // assuming you have media relationship

        return view('shared-links.show', compact('sharedLink', 'album', 'media'));
    }

    /**
     * Download all album media as a ZIP
     */
    public function downloadZip($token)
    {
        $sharedLink = SharedLink::with('album.media')->where('token', $token)->firstOrFail();

        if ($sharedLink->isExpired()) {
            abort(403, 'This link has expired.');
        }

        $album = $sharedLink->album;
        $mediaFiles = $album->media; // Collection of media

        $zipFileName = 'album-' . $album->id . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        // Ensure temp directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($mediaFiles as $file) {
                $filePath = Storage::path($file->path); // adjust if you store full paths differently
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($filePath));
                }
            }
            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
