<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Tag extends Model 
{
    use HasFactory, Notifiable;

    protected $table = 'tags';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    function getListTags($pagination, $sortField, $sortDirection)
    {
        $result = DB::table($this->table)
        ->where('deleted_flg', DELETED_DISABLED)
        ->orderBy($sortField, $sortDirection)
        ->paginate($pagination);
        
        return $result;
    }

    function getAllTags()
    {
        $result = DB::table($this->table)
        ->where('deleted_flg', DELETED_DISABLED)
        ->orderBy('name', 'asc')
        ->get();
        
        return $result;
    }

    function getTagById($id)
    {
        $result = DB::table($this->table)
        ->where('id', $id)
        ->where('deleted_flg', DELETED_DISABLED)
        ->first();
        
        return $result;
    }

    function insertTag($data)
    {
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)->insert($data);
    }

    function updateTag($id, $data)
    {
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }

    function deleteTag($id)
    {
        $data['deleted_flg'] = DELETED_ENABLED;
        
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }
}