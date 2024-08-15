<?php

namespace App\Http\Livewire\Debt;

use App\Repositories\DebtRepository;
use Livewire\Component;
use Livewire\WithPagination;

class DebtLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pagination = PER_PAGE;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    public $input_search = [];
    public $search = [
        'user' => '',
        'name' => '',
        'type' => '',
        'amount_from' => '',
        'amount_to' => '',
        'status' => '',
        'date_from' => '',
        'date_to' => '',
        'due_date_from' => '',
        'due_date_to' => '',
    ];

    public function mount()
    {
        $this->input_search = $this->search;
    }

    public function render()
    {
        $objDebt = new DebtRepository();
        if (auth()->user()->role == ROLE_ADMIN) {
            $debts = $objDebt->getListDebts($this->input_search, $this->pagination, $this->sortField, $this->sortDirection);
        } else {
            $debts = $objDebt->getListDebtsByUserId(auth()->user()->id, $this->pagination, $this->sortField, $this->sortDirection);
        }

        return view('livewire.debt.list_debt', [
            'debts' => $debts,
        ]);
    }

    public function delete($id)
    {
        $objDebt = new DebtRepository();
        $result = $objDebt->deleteDebt($id);

        return redirect()->route('debt')->with([
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

    public function filter()
    {
        $this->input_search = $this->search;
    }

    public function clear()
    {
        $this->input_search = [
            'user' => '',
            'name' => '',
            'type' => '',
            'amount_from' => '',
            'amount_to' => '',
            'status' => '',
            'date_from' => '',
            'date_to' => '',
            'due_date_from' => '',
            'due_date_to' => '',
        ];
    }
}