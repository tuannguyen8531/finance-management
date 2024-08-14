<?php

namespace App\Repositories;

use App\Models\Budget;

class BudgetRepository
{
    public function getListBudgets($input_search, $pagination, $sortField, $sortDirection)
    {
        $objBudget = new Budget();
        $result = $objBudget->getListBudgets($input_search, $pagination, $sortField, $sortDirection);

        return $result;
    }

    public function getBudgetById($id)
    {
        $objBudget = new Budget();
        $result = $objBudget->getBudgetById($id);

        return $result;
    }

    public function getListBudgetsByUserId($userId, $pagination, $sortField, $sortDirection)
    {
        $objBudget = new Budget();
        $result = $objBudget->getListBudgetsByUserId($userId, $pagination, $sortField, $sortDirection);

        return $result;
    }

    public function getBudgetByCategoryId($categoryId)
    {
        $objBudget = new Budget();
        $result = $objBudget->getBudgetByCategoryId($categoryId);

        return $result;
    }   

    public function getBudgetByUserIdAndCategoryId($userId, $categoryId)
    {
        $objBudget = new Budget();
        $result = $objBudget->getBudgetByUserIdAndCategoryId($userId, $categoryId);

        return $result;
    }

    public function getBudgetByUsernameAndCategoryId($username, $categoryId)
    {
        $objBudget = new Budget();
        $result = $objBudget->getBudgetByUsernameAndCategoryId($username, $categoryId);

        return $result;
    }

    public function storeBudget($input)
    {
        $objBudget = new Budget();

        $data = [
            'category_id' => trim($input['category_id']),
            'user_id' => trim($input['user_id']),
            'amount' => trim($input['amount']),
            'period' => trim($input['period']),
            'note' => trim($input['note']),
        ];

        if (trim($input['id']) == 0) {
            $objBudget->insertBudget($data);
            $result = [
                'status' => 'success',
                'message' => __('message.budget_add_success'),
            ];
        } else {
            $objBudget->updateBudget($input['id'], $data);
            $result = [
                'status' => 'success',
                'message' => __('message.budget_edit_success'),
            ];
        }

        return $result;
    }

    public function deleteBudget($id)
    {
        $objBudget = new Budget();
        $objBudget->deleteBudget($id);

        $result = [
            'status' => 'success',
            'message' => __('message.budget_delete_success'),
        ];

        return $result;
    }
}