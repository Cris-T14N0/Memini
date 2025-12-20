<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

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

    public function hasPermissionInProject($projectId, string $permission): bool
    {
        return $this->projects()
            ->where('projects.id', $projectId)
            ->wherePivot('role_id', '!=', null)
            ->whereHas('pivot.role.permissions', fn($q) => $q->where('name', $permission))
            ->exists();
    }

    public function roleInProject($projectId): ?Role
    {
        return $this->projects()
            ->where('projects.id', $projectId)
            ->first()
            ?->pivot
                ?->role;
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
