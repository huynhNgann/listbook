<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'authors';
    protected $fillable = ['id','name','biography','created_at','updated_at'];
    public function books(){
        return $this->hasMany(Author::class);
    }
}
