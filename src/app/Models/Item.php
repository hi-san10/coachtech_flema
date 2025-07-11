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
        'condition_id',
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

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function nices()
    {
        return $this->hasMany(Nice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
