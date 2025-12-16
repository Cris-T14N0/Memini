<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;

    // ✅ Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'icon',
    ];

    // ✅ A folder can have many projects
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'folder_id');
    }
}
