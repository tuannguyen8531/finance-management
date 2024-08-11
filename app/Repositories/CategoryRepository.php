<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getListCategories()
    {
        $objCategory = new Category();
        $result = $objCategory->getListCategories();

        return $result;
    }

    public function getCategoryById($id)
    {
        $objCategory = new Category();
        $result = $objCategory->getCategoryById($id);

        return $result;
    }

    public function storeCategory($input)
    {
        $objCategory = new Category();

        $data = [
            'name' => trim($input['name']),
            'description' => trim($input['description']),
            'type' => trim($input['type']),
        ];

        if (trim($input['id']) == 0) {
            $objCategory->insertCategory($data);
            $result = [
                'status' => 'success',
                'message' => __('message.category_add_success'),
            ];
        } else {
            $objCategory->updateCategory($input['id'], $data);
            $result = [
                'status' => 'success',
                'message' => __('message.category_edit_success'),
            ];
        }

        return $result;
    }

    public function deleteCategory($id)
    {
        $objCategory = new Category();
        $objCategory->deleteCategory($id);

        $result = [
            'status' => 'success',
            'message' => __('message.category_delete_success'),
        ];

        return $result;
    }
}