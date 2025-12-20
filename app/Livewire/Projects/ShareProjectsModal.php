<?php

namespace App\Livewire\Projects;

use App\Mail\ProjectInvitationMail;
use App\Models\Project;
use App\Models\ProjectInvitation;
use LivewireUI\Modal\ModalComponent;
use Mail;

class ShareProjectsModal extends ModalComponent
{
    public $projectId;  // Typed property – the package can auto-resolve the full model if you pass just the ID

    public $email;

    // Optional: if you pass the full model or other args, you can handle them here
    public function mount(Project $project = null)
    {
        if ($project) {
            $this->project = $project;
        }
        // If you only pass the ID, the package will auto-fill the typed property
    }

    public function sendInvitation()
    {
        // Now $this->project should be a valid Project instance
        $invitation = ProjectInvitation::create([
            'project_id' => $this->projectId,
            'invited_by_user_id' => auth()->id(),
            'email' => $this->email,
        ]);

        Mail::to($this->email)->send(new ProjectInvitationMail($invitation));

        session()->flash('message', 'Invitation sent successfully!');
        $this->email = ''; // reset form

        $this->closeModal(); // Optional: close the modal after success
    }

    public function render()
    {
        return view('livewire.projects.share-projects-modal');
    }
}