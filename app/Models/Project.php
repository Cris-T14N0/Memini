<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'name', 'description'];

    protected $with = ['users']; // always load members (tiny overhead, huge convenience)

    // Owner
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // All members (including owner)
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->withPivot('role_id')
                    ->withTimestamps();
    }

    // Albums & medias (you already have these tables)
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    // Invitations
    public function invitations(): HasMany
    {
        return $this->hasMany(ProjectInvitation::class);
    }

    // Helper: current user's role in this project
    public function roleFor(User $user): ?Role
    {
        return $this->users()
                    ->where('user_id', $user->id)
                    ->first()
                    ?->pivot
                    ?->role;
    }

    // Helper: does current user have permission in this project?
    public function userCan(User $user, string $permission): bool
    {
        $role = $this->roleFor($user);
        return $role?->permissions()->where('name', $permission)->exists() ?? false;
    }
}
