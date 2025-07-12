<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'buyer_id',
        'seller_id',
        'is_completion'
    ];

    public function transaction_messages()
    {
        return $this->hasMany(TransactionMessage::class)
            ->orderBy('created_at', 'asc');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }
}
