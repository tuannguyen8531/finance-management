<?php

namespace App\Http\Livewire\Category;

use App\Repositories\CategoryRepository;
use Livewire\Component;
use Illuminate\Validation\Rule;

class CategoryAddLive extends Component
{
    public $name;
    public $type;
    public $description;

    public function rules()
    {
        return [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('message.field_required'),
            'type.required' => __('message.field_required'),
            'description.required' => __('message.field_required'),
        ];
    }

    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.category.add_category');
    }

    public function save()
    {
        $this->validate();

        $input = [
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'id' => 0,
        ];

        $objCategory = new CategoryRepository();
        $result = $objCategory->storeCategory($input);

        return redirect()->route('category')->with([
            'status' => $result['status'],
            'message' => $result['message'],
        ]);
    }
}

    