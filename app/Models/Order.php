<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'product_name',
        'quantity',
        'unit_price',
        'customer_name',
        'address',
        'phone_number',        
    ];

    protected $dates = ['deleted_at'];

    public function user()
  {
    return $this->belongsTo(User::class);
  }
}
