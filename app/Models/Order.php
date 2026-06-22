<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'email',
        'first_name',
        'last_name',
        'address',
        'city',
        'postal_code',
        'phone',
        'payment_method',
        'subtotal',
        'shipping',
        'total_amount',
        'status',
        'billing_first_name',
        'billing_last_name',
        'billing_address',
        'billing_city',
        'billing_postal_code',
        'billing_phone',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
