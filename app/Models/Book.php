<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'cover',
        'isbn',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function findAll()
    {
        return self::all();
    }

    public function findbyId(){
        return self::id();
    }
}
