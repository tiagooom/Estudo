<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'stripe_customer_id', 'stripe_payment_method_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

