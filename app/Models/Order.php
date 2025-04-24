<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'user_id',
        'total_price'
    ];

    protected $casts = [
        'total_price' => 'decimal:2'
    ];

    public function items()  {
        $this->hasMany(OrderItem::class);
    }
}
