<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'id',
        'total',
        'cost',
        'discount',
        // ----------------
        // -- payment_type (enum)
        // ----------------
        // AV - A vista
        // CC - Cartão de Crédito
        // PA - Parcelado
        // EP - Entrada + Parcelado
        'payment_type',
        'payment_day',
        'inicial_date',
        'qtd_parcels',
        'user_id',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function Client(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function SaleItems(){
        return $this->hasMany(SaleItem::class, 'id','sale_id');
    }
    public function SalePayments(){
        return $this->hasMany(SalePayment::class, 'sale_id', 'id');
    }
}
