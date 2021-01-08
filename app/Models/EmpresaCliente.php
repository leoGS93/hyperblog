<?php

namespace App\Models;


use App\Models\Paises;
use App\Models\CatCliente;
use App\Models\SolicitudServicio;
use App\Models\SedeEmpresaCliente;
use App\Models\EmpresaClienteEmail;
use App\Models\SolicitudCotizaciones;
use App\Models\EmpresaClienteEmpleado;
use App\Models\EmpresaClienteTelefono;
use Illuminate\Database\Eloquent\Model;
use App\Models\SeguimientoClienteEmpresa;


class EmpresaCliente extends Model
{

    

    protected $primaryKey = 'empresaCliente_id';
    protected $fillable=['empresaCliente_id','catCliente_id','pais_id','nombre','nit','direccion','sitioWeb','Observacion'];
    
    public function pais()
    {
        return $this->belongsTo(Paises::class,'pais_id');
    }

    public function catCliente()
    {
        return $this->belongsTo(CatCliente::class,'catCliente_id');
    }

    public function empresaEmails(){
        return $this->hasMany(EmpresaClienteEmail::class,'empresaCliente_id');
    }

    public function empresaTelefonos(){
        return $this->hasMany(EmpresaClienteTelefono::class,'empresa_id');
    }

    public function empleados(){
        return $this->hasMany(EmpresaClienteEmpleado::class,'empresa_id');
    }

    public function empresaSedes(){
        return $this->hasMany(SedeEmpresaCliente::class,'empresaCliente_id');
    }

    public function seguimientosEmpresa(){
        return $this->hasMany(SeguimientoClienteEmpresa::class,'empresaCliente_id');
    }
    
    public function solicitudServicios(){
        return $this->hasMany(SolicitudServicio::class,'empresaCliente_id');
    }

    
    public function solicitudCotizaciones(){
        return $this->hasMany(SolicitudCotizaciones::class,'empresaCliente_id');
    }
}
