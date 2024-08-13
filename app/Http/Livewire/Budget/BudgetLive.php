<?php

namespace App\Http\Livewire\Budget;

use App\Repositories\BudgetRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BudgetLive extends Component
{
    public $title;
    public $budgets;
    public $categories;
    public $budgetId;
    public $userId;
    public $categoryId;
    public $userUsername;
    public $amount;
    public $period;
    public $note;

    public $input_search = [];
    public $search = [
        'category' => '',
        'period' => '',
        'user' => '',
        'amount_from' => '',
        'amount_to' => '',
    ];

    public function rules()
    {
        $rules = [
            'categoryId' => 'required',
            'amount' => 'required|numeric|min:0',
            'period' => 'required',
        ];

        if (Auth::guard('user')->user()->role == ROLE_ADMIN  && $this->budgetId == 0) {
            $rules['userUsername'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'categoryId.required' => __('message.field_required'),
            'amount.required' => __('message.field_required'),
            'amount.numeric' => __('message.field_numeric'),
            'amount.min' => __('message.field_min'),
            'period.required' => __('message.field_required'),
            'userUsername.required' => __('message.field_required'),
        ];
    }

    public function mount()
    {
        $this->title = __('title.list_budget');
        $this->input_search = $this->search;

        $objCategoryRepository = new CategoryRepository();
        $this->categories = $objCategoryRepository->getListCategories();

        if (Auth::guard('user')->user()->role != ROLE_ADMIN) {
            $this->userId = Auth::guard('user')->user()->id;
        }
    }

    public function render()
    {
        $objBudgetResitory = new BudgetRepository();
        // dd($this->input_search);
        if (Auth::guard('user')->user()->role == ROLE_ADMIN) {
            $this->budgets = $objBudgetResitory->getListBudgets($this->input_search);
        } else {
            $this->budgets = $objBudgetResitory->getBudgetByUserId(Auth::guard('user')->user()->id);
        }

        return view('livewire.budget.list_budget');
    }

    public function delete($id)
    {
        $objBudgetResitory = new BudgetRepository();
        $result = $objBudgetResitory->deleteBudget($id);

        return redirect()->route('budget')->with([
            'status' => $result['status'],
            'message' => $result['message'],
        ]);
    }

    public function store()
    {
        $this->validate();


        $objBudgetResitory = new BudgetRepository();

        $input = [
            'category_id' => $this->categoryId,
            'amount' => $this->amount,
            'period' => $this->period,
            'note' => $this->note,
            'id' => $this->budgetId,
        ];

        if (isset($this->userId)) {
            $input['user_id'] = $this->userId;
        }

        if (!empty($this->userUsername)) {
            $objUserRepository = new UserRepository();
            $user = $objUserRepository->getUserByUsername($this->userUsername);
            if (!$user) {
                $this->addError('userUsername', __('message.user_not_found'));
                return; 
            } else {
                $input['user_id'] = $user->id;
            }
            if ($objBudgetResitory->getBudgetByUsernameAndCategoryId($this->userUsername, $this->categoryId) && $this->budgetId == 0) {
                $this->addError('categoryId', __('message.budget_exist'));
                return; 
            } 
        } else {
            if ($objBudgetResitory->getBudgetByUserIdAndCategoryId($this->userId, $this->categoryId) && $this->budgetId == 0) {
                $this->addError('categoryId', __('message.budget_exist'));
                return; 
            }
        }

        $result = $objBudgetResitory->storeBudget($input);

        return redirect()->route('budget')->with([
            'status' => $result['status'],
            'message' => $result['message'],
        ]);
    }

    public function filter()
    {
        $this->input_search = $this->search;
    }

    public function clear()
    {
        $this->input_search = [
            'category' => '',
            'period' => '',
            'user' => '',
            'amount_from' => '',
            'amount_to' => '',
        ];
    }
}