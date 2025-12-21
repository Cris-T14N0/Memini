<?php

namespace App\Livewire\Media;

use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowMediaOnAlbums extends Component
{
    public Album $album;
    public $medias;
    public $project;
    public $userRole;
    public $canUpload = false;
    public $filterType = 'all'; // all, image, video, audio

    public function mount(Album $album)
    {
        $this->album = $album;
        $this->project = $album->project;
        $this->loadMedia();
        $this->checkPermissions();
    }

    #[On('mediaUploaded')]
    #[On('mediaDeleted')]
    public function loadMedia()
    {
        $query = $this->album->media()->latest();

        // Apply filter if not 'all'
        if ($this->filterType !== 'all') {
            $query->where('file_type', $this->filterType);
        }

        $this->medias = $query->get();
    }

    public function setFilter($type)
    {
        $this->filterType = $type;
        $this->loadMedia();
    }

    public function getMediaCountByType($type)
    {
        if ($type === 'all') {
            return $this->album->media()->count();
        }
        return $this->album->media()->where('file_type', $type)->count();
    }

    public function downloadAllMedia()
    {
        try {
            // Get media based on current filter
            $query = $this->album->media();
            
            if ($this->filterType !== 'all') {
                $query->where('file_type', $this->filterType);
            }
            
            $medias = $query->get();

            if ($medias->isEmpty()) {
                session()->flash('error', 'Não há ficheiros para fazer download.');
                return;
            }

            // Create a unique filename for the ZIP
            $zipFileName = \Illuminate\Support\Str::slug($this->album->title) . '-' . now()->format('Y-m-d') . '.zip';
            
            // Create ZIP file
            return response()->streamDownload(function () use ($medias) {
                $zip = new \ZipArchive();
                $zipPath = storage_path('app/temp/' . uniqid() . '.zip');
                
                // Ensure temp directory exists
                if (!file_exists(storage_path('app/temp'))) {
                    mkdir(storage_path('app/temp'), 0755, true);
                }

                if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
                    foreach ($medias as $media) {
                        $filePath = storage_path('app/public/' . $media->file_path);
                        
                        if (file_exists($filePath)) {
                            // Add file to ZIP with original filename
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

    private function checkPermissions()
    {
        $userId = Auth::id();
        
        // Owner can always upload
        if ($this->project->user_id === $userId) {
            $this->canUpload = true;
            $this->userRole = 'owner';
            return;
        }

        // Check if user is a collaborator
        $userProject = $this->project->users()
            ->where('user_id', $userId)
            ->first();

        if ($userProject) {
            $this->userRole = $userProject->pivot->role_id == 1 ? 'viewer' : 'editor';
            $this->canUpload = $userProject->pivot->role_id == 2; // Editor can upload
        } else {
            $this->userRole = null;
            $this->canUpload = false;
        }
    }

    public function render()
    {
        return view('livewire.media.show-media-on-albums');
    }
}