<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Language;
use PharIo\Manifest\Author;

class Book extends Model
{
    use HasFactory;
    public function authors(){
        return $this->belongsToMany(Author::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function languages(){
        return $this->belongsToMany(Language::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
