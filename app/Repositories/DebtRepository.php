<?php

namespace App\Repositories;

use App\Models\Debt;

class DebtRepository
{
    public function getListDebts($input_search, $pagination, $sortField, $sortDirection)
    {
        $objDebt = new Debt();
        $result = $objDebt->getListDebts($input_search, $pagination, $sortField, $sortDirection);

        return $result;
    }

    public function getDebtById($id)
    {
        $objDebt = new Debt();
        $result = $objDebt->getDebtById($id);

        return $result;
    }

    public function getAllDebts()
    {
        $objDebt = new Debt();
        $result = $objDebt->getAllDebts();

        return $result;
    }

    public function getListDebtsByUserId($userId, $pagination, $sortField, $sortDirection)
    {
        $objDebt = new Debt();
        $result = $objDebt->getListDebtsByUserId($userId, $pagination, $sortField, $sortDirection);

        return $result;
    }

    public function getDebtByUserId($userId)
    {
        $objDebt = new Debt();
        $result = $objDebt->getDebtByUserId($userId);

        return $result;
    }

    public function storeDebt($input)
    {
        $objDebt = new Debt();

        $data = [
            'user_id' => trim($input['user_id']),
            'name' => trim($input['name']),
            'amount' => trim($input['amount']),
            'type' => trim($input['type']),
            'date' => trim($input['date']),
            'due_date' => trim($input['due_date']),
            'note' => trim($input['note']),
            'status' => trim($input['status']),
        ];

        if (trim($input['id']) == 0) {
            $objDebt->insertDebt($data);
            $result = [
                'status' => 'success',
                'message' => __('message.debt_add_success'),
            ];
        } else {
            $objDebt->updateDebt($input['id'], $data);
            $result = [
                'status' => 'success',
                'message' => __('message.debt_edit_success'),
            ];
        }

        return $result;
    }

    public function deleteDebt($id)
    {
        $objDebt = new Debt();
        $objDebt->deleteDebt($id);

        $result = [
            'status' => 'success',
            'message' => __('message.debt_delete_success'),
        ];

        return $result;
    }
}