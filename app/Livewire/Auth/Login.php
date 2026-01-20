<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\{Auth, Session};
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.guest')]
#[Title('Login - Ron Logistics')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    /**
     * Validation rules
     */
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    /**
     * Custom validation messages
     */
    protected $messages = [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
    ];

    /**
     * Store the previous URL + demo credentials
     */
    public function mount()
    {
        // Store intended URL
        if (!str_contains(url()->previous(), 'login')) {
            Session::put('url.intended', url()->previous());
        }

        // DEMO ONLY (remove in production)
        if (app()->environment(['local', 'development'])) {
            $this->email = 'admin@gmail.com';
            $this->password = 'section48';
        }
    }

    /**
     * Handle login form submission
     */
    public function login()
    {
        $this->validate();

        if (Auth::attempt(
            ['email' => $this->email, 'password' => $this->password],
            $this->remember
        )) {
            request()->session()->regenerate();

            session()->flash('success', 'Welcome back!');

            return redirect()->intended(route('dashboard'));
        }

        $this->addError('email', 'These credentials do not match our records.');
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.auth.login');
    }
}
