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
    public $balance;
    public $password;
    public $newPassword;
    public $confirmPassword;

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
            'balance' => 'required',
            'password' => 'nullable|min:3|max:16',
            'newPassword' => 'nullable|min:3|max:16',
            'confirmPassword' => 'nullable|same:newPassword',
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
            'password.min' => __('message.password_min'),
            'password.max' => __('message.password_max'),
            'newPassword.min' => __('message.password_min'),
            'newPassword.max' => __('message.password_max'),
            'confirmPassword.same' => __('message.password_confirm'),
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

        if (isset($this->newPassword) && !empty($this->newPassword)) {
            if (empty($this->password) || !password_verify($this->password, $this->user->password)) {
                return redirect()->route('user.detail', ['id' => $this->user->id])->with([
                    'status' => 'danger',
                    'message' => __('message.password_confirm'),
                ]);
            }

            $this->password = $this->newPassword;
        }

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