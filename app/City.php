<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'name',
        'state_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function State(){
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
