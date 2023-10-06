<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    protected $table = 'sale_payments';
    protected $fillable = [
        'id',
        'user_id',
        'sale_id',
        'total',
        'dth_payment',
        'payment_type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function Sale(){
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }
}
