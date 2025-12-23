<?php

namespace App\Livewire\Albums;


use App\Mail\SharedAlbumMail;
use App\Models\Album;
use App\Models\SharedLink;
use Auth;
use LivewireUI\Modal\ModalComponent;
use Mail;
use App\Jobs\SendSharedAlbumEmail;

class ShareAlbumModal extends ModalComponent
{
    public $albumId;
    public $album;
    public $email;
    public $message = '';
    public $deliverAt = null;
    public $expiresAt = null;
    public $sendImmediately = true;

    public function mount($albumId)
    {
        $this->albumId = $albumId;
        $this->loadAlbum();
        
        // Set default expiration to 30 days from now
        $this->expiresAt = now()->addDays(30)->format('Y-m-d');
    }

    public function loadAlbum()
    {
        $this->album = Album::with('project')->findOrFail($this->albumId);
        
        // Verify user has access
        $userId = Auth::id();
        $isOwner = $this->album->project->user_id === $userId;
        $isCollaborator = $this->album->project->users()->where('user_id', $userId)->exists();
        
        if (!$isOwner && !$isCollaborator) {
            abort(403, 'Não tens acesso a este álbum.');
        }
    }

    public function updatedSendImmediately($value)
    {
        if ($value) {
            $this->deliverAt = null;
        } else {
            // Set default to tomorrow
            $this->deliverAt = now()->addDay()->format('Y-m-d\TH:i');
        }
    }

    public function shareAlbum()
    {
        $rules = [
            'email' => 'required|email',
            'message' => 'nullable|string|max:1000',
            'expiresAt' => 'nullable|date|after:today',
        ];

        if (!$this->sendImmediately) {
            $rules['deliverAt'] = 'required|date|after:now';
        }

        $this->validate($rules, [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Por favor, insere um email válido.',
            'message.max' => 'A mensagem não pode exceder 1000 caracteres.',
            'deliverAt.required' => 'Por favor, seleciona uma data e hora para envio.',
            'deliverAt.after' => 'A data de envio deve ser no futuro.',
            'expiresAt.after' => 'A data de expiração deve ser após hoje.',
        ]);

        try {
            // Create shared link
            $sharedLink = SharedLink::create([
                'user_id' => Auth::id(),
                'album_id' => $this->albumId,
                'email' => $this->email,
                'message' => $this->message ?: null,
                'deliver_at' => $this->sendImmediately ? now() : $this->deliverAt,
                'expires_at' => $this->expiresAt ? $this->expiresAt . ' 23:59:59' : null,
            ]);

            // Send email immediately if requested
            if ($this->sendImmediately) {
                SendSharedAlbumEmail::dispatch($sharedLink);
                session()->flash('message', 'Email enviado com sucesso!');
            }
            else {
                // Email will be sent by scheduled task
                session()->flash('message', 'Email agendado para ' . \Carbon\Carbon::parse($this->deliverAt)->format('d/m/Y H:i'));
            }

            $this->closeModal();

        } catch (\Exception $e) {
            \Log::error('Failed to share album: ' . $e->getMessage());
            session()->flash('error', 'Erro ao partilhar álbum: ' . $e->getMessage());
        }
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.albums.share-album-modal');
    }
}
