<?php

namespace App\Http\Livewire\User;

use App\Repositories\UserRepository;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UserLiveAdd extends Component {
    public $title;
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
                }),
            ],
            'email' => [
                'required', 
                'email', 
                Rule::unique('users', 'email')->where(function ($query) {
                    return $query->where('deleted_flg', DELETED_DISABLED);
                }),
            ],
            'password' => 'required',
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
            'password.required' => __('msg.field_required'),
        ];
    }

    public function mount() {
        $this->title = __('title.add_user');
    }

    public function render() {
        return view('livewire.user.add_user');
    }

    public function save() {
        $this->validate();

        $input = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'id' => 0,
        ];

        $objUser = new UserRepository();
        $result = $objUser->storeUser($input);

        return redirect()->route('user')->with([
            'status' => $result['status'],
            'message' => $result['message'],
        ]);
    }
}