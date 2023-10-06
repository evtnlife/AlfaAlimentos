<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'description',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
