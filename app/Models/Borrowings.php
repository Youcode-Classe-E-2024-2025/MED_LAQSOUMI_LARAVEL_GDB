<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowings extends Model
{
    protected $table = 'borrowings';
    protected $fillable = ['book_id', 'user_id', 'borrowed_at', 'due_date', 'returned_at'];
    public $timestamps = true;

    public function book()
    {
        return $this->belongsTo('App\Models\Books', 'book_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }

    public function scopeBorrowed($query)
    {
        return $query->whereNull('returned_at');
    }

    public function scopeReturned($query)
    {
        return $query->whereNotNull('returned_at');
    }

    public function borrowingsBookById($id)
    {
        return $this->where('book_id', $id)->borrowed()->get();
    }

    public function borrowingsBook()
    {
        return $this->hasMany('App\Models\Books', 'book_id');
    }

    public function borrowingsUserById($id)
    {
        return $this->where('user_id', $id)->borrowed()->get();
    }

    public function borrowingsUser()
    {
        return $this->hasMany('App\Models\Users', 'user_id');
    }
}
