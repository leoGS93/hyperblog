<?php

namespace App\Models;


use App\Models\CatStatu;
use App\Models\CatAcciones;
use App\Models\CatPrioridades;
use App\Models\CatAccionesSiguiente;
use Illuminate\Database\Eloquent\Model;



class SeguimientoCliente extends Model
{

    protected $primaryKey = 'seguimientoCliente_id';
    protected $fillable = ['seguimientoCliente_id','accion_id','status_id','catAccionSiguiente_id','prioridad_id','responsable_id','fechaContacto'];


    public function accionSiguiente()
    {
        return $this->belongsTo(CatAccionesSiguiente::class,'catAccionSiguiente_id');
    }

    public function prioridad()
    {
        return $this->belongsTo(CatPrioridades::class,'prioridad_id');
    }

    public function accion()
    {
        return $this->belongsTo(CatAcciones::class,'accion_id');
    }

    public function Status()
    {
        return $this->belongsTo(CatStatu::class,'status_id');
    }

    

    
}
