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
     * Handle login form submission
     */
    public function login()
    {
        // Validate the form inputs
        $this->validate();

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Regenerate session to prevent fixation attacks
            request()->session()->regenerate();

            // Flash success message
            session()->flash('success', 'Welcome back!');

            // Redirect to intended URL or dashboard
            return redirect()->intended(route('dashboard'));
        }

        // If authentication fails, add error to email field
        $this->addError('email', 'These credentials do not match our records.');
    }

    /**
     * Store the previous URL when component mounts
     */
    public function mount()
    {
        // Store the previous URL in the session if it's not the login page
        if (!str_contains(url()->previous(), 'login')) {
            Session::put('url.intended', url()->previous());
        }
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.auth.login');
    }
}