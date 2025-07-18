<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'message',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
