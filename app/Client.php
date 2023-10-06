<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'id',
        'name',
        'document',
        'document_type',
        'status',
        'observation',
        'address_id',
        'branch_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function Address(){
        return $this->belongsTo(Address::class, 'address_id', 'id')->with('City');
    }
    public function Branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
    public function Sales(){
        return $this->hasMany(Sale::class, 'client_id', 'id');
    }
}
