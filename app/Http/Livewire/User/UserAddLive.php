<?php

namespace App\Http\Livewire\User;

use App\Repositories\UserRepository;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UserAddLive extends Component 
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $balance;

    public function rules()
    {
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
            'balance' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('message.field_required'),
            'username.required' => __('message.field_required'),
            'username.unique' => __('message.username_exist'),
            'email.required' => __('message.field_required'),
            'email.unique' => __('message.email_exist'),
            'email.email' => __('message.email_invalid'),
            'password.required' => __('message.field_required'),
            'balance.required' => __('message.field_required'),
            'balance.numeric' => __('message.field_numeric'),
            'balance.min' => __('message.field_min', ['min' => 0]),
        ];
    }

    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.user.add_user');
    }

    public function save()
    {
        $this->validate();

        $input = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'balance' => $this->balance,
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