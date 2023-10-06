<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'sale_items';
    protected $fillable = [
        'id',
        'sale_id',
        'product_id',
        'kit_id',
        'quantity',
        'item_cost',
        'item_price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function Product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function Kit(){
        return $this->belongsTo(Kit::class, 'kit_id', 'io');
    }
    public function Sale(){
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }
}
