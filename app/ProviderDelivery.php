<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderDelivery extends Model
{
    protected $table = 'provider_deliveries';
    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'provider_id',
        'cost',
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function Product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function Provider(){
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }
}
