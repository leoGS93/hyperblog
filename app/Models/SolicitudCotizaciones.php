<?php

namespace App\Models;


use App\Models\CatCotizaciones;
use Illuminate\Database\Eloquent\Model;



class SolicitudCotizaciones extends Model
{

    

    protected $primaryKey = 'solicitudCotizacion_id';
    protected $fillable=['solicitudCotizacion_id','empresaCliente_id','catCotizacion_id','fecha','descripcion'];
    
    public function empresa()
    {
        return $this->belongsTo(EmpresaCliente::class,'empresaCliente_id');
    }

    public function catCotizacion()
    {
        return $this->belongsTo(CatCotizaciones::class,'catCotizacion_id');
    }

   
}
