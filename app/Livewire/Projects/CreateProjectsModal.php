<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateProjectsModal extends ModalComponent
{
    public $message = 'Hello from the modal!';
    public function render()
    {
        return view('livewire.projects.create-projects-modal');
    }
}
