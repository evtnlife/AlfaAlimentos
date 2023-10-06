<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = [
        'id',
        'uf',
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function Cities(){
        return $this->hasMany(City::class, 'id', 'state_id');
    }
}
