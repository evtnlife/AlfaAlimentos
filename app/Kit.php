<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $table = 'kits';
    protected $fillable = [
        'id',
        'name',
        'description',
        'cost',
        'price',
        'user_id',
        'branch_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function User(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function Products(){
        return $this->hasMany(KitProduct::class, 'kit_id', 'id')->with('User')->with('Product');
    }
    public function Image(){
        return $this->hasOne(Image::class, 'image_id', 'id');
    }
}
