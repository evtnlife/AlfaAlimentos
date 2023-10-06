<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';
    protected $fillable = [
        'id',
        'name',
        'description',
        'document',
        'document_type',
        'phone',
        'email',
        'responsible',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function User(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
