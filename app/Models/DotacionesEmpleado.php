<?php

namespace App\Models;


use App\Models\Empleado;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;

class DotacionesEmpleado extends Model
{
    protected $primaryKey = 'id_dotEmpleado';
    protected $fillable=['id_dotEmpleado','id_empleado','id_producto','cantidad','observacion'];

    
    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'id_empleado');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class,'id_producto');
    }
    
}
