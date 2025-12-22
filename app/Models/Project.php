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

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'completed',
        'cover_image_path'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('role_id')
            ->withTimestamps();
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(ProjectInvitation::class);
    }

    /**
     * Folders where this project is organized by different users
     */
    public function folderAssignments(): BelongsToMany
    {
        return $this->belongsToMany(Folder::class, 'folder_project_user')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    /**
     * Get the folder for a specific user
     */
    public function folderForUser(int $userId): ?Folder
    {
        return $this->folderAssignments()
            ->wherePivot('user_id', $userId)
            ->first();
    }

    /**
     * Check if in any folder for user
     */
    public function isInFolderForUser(int $userId): bool
    {
        return $this->folderAssignments()
            ->wherePivot('user_id', $userId)
            ->exists();
    }

    public function roleFor(User $user): ?Role
    {
        $projectUser = $this->users()
            ->where('user_id', $user->id)
            ->first();

        if (!$projectUser || !$projectUser->pivot->role_id) {
            return null;
        }

        return Role::find($projectUser->pivot->role_id);
    }
}