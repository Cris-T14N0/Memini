<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class DeleteAlbumsModal extends ModalComponent
{
    public int $albumId;
    public Album $album;

    public function mount(int $albumId): void
    {
        $this->albumId = $albumId;
        
        // Load album with project relationship
        $this->album = Album::with('project')->findOrFail($albumId);
        
        // Check if user can delete (must be project owner or editor)
        $project = $this->album->project;
        
        if ($project->user_id !== auth()->id()) {
            $userRole = $project->users()
                ->where('user_id', auth()->id())
                ->first()
                ?->pivot
                ?->role_id;

            if (!in_array($userRole, [1, 2])) { // 1 = admin, 2 = editor
                session()->flash('error', 'Não tens permissão para eliminar este álbum.');
                $this->closeModal();
            }
        }
    }

    public function deleteAlbum(): void
    {
        // Delete cover image if exists
        if ($this->album->cover_image_path) {
            Storage::disk('public')->delete($this->album->cover_image_path);
        }

        // Delete the album (media will be cascade deleted if configured)
        $this->album->delete();

        session()->flash('message', 'Álbum eliminado com sucesso!');
        
        $this->dispatch('albumChanged');
        $this->closeModal();
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