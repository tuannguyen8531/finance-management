<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Budget extends Model 
{
    use HasFactory, Notifiable;

    protected $table = 'budgets';
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'user_id',
        'amount',
        'period',
        'note',
    ];

    function getListBudgets($input_search, $pagination, $sortField, $sortDirection)
    {
        $result = DB::table($this->table)
        ->join('categories', 'budgets.category_id', '=', 'categories.id')
        ->join('users', 'budgets.user_id', '=', 'users.id')
        ->where('budgets.deleted_flg', DELETED_DISABLED)
        ->where('categories.deleted_flg', DELETED_DISABLED)
        ->where('users.deleted_flg', DELETED_DISABLED);
        
        if (!empty($input_search['category'])) {
            $result = $result->where('categories.id', $input_search['category']);
        }
        if (!empty($input_search['period'])) {
            $result = $result->where('budgets.period', $input_search['period']);
        }
        if (!empty($input_search['user'])) {
            $result = $result->where('users.username', 'like', '%' . $input_search['user'] . '%');
        }
        if (!empty($input_search['amount_from'])) {
            $result = $result->where('budgets.amount', '>=', $input_search['amount_from']);
        }
        if (!empty($input_search['amount_to'])) {
            $result = $result->where('budgets.amount', '<=', $input_search['amount_to']);
        }

        $result = $result->orderBy('budgets.' . $sortField, $sortDirection)
        ->select(['budgets.*', 'categories.name as category_name', 'users.username as user_username'])
        ->paginate($pagination);
        
        return $result;
    }

    function getBudgetById($id)
    {
        $result = DB::table($this->table)
        ->where('id', $id)
        ->where('deleted_flg', DELETED_DISABLED)
        ->first();
        
        return $result;
    }

    function getListBudgetsByUserId($userId, $pagination, $sortField, $sortDirection)
    {
        $result = DB::table($this->table)
        ->join('categories', 'budgets.category_id', '=', 'categories.id')
        ->where('user_id', $userId)
        ->where('budgets.deleted_flg', DELETED_DISABLED)
        ->orderBy('budgets.' . $sortField, $sortDirection)
        ->select(['budgets.*', 'categories.name as category_name'])
        ->paginate($pagination);

        return $result;
    }

    function getBudgetByCategoryId($categoryId)
    {
        $result = DB::table($this->table)
        ->where('category_id', $categoryId)
        ->where('deleted_flg', DELETED_DISABLED)
        ->orderBy('id', 'desc')
        ->get();
        
        return $result;
    }

    function getBudgetByUserIdAndCategoryId($userId, $categoryId)
    {
        $result = DB::table($this->table)
        ->where('user_id', $userId)
        ->where('category_id', $categoryId)
        ->where('deleted_flg', DELETED_DISABLED)
        ->orderBy('id', 'desc')
        ->first();
        
        return $result;
    }

    function getBudgetByUsernameAndCategoryId($username, $categoryId)
    {
        $result = DB::table($this->table)
        ->join('users', 'budgets.user_id', '=', 'users.id')
        ->where('users.username', $username)
        ->where('category_id', $categoryId)
        ->where('budgets.deleted_flg', DELETED_DISABLED)
        ->orderBy('budgets.id', 'desc')
        ->first();
        
        return $result;
    }

    function insertBudget($data)
    {
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)->insert($data);
    }

    function updateBudget($id, $data)
    {
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }

    function deleteBudget($id)
    {
        $data['deleted_flg'] = DELETED_ENABLED;
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }
}