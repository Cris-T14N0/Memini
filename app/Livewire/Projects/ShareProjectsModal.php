<?php

namespace App\Livewire\Projects;

use App\Mail\ProjectInvitationMail;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Mail;

class ShareProjectsModal extends ModalComponent
{
    public $projectId;
    public $project;
    public $email;
    public $selectedRoleId = 1;
    
    public function mount($projectId)
    {
        $this->projectId = $projectId;
        $this->loadProject();
    }

    public function loadProject()
    {
        $this->project = Project::with([
            'users' => function($query) {
                $query->withPivot('role_id');
            },
            'invitations' => function($query) {
                $query->whereNull('accepted_at')
                      ->where('expires_at', '>', now());
            }
        ])->findOrFail($this->projectId);
    }

    public function sendInvitation()
    {
        $this->validate([
            'email' => 'required|email',
            'selectedRoleId' => 'required|exists:roles,id',
        ]);

        $existingUser = User::where('email', $this->email)->first();
        
        if ($existingUser && $this->project->users->contains($existingUser)) {
            session()->flash('error', 'Este utilizador já é membro do projeto.');
            return;
        }

        if ($this->hasPendingInvitation($this->email)) {
            session()->flash('error', 'Já existe um convite pendente para este email.');
            return;
        }

        $invitation = $this->project->invitations()->create([
            'invited_by_user_id' => auth()->id(),
            'email' => $this->email,
            'role_id' => $this->selectedRoleId,
        ]);

        Mail::to($this->email)->send(new ProjectInvitationMail($invitation));

        session()->flash('message', 'Convite enviado com sucesso!');
        $this->reset(['email', 'selectedRoleId']);
        $this->selectedRoleId = 1;
        
        $this->loadProject();
    }

    public function updateMemberRole($userId, $newRoleId)
    {
        if (!$this->canManageMembers()) {
            session()->flash('error', 'Não tens permissão para alterar funções.');
            return;
        }

        // Update the role_id in the pivot table using Eloquent
        $this->project->users()->updateExistingPivot($userId, ['role_id' => $newRoleId]);
        
        session()->flash('message', 'Função atualizada com sucesso!');
        $this->loadProject();
    }

    public function removeMember($userId)
    {
        if (!$this->canManageMembers()) {
            session()->flash('error', 'Não tens permissão para remover membros.');
            return;
        }

        if ($userId == auth()->id()) {
            session()->flash('error', 'Não podes remover-te a ti próprio do projeto.');
            return;
        }

        if ($this->project->user_id == $userId) {
            session()->flash('error', 'Não podes remover o dono do projeto.');
            return;
        }

        $this->project->users()->detach($userId);
        
        session()->flash('message', 'Membro removido com sucesso!');
        $this->loadProject();
    }

    public function cancelInvitation($invitationId)
    {
        $invitation = $this->project->invitations()->find($invitationId);

        if ($invitation) {
            $invitation->delete();
            session()->flash('message', 'Convite cancelado com sucesso!');
            $this->loadProject();
        }
    }

    private function hasPendingInvitation(string $email): bool
    {
        return $this->project->invitations()
            ->where('email', $email)
            ->whereNull('accepted_at')
            ->where('expires_at', '>', now())
            ->exists();
    }

    private function canManageMembers(): bool
    {
        return auth()->user()->canManageProjectMembers($this->projectId);
    }

    public function getRolesProperty()
    {
        return Role::all();
    }

    public function render()
    {
        return view('livewire.projects.share-projects-modal', [
            'roles' => $this->roles,
            'pendingInvitations' => $this->project->invitations,
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }
}