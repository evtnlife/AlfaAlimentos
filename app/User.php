<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'cpf',
        'email',
        'admin',
        'password',
        'branch_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Categories(){
        return $this->hasMany(Category::class, 'id', 'user_id');
    }
    public function Kits(){
        return $this->hasMany(Kit::class, 'id', 'user_id');
    }
    public function KitProducts(){
        return $this->hasMany(KitProduct::class, 'id', 'user_id');
    }
    public function Products(){
        return $this->hasMany(Product::class, 'id', 'user_id');
    }
    public function ProviderDeliveries(){
        return $this->hasMany(ProviderDelivery::class, 'id', 'user_id');
    }
    public function Sales(){
        return $this->hasMany(Sale::class, 'id', 'user_id');
    }
    public function SalePayments(){
        return $this->hasMany(SalePayment::class, 'id', 'user_id');
    }
    public function Branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
