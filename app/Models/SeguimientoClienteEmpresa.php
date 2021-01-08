<?php

namespace App\Models;



use App\Models\EmpresaCliente;
use App\Models\SeguimientoCliente;
use Illuminate\Database\Eloquent\Model;



class SeguimientoClienteEmpresa extends Model
{

    protected $primaryKey = 'seguimientoClienteEmpresa_id';
    protected $fillable = ['seguimientoClienteEmpresa_id','empresaCliente_id','seguimientoCliente_id','observacion'];


    public function sedeEmpresa()
    {
        return $this->belongsTo(EmpresaCliente::class,'empresaCliente_id');
    }

    public function seguimiento()
    {
        return $this->belongsTo(SeguimientoCliente::class,'seguimientoCliente_id');
    }

    
}
