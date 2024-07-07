<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['id','title','author_id','category_id','isbn','published_at'];
    public function categories(){
        return $this->belongsTo(Category::class);
    }
    public function authors(){
        return $this->belongsTo(Author::class);
    }
   
}
