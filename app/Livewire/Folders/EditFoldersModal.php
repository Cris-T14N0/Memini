<?php

namespace App\Livewire\Folders;

use App\Models\Folder;
use Exception;
use LivewireUI\Modal\ModalComponent;
use Log;

class EditFoldersModal extends ModalComponent
{
    public $folderId;
    public $name = '';
    public $icon = '';

    public array $availableIcons = [
        '🎂', '👥', '💪', '🏖️', '🎄', '🎓', '🏠', '💼', '🎮', '📚', '🎵', '🎨', '⚽', '🍕', '✈️',
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'icon' => 'nullable|string|max:10',
    ];

    protected $messages = [
        'name.required' => 'O nome da pasta é obrigatório.',
        'name.max' => 'O nome não pode ter mais de 255 caracteres.',
    ];

    public function mount($folderId)
    {
        $folder = Folder::findOrFail($folderId);

        $this->folderId = $folder->id;
        $this->name = $folder->name;
        $this->icon = $folder->icon ?? '';
    }

    public function selectIcon($icon)
    {
        $this->icon = $icon;
    }

    public function updateFolder()
    {
        $this->validate();

        try {
            $folder = Folder::findOrFail($this->folderId);

            $folder->update([
                'name' => $this->name,
                'icon' => $this->icon ?: null,
            ]);

            Log::info('Folder updated: ' . $this->name);

            session()->flash('success', 'Pasta atualizada com sucesso!');
            
            $this->dispatch('folderChanged');
            $this->closeModal();

        } catch (Exception $e) {
            Log::error('Folder update failed: ' . $e->getMessage());
            session()->flash('error', 'Erro ao atualizar pasta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.folders.edit-folders-modal');
    }
}