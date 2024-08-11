<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function getListUsers()
    {
        $objUser = new User();
        $result = $objUser->getListUsers();

        return $result;
    }

    public function getUserById($id)
    {
        $objUser = new User();
        $result = $objUser->getUserById($id);

        return $result;
    }

    public function getUserByUserName($username)
    {
        $objUser = new User();
        $result = $objUser->getUserByUserName($username);

        return $result;
    }

    public function storeUser($input)
    {
        $objUser = new User();

        $data = [
            'name' => trim($input['name']),
            'username' => trim($input['username']),
            'email' => trim($input['email']),
            'password' => Hash::make($input['password']),
        ];

        if (trim($input['id']) == 0) {
            $objUser->insertUser($data);
            $result = [
                'status' => 'success',
                'message' => __('messages.user_add_success'),
            ];
        } else {
            $objUser->updateUser($input['id'], $data);
            $result = [
                'status' => 'success',
                'message' => __('messages.user_edit_success'),
            ];
        }

        return $result;
    }

    public function deleteUser($id)
    {
        $objUser = new User();
        $objUser->deleteUser($id);

        $result = [
            'status' => 'success',
            'message' => __('messages.user_delete_success'),
        ];

        return $result;
    }
}