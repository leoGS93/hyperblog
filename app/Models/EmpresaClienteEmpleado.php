<?php

namespace App\Models;


use App\Models\CatSexo;
use App\Models\CatEmpleado;
use App\Models\EmpresaCliente;
use Illuminate\Database\Eloquent\Model;

class EmpresaClienteEmpleado extends Model
{
    
    protected $primaryKey = 'empresaClienteEmpleado_id';
    protected $fillable=['empresaClienteEmpleado_id','empresa_id','catEmpleado_id','sexo_id','nombre','apellido','telefono','email'];
    
    public function catSexo()
    {
        return $this->belongsTo(CatSexo::class,'sexo_id');
    }

    public function catEmpleado()
    {
        return $this->belongsTo(CatEmpleado::class,'catEmpleado_id');
    }

    public function empresaCliente()
    {
        return $this->belongsTo(EmpresaCliente::class,'empresa_id');
    }
    
}
