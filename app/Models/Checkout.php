<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
protected $table='checkout';
    protected $fillable = [
        
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
}
