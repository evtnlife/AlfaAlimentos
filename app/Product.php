<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'cost',
        'quantity',
        'category_id',
        'user_id',
        'provider_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function Category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function Provider(){
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }
    public function Image(){
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
