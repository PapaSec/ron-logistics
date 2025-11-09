<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    public function login()
    {
        //
    }

    public function mount()
    {
        // Store the preb=vious URL in the session if it's not the login page.
        if (!str_contains(url()->previous(), 'login')) {
            Session::put('url.intended', url()->previous());
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
