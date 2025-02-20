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

    public static function findAll()
    {
        return self::all();
    }

    public static function findById($id)
    {
        return self::find($id);
    }

    public static function createBook($data)
    {
        return self::create($data);
    }

    public static function updateBook($id, $data)
    {
        $book = self::find($id);
        if ($book) {
            $book->update($data);
            return $book;
        }
        return null;
    }

    public static function deleteBook($id)
    {
        $book = self::find($id);
        if ($book) {
            $book->delete();
            return true;
        }
        return false;
    }

}
