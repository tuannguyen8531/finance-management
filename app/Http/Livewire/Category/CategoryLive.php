<?php

namespace App\Http\Livewire\Category;

use App\Repositories\CategoryRepository;
use Livewire\Component;

class CategoryLive extends Component
{
    public $title;
    public $categories;


    public function mount()
    {
        $this->title = __('title.list_category');
    }

    public function render()
    {
        $objCategory = new CategoryRepository();
        $this->categories = $objCategory->getListCategories();

        return view('livewire.category.list_category');
    }

    public function delete($id)
    {
        $objCategory = new CategoryRepository();
        $result = $objCategory->deleteCategory($id);

        return redirect()->route('category')->with([
            'status' => $result['status'],
            'message' => $result['message'],
        ]);
    }
}