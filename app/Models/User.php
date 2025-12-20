<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
            ->withPivot('role_id')
            ->withTimestamps();
    }

    public function projectInvitations()
    {
        return $this->hasMany(ProjectInvitation::class, 'user_id');
    }

    public function sentInvitations()
    {
        return $this->hasMany(ProjectInvitation::class, 'invited_by_user_id');
    }

    /**
     * Check if user can manage members in a project
     * Only project owner (user_id) or users with role_id 1 can manage
     */
    public function canManageProjectMembers($projectId): bool
    {
        $project = Project::find($projectId);
        
        if (!$project) {
            return false;
        }

        // Project owner can always manage
        if ($project->user_id === $this->id) {
            return true;
        }

        // Check if user has admin role (role_id = 1) in this project
        $userProject = $this->projects()
            ->where('projects.id', $projectId)
            ->first();

        return $userProject && $userProject->pivot->role_id == 1;
    }

    /**
     * Get user's role in a specific project
     */
    public function roleInProject($projectId): ?Role
    {
        $projectUser = $this->projects()
            ->where('projects.id', $projectId)
            ->first();

        if (!$projectUser || !$projectUser->pivot->role_id) {
            return null;
        }

        return Role::find($projectUser->pivot->role_id);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}