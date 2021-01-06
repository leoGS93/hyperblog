<?php

namespace App\Models;

use App\Empleado;
use Illuminate\Database\Eloquent\Model;

class CatTelefono extends Model
{
    
    protected $primaryKey = 'catTelefono_id';
    protected $fillable=['catTelefono_id','nombre'];

}
