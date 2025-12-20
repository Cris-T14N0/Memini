<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class ProjectInvitation extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectInvitationFactory> */
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'project_id',
        'invited_by_user_id',
        'user_id',
        'email',
        'token',
        'accepted_at',
        'expires_at',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invitation) {
            $invitation->token = Str::random(32);
            $invitation->expires_at = now()->addDays(7);
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Helper methods
    public function isValid(): bool
    {
        return is_null($this->accepted_at) && $this->expires_at->isFuture();
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isAccepted(): bool
    {
        return !is_null($this->accepted_at);
    }
}
