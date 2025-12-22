<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'icon',
    ];

    protected $appends = ['projects_count'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Projects assigned to this folder by different users
     */
    public function projectAssignments(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'folder_project_user')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    /**
     * Projects in this folder for the folder owner
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'folder_project_user')
            ->wherePivot('user_id', $this->user_id)
            ->withTimestamps();
    }

    /**
     * Get projects count for this folder (for the folder owner)
     */
    protected function projectsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->projectAssignments()
                ->wherePivot('user_id', $this->user_id)
                ->count()
        );
    }
}