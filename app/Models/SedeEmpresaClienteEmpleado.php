<?php

namespace App\Models;

use App\Models\CatSexo;
use App\Models\CatEmpleado;
use App\Models\SedeEmpresaCliente;
use Illuminate\Database\Eloquent\Model;

class SedeEmpresaClienteEmpleado extends Model
{

    protected $primaryKey = 'sedeEmpresaEmpleado_id';
    protected $fillable=['sedeEmpresaEmpleado_id','sedeEmpresa_id','catEmpleado_id','sexo_id','nombre','apellido','telefono','email'];
    
    public function catSexo()
    {
        return $this->belongsTo(CatSexo::class,'sexo_id');
    }

    public function catEmpleado()
    {
        return $this->belongsTo(CatEmpleado::class,'catEmpleado_id');
    }

    public function sedeEmpresa()
    {
        return $this->belongsTo(SedeEmpresaCliente::class,'sedeEmpresa_id');
    }
    
}
