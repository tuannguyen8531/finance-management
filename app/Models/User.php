<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

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

    public function getListUsers()
    {
        $result = User::where($this->table . '.deleted_flg', DELETED_DISABLED)
            ->orderBy($this->table . '.id', 'desc')
            ->get();
        
        return $result;
    }

    public function getUserById($id)
    {
        $result = User::where($this->table . '.id', $id)
            ->where($this->table . '.deleted_flg', DELETED_DISABLED)
            ->first();
        
        return $result;
    }

    public function getUserByUserName($username)
    {
        $result = User::where($this->table . '.username', $username)
            ->where($this->table . '.deleted_flg', DELETED_DISABLED)
            ->first();
        
        return $result;
    }
}
