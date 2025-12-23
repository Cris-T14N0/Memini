<?php
namespace App\Livewire\Shared;

use App\Models\SharedLink;
use Livewire\Component;
use Str;
use ZipArchive;

class ShowSharedAlbum extends Component
{
    public $token;
    public SharedLink $sharedLink;
    public $album;
    public $medias;
    public $isExpired = false;

    public function mount($token)
    {
        $this->token = $token;
        
        $this->sharedLink = SharedLink::with('album.media')
            ->where('token', $token)
            ->firstOrFail();

        if (!$this->sharedLink->isValid()) {
            $this->isExpired = true;
            return;
        }

        $this->album = $this->sharedLink->album;
        $this->medias = $this->album->media;
    }

    public function downloadAllMedia()
    {
        try {
            if (!$this->sharedLink->isValid()) {
                session()->flash('error', 'Este link já não é válido.');
                $this->isExpired = true;
                return;
            }

            if ($this->medias->isEmpty()) {
                session()->flash('error', 'Não há ficheiros para download.');
                return;
            }

            $zipFileName = Str::slug($this->album->title) . '-' . now()->format('Y-m-d') . '.zip';
            
            return response()->streamDownload(function () {
                $zip = new ZipArchive();
                $zipPath = storage_path('app/temp/' . uniqid() . '.zip');
                
                // Ensure temp directory exists
                if (!file_exists(storage_path('app/temp'))) {
                    mkdir(storage_path('app/temp'), 0755, true);
                }

                if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                    foreach ($this->medias as $media) {
                        // Use the same path format as the working code
                        $filePath = storage_path('app/public/' . $media->file_path);
                        
                        if (file_exists($filePath)) {
                            $zip->addFile($filePath, $media->file_name);
                        }
                    }
                    
                    $zip->close();
                    
                    // Read and output the ZIP file
                    echo file_get_contents($zipPath);
                    
                    // Clean up temp file
                    unlink($zipPath);
                }
            }, $zipFileName);

        } catch (\Exception $e) {
            \Log::error('Download failed: ' . $e->getMessage());
            session()->flash('error', 'Erro ao fazer download: ' . $e->getMessage());
        }
    }

    public function render()
    {
        if ($this->isExpired) {
            return view('shared.expired-link');
        }
        
        return view('livewire.shared.show-shared-album');
    }
}