<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'id',
        'path',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
