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

    protected $fillable = ['user_id', 'folder_id' , 'name', 'description', 'completed', 'cover_image_path'];

    // Owner
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // To what folder it belongs to
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    // All members (including owner)
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('role_id')
            ->withTimestamps();
    }

    // Albums & medias
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
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
}
