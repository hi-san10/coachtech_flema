<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'name',
        'price',
        'detail',
        'image',
        'storage_image'
    ];
}
