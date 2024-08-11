<?php

namespace App\Http\Livewire\User;

use App\Repositories\UserRepository;
use Livewire\Component;

class UserLive extends Component
{
    public $title;

    public function mount()
    {
        $this->title = __('title.list_user');
    }
    public $users;

    public function render()
    {
        $objUser = new UserRepository();
        $this->users = $objUser->getListUsers();

        return view('livewire.user.list_user');
    }
}