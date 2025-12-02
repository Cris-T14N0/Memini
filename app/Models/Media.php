<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'file_name',
        'file_path',
        'file_type',
        'mime_type',
        'file_size',
    ];

    /**
     * Media → belongs to Album
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Shortcut: Media → belongs to Project (through album)
     */
    public function project()
    {
        return $this->album->project ?? null;
    }
}