<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BookGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_books', 'url',
    ];

    
    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
