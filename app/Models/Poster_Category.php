<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster_Category extends Model
{
    use HasFactory;

    protected $table = 'poster_category';

    protected $primaryKey = ['poster_id', 'category_id'];

    public $incrementing = false;

    protected $fillable = [
        'poster_id',
        'category_id',
    ];

    public function poster()
    {
        return $this->belongsTo(Poster::class, 'poster_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
