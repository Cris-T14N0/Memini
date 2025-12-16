<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'icon',
    ];

    // Owner of the folder
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // A folder can have many projects
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'folder_id');
    }
}