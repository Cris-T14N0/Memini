<?php

namespace App\Http\Middleware;

use App\Models\ProjectInvitation;
use Closure;
use DB;
use Illuminate\Http\Request;

class ProcessPendingInvitation
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && session()->has('pending_invitation')) {
            $token = session('pending_invitation');
            
            // ✅ Use transaction to prevent duplicates
            DB::transaction(function () use ($token) {
                $invitation = ProjectInvitation::where('token', $token)
                    ->lockForUpdate() // ✅ Lock row to prevent race condition
                    ->first();

                if ($invitation && 
                    $invitation->isValid() && 
                    $invitation->email === auth()->user()->email) {
                    
                    // ✅ Check if already a member BEFORE attaching
                    $alreadyMember = $invitation->project->users()
                        ->where('user_id', auth()->id())
                        ->exists();
                    
                    if (!$alreadyMember) {
                        // Adiciona ao projeto
                        $invitation->project->users()->attach(auth()->id(), [
                            'role_id' => 2,
                        ]);
                        
                        session()->flash('success', 'Convite aceite! O projeto foi adicionado ao teu dashboard.');
                    }
                    
                    // ✅ Mark as accepted even if already member
                    $invitation->update([
                        'accepted_at' => now(),
                        'user_id' => auth()->id(),
                    ]);
                }
            });
            
            session()->forget('pending_invitation');
        }

        return $next($request);
    }
}
