<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'post_code',
        'address',
        'building_name'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

}
