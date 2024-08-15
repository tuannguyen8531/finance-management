<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'balance',
        'password',
    ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function getListUsers($pagination, $sortField, $sortDirection)
    {
        $result = User::where($this->table . '.deleted_flg', DELETED_DISABLED)
        ->orderBy($sortField, $sortDirection)
        ->paginate($pagination);
        
        return $result;
    }

    function getUserById($id)
    {
        $result = User::where($this->table . '.id', $id)
        ->where($this->table . '.deleted_flg', DELETED_DISABLED)
        ->first();
        
        return $result;
    }

    function getUserByUserName($username)
    {
        $result = User::where($this->table . '.username', $username)
        ->where($this->table . '.deleted_flg', DELETED_DISABLED)
        ->first();
        
        return $result;
    }

    function insertUser($data)
    {
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)->insert($data);
    }

    function updateUser($id, $data)
    {
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        
        return DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }

    function deleteUser($id)
    {
        $data['deleted_flg'] = DELETED_ENABLED;
        
        DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }
}
