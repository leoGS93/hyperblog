<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CatCliente extends Model
{
    
    protected $primaryKey = 'catCliente_id';
    protected $fillable = ['catCliente_id','nombre'];

}
