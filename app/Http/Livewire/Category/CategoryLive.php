<?php

namespace App\Http\Livewire\Category;

use App\Repositories\CategoryRepository;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pagination = PER_PAGE;
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $title;


    public function mount()
    {
        $this->title = __('title.list_category');
    }

    public function render()
    {
        $objCategory = new CategoryRepository();
        $categories = $objCategory->getListCategories($this->pagination, $this->sortField, $this->sortDirection);

        return view('livewire.category.list_category', [
            'categories' => $categories,
            'title' => $this->title,
        ]);
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

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }
}