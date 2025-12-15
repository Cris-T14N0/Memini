<?php

namespace App\Livewire\Folders;

use App\Models\Folder;
use Exception;
use LivewireUI\Modal\ModalComponent;
use Log;

class CreateFoldersModal extends ModalComponent
{
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

    public function selectIcon($icon)
    {
        $this->icon = $icon;
    }

    public function createFolder()
    {
        $this->validate();

        // try
        // {
            Folder ::create([
                'name' => $this->name,
                'icon' => $this->icon ?: null,
            ]);

            Log::info('Folder created: ' . $this->name);

            session()->flash('success', 'Pasta criada com sucesso!');
            
            $this->dispatch('folderChanged');
            $this->closeModal();

        // }
        // catch (Exception $e)
        // {
        //     Log::error('Folder creation failed: ' . $e->getMessage());
        //     Log::error('Stack trace: ' . $e->getTraceAsString());
        //     session()->flash('error', 'Erro ao criar pasta: ' . $e->getMessage());
        // }
    }

    public function render()
    {
        return view('livewire.folders.create-folders-modal');
    }
}