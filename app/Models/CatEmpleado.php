<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CatEmpleado extends Model
{
    protected $primaryKey = 'catEmpleado_id';
    protected $fillable=['catEmpleado_id','nombre','descripcion'];


    // public function empleados(){
    //     return $this->hasMany(Empleado::class);
    // }

}
