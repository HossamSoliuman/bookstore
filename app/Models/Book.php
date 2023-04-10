<?php

namespace App\Models;

use App\Models\Language as ModelsLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Book extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'price',
        'details',
        'publisher',
        'description',
    ];


    public function authors(){
        return $this->belongsToMany(Author::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function languages(){
        return $this->belongsToMany(ModelsLanguage::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
