<?php

namespace App\Http\Livewire\User;

use App\Repositories\UserRepository;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UserLiveDetail extends Component
{
    public $title;
    public $user;
    public $user_id;
    public $name;
    public $username;
    public $email;
    public $password;

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
        ];
    }

    public function messages() {
        return [
            'name.required' => __('msg.field_required'),
            'username.required' => __('msg.field_required'),
            'username.unique' => __('msg.username_exist'),
            'email.required' => __('msg.field_required'),
            'email.unique' => __('msg.email_exist'),
            'email.email' => __('msg.email_invalid'),
        ];
    }

    public function mount($id)
    {
        $this->title = __('title.detail_user');

        $objUser = new UserRepository();
        $this->user_id = $id;
        $this->user = $objUser->getUserById($id);

        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
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