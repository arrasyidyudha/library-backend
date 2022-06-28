<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code', 'title', 'description', 'author', 'publisher', 'city', 'isbn', 'year', 'quantity', 'id_categories'
     ]; 

     public function galleries()
     {
         return $this->hasMany(BookGallery::class, 'id_galleries', 'id');
     }
     
     public function category()
     {
         return $this->belongsTo(BookCategory::class, 'id_categories', 'id');
     }
}
