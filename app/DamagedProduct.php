<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamagedProduct extends Model
{
    protected $table = 'damaged_product';
    protected $fillable = [
        'id',
        'quantity',
        'description',
        'user_id',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
