<?php

namespace App\Livewire\LandingPage;

use App\Mail\ContactFormMail;
use Livewire\Component;
use Mail;
use RateLimiter;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $question = '';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|max:255',
        'question' => 'required|min:10|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Por favor, insira o seu nome.',
        'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
        'email.required' => 'Por favor, insira o seu email.',
        'email.email' => 'Por favor, insira um email válido.',
        'question.required' => 'Por favor, escreva a sua pergunta.',
        'question.min' => 'A pergunta deve ter pelo menos 10 caracteres.',
        'question.max' => 'A pergunta não pode ter mais de 1000 caracteres.',
    ];

    public function submit()
    {
        $this->validate();

        // Rate limiting: 3 attempts per hour per IP
        $key = 'contact-form:' . request()->ip();
        
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            session()->flash('error', 'Demasiadas tentativas. Por favor, tente novamente em ' . ceil($seconds / 60) . ' minutos.');
            return;
        }

        RateLimiter::hit($key, 3600); // 1 hour

        try {
            Mail::to(config('mail.from.address'))->send(
                new ContactFormMail($this->name, $this->email, $this->question)
            );

            session()->flash('success', 'Mensagem enviada com sucesso! Entraremos em contacto em breve.');
            
            $this->reset(['name', 'email', 'question']);
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao enviar mensagem. Por favor, tente novamente.');
            \Log::error('Contact form error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.landing-page.contact-form');
    }
}
