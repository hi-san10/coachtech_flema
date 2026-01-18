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

    public function scopeItemSearch($query, $word)
    {
        return $query->when($word, fn ($q) => $q->where('name', 'Like', '%'.$word.'%'));
    }

    public function scopeNice($query, $auth_id)
    {
        return $query->whereHas('nices', fn ($q) => $q->where('user_id', $auth_id));
    }

    public function scopeExcludeUser($query, $auth_id)
    {
        return $query->when($auth_id, fn ($q) => $q->where('user_id', '!=', $auth_id));
    }
}
