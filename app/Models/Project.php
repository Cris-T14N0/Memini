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
        'folder_id', 
        'name', 
        'description', 
        'completed', 
        'cover_image_path'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(ProjectInvitation::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('role_id')
            ->withTimestamps();
    }

    /**
     * Get the role for a specific user in this project
     */
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