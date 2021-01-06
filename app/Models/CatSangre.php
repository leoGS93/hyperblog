<?php

namespace App\Models;

use App\Empleado;
use Illuminate\Database\Eloquent\Model;

class CatSangre extends Model
{
    protected $primaryKey = 'tipoSangre_id';
    protected $fillable=['tipoSangre_id','nombre'];

    // public function empleados(){
    //     return $this->hasMany(Empleado::class);
    // }
}
