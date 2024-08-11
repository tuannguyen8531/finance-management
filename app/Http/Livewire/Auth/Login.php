<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Repositories\UserRepository;

class Login extends Component
{
    public $username = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function mount()
    {
        if (auth()->guard('user')->user()) {
            return redirect()->intended(route('dashboard'));
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        $credentials = $this->validate();

        $objUserRepository = new UserRepository();
        $user = $objUserRepository->getUserByUserName($credentials['username']);

        if (!$user) {
            $this->addError('username', trans('auth.failed'));
        }

        if (Auth::guard('user')->attempt($credentials, $this->remember)) {
            Auth::guard('user')->login($user, $this->remember);
            return redirect()->intended(route('dashboard'));
        } else {
            $this->addError('password', trans('auth.password'));
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->intended(route('login'));
    }
}