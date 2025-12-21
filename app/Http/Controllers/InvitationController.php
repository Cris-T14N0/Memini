<?php

namespace App\Http\Controllers;

use App\Models\ProjectInvitation;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function accept($token)
    {
        // If not logged in, store token and redirect
        if (! Auth::check()) {
            session(['invitation_token' => $token]);

            return redirect()->route('login');
            // or ->route('register') if you prefer
        }

        $invitation = ProjectInvitation::where('token', $token)->firstOrFail();

        if (! $invitation->isValid()) {
            return view('invitations.project-invitation-refused');
        }

        // Prevent double-accepting
        if ($invitation->accepted_at) {
            return view('invitations.project-invitation-accepted');
        }

        // Accept invitation
        $invitation->update([
            'user_id'      => Auth::id(),
            'accepted_at' => now(),
        ]);

        // Attach user to project (viewer role = 1)
        $invitation->project->users()->syncWithoutDetaching([
            Auth::id() => [
                'role_id' => 1,
            ],
        ]);

        return view('invitations.project-invitation-accepted');
    }
}
