<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable=[
        'number_of_stars',
        'book_id',
        'user_id',
        'review',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
