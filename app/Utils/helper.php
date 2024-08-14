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

function getTransactionType($type)
{
    $types = [
        TRANSACTION_EXPENDITURE => 'Expenditure',
        TRANSACTION_INCOME => 'Income',
    ];

    return $types[$type];
}

function getPeriodType($type)
{
    $types = [
        PERIOD_DAY => 'Daily',
        PERIOD_WEEK => 'Weekly',
        PERIOD_MONTH => 'Monthly',
        PERIOD_YEAR => 'Annually',
        PERIOD_ONETIME => 'One-time',
    ];

    return $types[$type];
}