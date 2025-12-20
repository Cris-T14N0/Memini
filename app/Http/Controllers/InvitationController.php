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
            return view('invitations.project-invitation-refused');
        }

        // Mark invitation as accepted
        $invitation->update([
            'user_id'     => Auth::id(),
            'accepted_at'=> now(),
        ]);

        // Attach user to project with default role_id = 1
        $invitation->project->users()->syncWithoutDetaching([
            Auth::id() => [
                // Makes the default role 1 = viewer
                'role_id' => 1,
            ],
        ]);

        // You have successfully joined the project
        return view('invitations.project-invitation-accepted');
    }
}
