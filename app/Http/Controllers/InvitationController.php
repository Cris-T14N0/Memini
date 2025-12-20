<?php

namespace App\Http\Controllers;

use App\Models\ProjectInvitation;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function accept($token)
    {
        $invitation = ProjectInvitation::where('token', $token)->firstOrFail();

        if (! $invitation->isValid()) {
            return 'Invitation is invalid or expired.';
        }

        // Mark invitation as accepted
        $invitation->update([
            'user_id'     => Auth::id(),
            'accepted_at'=> now(),
        ]);

        // Attach user to project with default role_id = 1
        $invitation->project->users()->syncWithoutDetaching([
            Auth::id() => [
                'role_id' => 1,
            ],
        ]);

        return 'You have successfully joined the project!';
    }
}
