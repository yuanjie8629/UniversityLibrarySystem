<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telephone',
    ];

    protected $hidden = [
        'password',
    ];

    public function borrow()
    {
        return $this->hasOne('App\Models\Borrow');
    }

    public function borrows()
    {
        return $this->hasMany('App\Models\Borrow');
    }
}
