<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'order_number',
        'status',
        'grand_total',
        'item_count',
        'first_name',
        'last_name',
        'address',
        'address_2',
        'country',
        'state',
        'city',
        'zip_code',
        'phone',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
