<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
    ];

    /**
     * An album belongs to a project.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * An album has many media files.
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
