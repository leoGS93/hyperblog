<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadosCivile extends Model
{
    protected $primaryKey = 'estadoCivil_id';
    protected $fillable=['estadoCivil_id','nombre'];
}
