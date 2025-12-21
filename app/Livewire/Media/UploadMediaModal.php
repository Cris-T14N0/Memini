<?php

namespace App\Livewire\Media;

use App\Models\Album;
use App\Models\Media;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class UploadMediaModal extends ModalComponent
{
    use WithFileUploads;

    public $albumId;
    public $files = [];
    public $album;
    public $project;

    protected $rules = [
        'files.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,mp4,avi,mov,wmv,mp3,wav,ogg,aac|max:512000', // 500MB max
    ];

    protected $messages = [
        'files.*.required' => 'Please select at least one file.',
        'files.*.file' => 'The uploaded item must be a valid file.',
        'files.*.mimes' => 'Only images (jpg, jpeg, png, gif, webp), videos (mp4, avi, mov, wmv), and audio (mp3, wav, ogg, aac) are allowed.',
        'files.*.max' => 'Each file cannot exceed 500MB.',
    ];

    public function mount($albumId)
    {
        $this->albumId = $albumId;
        $this->album = Album::findOrFail($albumId);
        $this->project = $this->album->project;

        // Check if user has permission to upload (owner or editor)
        if (!$this->canUploadMedia()) {
            $this->closeModal();
            session()->flash('error', 'Não tens permissão para fazer upload de ficheiros neste álbum.');
            return;
        }
    }

    private function canUploadMedia(): bool
    {
        $userId = Auth::id();
        
        // Owner can always upload
        if ($this->project->user_id === $userId) {
            return true;
        }

        // Check if user is a collaborator with Editor role (role_id = 2)
        $userRole = $this->project->users()
            ->where('user_id', $userId)
            ->first();

        return $userRole && $userRole->pivot->role_id == 2;
    }

    public function uploadMedia()
    {
        $this->validate();

        try {
            // Use the PROJECT OWNER's ID, not the uploader's ID
            $ownerId = $this->project->user_id;
            $uploadedCount = 0;

            foreach ($this->files as $file) {
                // Determine file type
                $mimeType = $file->getMimeType();
                $fileType = $this->determineFileType($mimeType);

                // Generate filename
                $filename = $file->hashName();
                
                // Store in: storage/app/public/{owner_id}/albums/{album_id}/{filename}
                $path = $file->storeAs("{$ownerId}/albums/{$this->albumId}", $filename, 'public');

                // Create media record
                Media::create([
                    'album_id' => $this->albumId,
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $fileType,
                    'mime_type' => $mimeType,
                    'file_size' => $file->getSize(),
                ]);

                $uploadedCount++;
            }

            Log::info("Uploaded {$uploadedCount} files to album {$this->albumId}");

            session()->flash('success', "Foram enviados {$uploadedCount} ficheiro(s) com sucesso!");
            
            $this->dispatch('mediaUploaded');
            $this->closeModal();

        } catch (Exception $e) {
            Log::error('Media upload failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Erro ao enviar ficheiros: ' . $e->getMessage());
        }
    }

    private function determineFileType(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        } elseif (str_starts_with($mimeType, 'video/')) {
            return 'video';
        } elseif (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        }
        
        return 'unknown';
    }

    public function removeFile($index)
    {
        array_splice($this->files, $index, 1);
    }

    public function render()
    {
        return view('livewire.media.upload-media-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
}