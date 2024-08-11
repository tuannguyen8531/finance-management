<?php

namespace App\Http\Livewire\User;

use App\Repositories\UserRepository;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UserLiveDetail extends Component
{
    public $title;
    public $user;
    public $name;
    public $username;
    public $email;
    public $password;
    public $balance;

    public function rules() {
        return [
            'name' => 'required',
            'username' => [
                'required', 
                Rule::unique('users', 'username')->where(function ($query) {
                    return $query->where('deleted_flg', DELETED_DISABLED);
                })->ignore($this->user->id),
            ],
            'email' => [
                'required', 
                'email', 
                Rule::unique('users', 'email')->where(function ($query) {
                    return $query->where('deleted_flg', DELETED_DISABLED);
                })->ignore($this->user->id),
            ],
            'password' => '',
            'balance' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => __('message.field_required'),
            'username.required' => __('message.field_required'),
            'username.unique' => __('message.username_exist'),
            'email.required' => __('message.field_required'),
            'email.unique' => __('message.email_exist'),
            'email.email' => __('message.email_invalid'),
            'balance.required' => __('message.field_required'),
        ];
    }

    public function mount($id)
    {
        $this->title = __('title.detail_user');

        $objUser = new UserRepository();
        $this->user = $objUser->getUserById($id);

        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->balance = $this->user->balance;
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.user.edit_user');
    }

    public function save() {
        $this->validate();

        $input = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password ?? null,
            'balance' => $this->balance,
            'id' => $this->user->id,
        ];

        $objUser = new UserRepository();
        $result = $objUser->storeUser($input);

        return redirect()->route('user')->with([
            'status' => $result['status'],
            'message' => $result['message'],
        ]);
    }
}