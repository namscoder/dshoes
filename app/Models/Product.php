<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'products';
    protected $fillable =[
        'name',
        'price',
        'image',
        'description',
        'category_id'
    ];
    public function category(){
        return $this->hasMany(Category::class, 'category_id');
    }
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
