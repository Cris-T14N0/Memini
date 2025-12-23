<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SharedLink extends Model
{
    protected $fillable = [
        'user_id',
        'album_id',
        'token',
        'email',
        'message',
        'deliver_at',
        'expires_at',
        'sent_at',
    ];

    protected $casts = [
        'deliver_at' => 'datetime',
        'expires_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($link) {
            if (empty($link->token)) {
                $link->token = Str::random(64);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function isValid()
    {
        return $this->expires_at > now(); // Example
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
