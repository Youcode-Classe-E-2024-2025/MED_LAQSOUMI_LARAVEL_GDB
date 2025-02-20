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

    // Define a relationship with the User model (assuming a book belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor for formatted price
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    // Mutator for setting the title attribute
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }
}
