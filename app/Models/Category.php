<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function posters()
    {
        return $this->belongsToMany(Poster::class, 'poster_category', 'category_id', 'poster_id');
    }
}
