<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';

    protected $fillable = [
        'name',
        'address_id',
        'created_at',
        'altered_at',
        'deleted_at'
    ];
    public function Address(){
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
}
