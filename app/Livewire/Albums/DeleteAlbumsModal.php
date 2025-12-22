<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DeleteAlbumsModal extends ModalComponent
{
    public int $albumId;
    public Album $album;

    public function mount(int $albumId): void
    {
        $this->albumId = $albumId;
        
        // Load album with project relationship
        $this->album = Album::with('project')->findOrFail($albumId);

        // Check if user can delete (must be project owner or editor ONLY)
        $project = $this->album->project;
        
        if ($project->user_id !== auth()->id()) {
            $userRole = $project->users()
                ->where('user_id', auth()->id())
                ->first()
                ?->pivot
                ?->role_id;

            // Only Editor (role_id = 2) can delete, not Viewer (role_id = 1)
            if ($userRole !== 2) {
                session()->flash('error', 'Não tens permissão para eliminar este álbum.');
                $this->closeModal();
                return;
            }
        }
    }

    public function deleteAlbum(): void
    {
        try {
            // Delete cover image if exists
            if ($this->album->cover_image_path) {
                Storage::disk('public')->delete($this->album->cover_image_path);
            }

            // Delete all media files from this album
            foreach ($this->album->media as $media) {
                if ($media->file_path && Storage::disk('public')->exists($media->file_path)) {
                    Storage::disk('public')->delete($media->file_path);
                }
            }

            // Delete the album (media records will be cascade deleted)
            $this->album->delete();

            Log::info('Album deleted with ID: ' . $this->albumId);

            session()->flash('message', 'Álbum eliminado com sucesso!');
            $this->dispatch('albumChanged');
            $this->closeModal();

        } catch (\Exception $e) {
            Log::error('Album deletion failed: ' . $e->getMessage());
            session()->flash('error', 'Erro ao eliminar álbum: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.albums.delete-albums-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}