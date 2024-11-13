<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class List_Image extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'list_images';
    protected $fillable = [
        'image',
        'book_id'
    ];
}
