<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Debt extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'debts';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'type',
        'date',
        'due_date',
        'note',
        'status',
    ];

    function getListDebts($input_search, $pagination, $sortField, $sortDirection)
    {
        $result = DB::table($this->table)
        ->join('users', 'debts.user_id', '=', 'users.id')
        ->where('debts.deleted_flg', DELETED_DISABLED)
        ->where('users.deleted_flg', DELETED_DISABLED);
        
        if (!empty($input_search['user'])) {
            $result = $result->where('users.username', 'like', '%' . $input_search['user'] . '%');
        }
        if (!empty($input_search['name'])) {
            $result = $result->where('debts.name', 'like', '%' . $input_search['name'] . '%');
        }
        if (!empty($input_search['type'])) {
            $result = $result->where('debts.type', $input_search['type']);
        }
        if (!empty($input_search['amount_from'])) {
            $result = $result->where('debts.amount', '>=', $input_search['amount_from']);
        }
        if (!empty($input_search['amount_to'])) {
            $result = $result->where('debts.amount', '<=', $input_search['amount_to']);
        }
        if (!empty($input_search['status'])) {
            $result = $result->where('debts.status', $input_search['status']);
        }
        if (!empty($input_search['date_from'])) {
            $result = $result->where('debts.date', '>=', $input_search['date_from']);
        }
        if (!empty($input_search['date_to'])) {
            $result = $result->where('debts.date', '<=', $input_search['date_to']);
        }
        if (!empty($input_search['due_date_from'])) {
            $result = $result->where('debts.due_date', '>=', $input_search['due_date_from']);
        }
        if (!empty($input_search['due_date_to'])) {
            $result = $result->where('debts.due_date', '<=', $input_search['due_date_to']);
        }

        $result = $result->orderBy('debts.' . $sortField, $sortDirection)
        ->select(['debts.*', 'users.username as user_username'])
        ->paginate($pagination);
        
        return $result;
    }

    function getDebtById($id)
    {
        $result = DB::table($this->table)
        ->where('id', $id)
        ->where('deleted_flg', DELETED_DISABLED)
        ->first();
        
        return $result;
    }

    function getListDebtsByUserId($userId, $pagination, $sortField, $sortDirection)
    {
        $result = DB::table($this->table)
        ->where('user_id', $userId)
        ->where('deleted_flg', DELETED_DISABLED)
        ->orderBy($sortField, $sortDirection)
        ->paginate($pagination);

        return $result;
    }

    function getDebtByUserId($userId)
    {
        $result = DB::table($this->table)
        ->where('user_id', $userId)
        ->where('deleted_flg', DELETED_DISABLED)
        ->get();
        
        return $result;
    }

    function insertDebt($data)
    {
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)->insert($data);
    }

    function updateDebt($id, $data)
    {
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }

    function deleteDebt($id)
    {
        $data['deleted_flg'] = DELETED_ENABLED;
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }
}