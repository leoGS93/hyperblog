<?php

namespace App\Models;

use App\Models\Paises;
use App\Models\EmpresaCliente;
use App\Models\SedeEmpresaClienteEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\SedeEmpresaClienteTelefono;
use App\Models\SeguimientoClienteEmpresaSede;



class SedeEmpresaCliente extends Model
{

    protected $primaryKey = 'sedeEmpresaCliente_id';
    protected $fillable = ['sedeEmpresaCliente_id','empresaCliente_id','pais_id','nombre','direccion','actividad'];

    public function empresaCliente()
    {
        return $this->belongsTo(EmpresaCliente::class,'empresaCliente_id');
    }

    public function pais()
    {
        return $this->belongsTo(Paises::class,'pais_id');
    }

    public function sedeTelefonos(){
        return $this->hasMany(SedeEmpresaClienteTelefono::class,'sedeEmpresa_id');
    }

    public function empresaEmails(){
        return $this->hasMany(SedeEmpresaClienteEmail::class,'sedeEmpresa_id');
    }

    public function seguimientosEmpresa(){
        return $this->hasMany(SeguimientoClienteEmpresaSede::class,'sedeEmpresa_id');
    }
}
