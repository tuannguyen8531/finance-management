<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Category extends Model 
{
    use HasFactory, Notifiable;

    protected $table = 'categories';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'type',
    ];

    function getListCategories($pagination, $sortField, $sortDirection)
    {
        $result = DB::table($this->table)
        ->where('deleted_flg', DELETED_DISABLED)
        ->orderBy($sortField, $sortDirection)
        ->paginate($pagination);
        
        return $result;
    }

    function getAllCategories()
    {
        $result = DB::table($this->table)
        ->where('deleted_flg', DELETED_DISABLED)
        ->get();
        
        return $result;
    }

    function getCategoryById($id)
    {
        $result = DB::table($this->table)
        ->where('id', $id)
        ->where('deleted_flg', DELETED_DISABLED)
        ->first();
        
        return $result;
    }

    function insertCategory($data)
    {
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)->insert($data);
    }

    function updateCategory($id, $data)
    {
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }

    function deleteCategory($id)
    {
        $data['deleted_flg'] = DELETED_ENABLED;
        
        DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }
}