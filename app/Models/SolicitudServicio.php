<?php

namespace App\Models;


use App\Models\CatServicio;
use App\Models\EmpresaCliente;
use Illuminate\Database\Eloquent\Model;



class SolicitudServicio extends Model
{

    

    protected $primaryKey = 'solicitud_id';
    protected $fillable=['solicitud_id','catServicio_id','empresaCliente_id','fecha','descripcion'];
    
    public function empresa()
    {
        return $this->belongsTo(EmpresaCliente::class,'empresaCliente_id');
    }

    public function catServicio()
    {
        return $this->belongsTo(CatServicio::class,'catServicio_id');
    }

   
}
