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
        'brand_name',
        'detail',
        'is_sold',
        'image',
        'storage_image'
    ];

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
