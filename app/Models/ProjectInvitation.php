<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInvitation extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectInvitationFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id', 'invited_by_user_id', 'role_id',
        'user_id', 'email', 'token', 'expires_at'
    ];

    protected $dates = ['expires_at', 'accepted_at'];

    public function project() { return $this->belongsTo(Project::class); }
    public function role()    { return $this->belongsTo(Role::class); }
    public function inviter() { return $this->belongsTo(User::class, 'invited_by_user_id'); }
}
