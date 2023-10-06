<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class
KitProduct extends Model
{
    protected $table = 'kit_products';
    protected $fillable = [
        'id',
        'product_id',
        'kit_id',
        'quantity',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function Kit(){
        return $this->belongsTo(Kit::class, 'kit_id', 'id');
    }
    public function Product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
