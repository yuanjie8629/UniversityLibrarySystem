<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'book_id', 'start_date', 'borrow_period', 'return_date'];

    //one user can have multiple borrow
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //one book can have multiple borrow
    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    //one borrow can have multiple books
    public function books()
    {
        return $this->belongsToMany('App\Models\Book');
    }
}
