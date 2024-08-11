<?php

namespace App\Repositories;

use App\Models\User;

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

    public function createUser($data)
    {
        $objUser = new User();
        $result = $objUser->createUser($data);

        return $result;
    }
}