<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository 
{
    public function getListTags($pagination, $sortField, $sortDirection)
    {
        $objTag = new Tag();
        $result = $objTag->getListTags($pagination, $sortField, $sortDirection);

        return $result;
    }

    public function getAllTags()
    {
        $objTag = new Tag();
        $result = $objTag->getAllTags();

        return $result;
    }

    public function getTagById($id)
    {
        $objTag = new Tag();
        $result = $objTag->getTagById($id);

        return $result;
    }

    public function storeTag($input)
    {
        $objTag = new Tag();

        $data = [
            'name' => trim($input['name']),
            'code' => trim($input['code']),
            'description' => trim($input['description']),
        ];

        if (trim($input['id']) == 0) {
            $objTag->insertTag($data);
            $result = [
                'status' => 'success',
                'message' => __('message.tag_add_success'),
            ];
        } else {
            $objTag->updateTag($input['id'], $data);
            $result = [
                'status' => 'success',
                'message' => __('message.tag_edit_success'),
            ];
        }

        return $result;
    }

    public function deleteTag($id)
    {
        $objTag = new Tag();
        $objTag->deleteTag($id);

        $result = [
            'status' => 'success',
            'message' => __('message.tag_delete_success'),
        ];

        return $result;
    }
}