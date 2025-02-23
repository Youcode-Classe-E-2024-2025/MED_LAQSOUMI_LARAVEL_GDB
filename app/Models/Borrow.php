<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $table = 'borrowings';
    protected $fillable = ['book_id', 'user_id', 'borrowed_at', 'due_date', 'returned_at'];
    public $timestamps = true;

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeBorrowed($query)
    {
        return $query->whereNull('returned_at');
    }

    public static function getAllBorrowings()
    {
        $borrowings = Borrow::all();
        return $borrowings;
    }

    public static function getBorrowingByUserId($user_id)
    {
        return Borrow::with('book')
            ->where('user_id', $user_id)
            ->whereNull('returned_at')
            ->get();
    }
}
