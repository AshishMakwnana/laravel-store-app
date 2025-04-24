<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock'
    ];

    protected $cast = [
        'created_at',
        'updated_at'
    ];

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

   protected  static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->name = Str::title($model->name);
        });
        static::updating(function($model){
            $model->name = Str::title($model->name);
        });
    }
}
