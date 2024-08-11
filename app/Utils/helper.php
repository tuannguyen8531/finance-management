<?php

function getRole($role)
{
    $roles = [
        ROLE_ADMIN => 'Admin',
        ROLE_USER => 'User',
    ];

    return $roles[$role];
}

function getCategoryType($type)
{
    $types = [
        CATEGORY_EXPENDITURE => 'Expenditure',
        CATEGORY_INCOME => 'Income',
        CATEGORY_OTHER => 'Other',
    ];

    return $types[$type];
}