<?php

namespace App\Http\Livewire\Tag;

use App\Repositories\TagRepository;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;



class TagLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pagination = PER_PAGE;
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $input_search = [];
    public $search = [
        'name' => '',
        'code' => '',
    ];
    public $tagId;
    public $name;
    public $code;
    public $description;

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'code' => 'required',
        ];

        if ($this->tagId != 0) {
            $rules['code'] = [
                Rule::unique('tags', 'code')->where(function ($query) {
                    return $query->where('deleted_flg', DELETED_DISABLED);
                })->ignore($this->tagId),
            ];
        } else {
            $rules['code'] = 'unique:tags,code';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __('message.field_required'),
            'code.required' => __('message.field_required'),
            'code.unique' => __('message.code_exist'),
        ];
    }

    public function mount()
    {
        
    }

    public function render(TagRepository $tagRepository)
    {
        $tags = $tagRepository->getListTags($this->pagination, $this->sortField, $this->sortDirection);

        return view('livewire.tag.list_tag', [
            'tags' => $tags,
        ]);
    }

    public function save(TagRepository $tagRepository)
    {
        $this->validate();

        $input = [
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'id' => $this->tagId,
        ];

        $result = $tagRepository->storeTag($input);

        return redirect()->route('tag')->with([
            'status' => $result['status'],
            'message' => $result['message'],
        ]);
    }

    public function delete($id)
    {
        $objTagRepository = new TagRepository();
        $result = $objTagRepository->deleteTag($id);

        return redirect()->route('tag')->with([
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