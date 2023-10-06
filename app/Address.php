<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'id',
        'street',
        'district',
        'reference',
        'number',
        'cities_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function City(){
        return $this->belongsTo(City::class, 'cities_id', 'id')->with('State');
    }

}
