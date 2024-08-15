<?php

namespace App\Http\Livewire\Category;

use App\Repositories\CategoryRepository;
use Livewire\Component;

class CategoryLiveDetail extends Component
{
    public $category;
    public $name;
    public $type;
    public $description;

    public function rules() {
        return [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => __('message.field_required'),
            'type.required' => __('message.field_required'),
            'description.required' => __('message.field_required'),
        ];
    }

    public function mount($id)
    {
        $objCategory = new CategoryRepository();
        $this->category = $objCategory->getCategoryById($id);
        if (!$this->category) {
            abort(404);
        }

        $this->name = $this->category->name;
        $this->type = $this->category->type;
        $this->description = $this->category->description;
    }

    public function render()
    {
        return view('livewire.category.edit_category');
    }

    public function save()
    {
        $this->validate();

        $input = [
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'id' => $this->category->id,
        ];

        $objCategory = new CategoryRepository();
        $result = $objCategory->storeCategory($input);

        return redirect()->route('category')->with([
            'status' => $result['status'],
            'message' => $result['message'],
        ]);
    }
}