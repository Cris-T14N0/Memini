<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon'];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'folder_project')
            ->withTimestamps();
    }
}