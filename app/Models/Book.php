<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'categories',
        'pages',
        'image',
        'status'
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
