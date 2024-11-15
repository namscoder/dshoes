<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory,SoftDeletes;


    protected $table = 'variants';
    protected $fillable =[
        'product_id',
        'size',
        'price',
        'quantity'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
