<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class borrowings extends Model
{
    protected $table = 'borrowings';
    protected $fillable = ['book_id', 'user_id', 'borrowed_at', 'returned_at'];
    public $timestamps = true;
    public function book()
    {
        return $this->belongsTo('App\Models\books', 'book_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\users', 'user_id');
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
        return $this->hasMany('App\Models\books', 'book_id');
    }
}
