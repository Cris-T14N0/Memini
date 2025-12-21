<?php

namespace App\Livewire\Media;

use App\Models\Media;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use LivewireUI\Modal\ModalComponent;

class DeleteMediaModal extends ModalComponent
{
    public $mediaId;
    public $media;

    public function mount($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->media = Media::findOrFail($mediaId);

        // Check if user has permission to delete (owner or editor)
        if (!$this->canDeleteMedia()) {
            $this->closeModal();
            session()->flash('error', 'Não tens permissão para eliminar este ficheiro.');
            return;
        }
    }

    private function canDeleteMedia(): bool
    {
        $userId = Auth::id();
        $project = $this->media->album->project;
        
        // Owner can always delete
        if ($project->user_id === $userId) {
            return true;
        }

        // Check if user is a collaborator with Editor role (role_id = 2)
        $userRole = $project->users()
            ->where('user_id', $userId)
            ->first();

        return $userRole && $userRole->pivot->role_id == 2;
    }

    public function deleteMedia()
    {
        try {
            // Delete file from storage
            if ($this->media->file_path && Storage::disk('public')->exists($this->media->file_path)) {
                Storage::disk('public')->delete($this->media->file_path);
                Log::info("Deleted file from storage: {$this->media->file_path}");
            }

            // Delete database record
            $this->media->delete();

            Log::info("Deleted media record ID: {$this->mediaId}");

            session()->flash('success', 'Ficheiro eliminado com sucesso!');
            
            $this->dispatch('mediaDeleted');
            $this->closeModal();

        } catch (Exception $e) {
            Log::error('Media deletion failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Erro ao eliminar ficheiro: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.media.delete-media-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}