<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Paises extends Model
{
    protected $primaryKey = 'pais_id';
    protected $fillable = ['pais_id','nombre','prefijo'];

}
