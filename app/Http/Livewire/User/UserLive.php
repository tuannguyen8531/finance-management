<?php

namespace App\Http\Livewire\User;

use App\Repositories\UserRepository;
use Livewire\Component;
use Livewire\WithPagination;

class UserLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pagination = PER_PAGE;
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $title;

    public function mount()
    {
        $this->title = __('title.list_user');
    }

    public function render()
    {
        $objUser = new UserRepository();
        $users = $objUser->getListUsers($this->pagination, $this->sortField, $this->sortDirection);

        return view('livewire.user.list_user', [
            'users' => $users,
            'title' => $this->title,
        ]);
    }

    public function delete($id)
    {
        $objUser = new UserRepository();
        $result = $objUser->deleteUser($id);

        return redirect()->route('user')->with([
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