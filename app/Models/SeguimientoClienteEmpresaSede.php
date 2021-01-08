<?php

namespace App\Models;



use App\Models\SedeEmpresaCliente;
use App\Models\SeguimientoCliente;
use Illuminate\Database\Eloquent\Model;



class SeguimientoClienteEmpresaSede extends Model
{

    protected $primaryKey = 'seguimientoClienteEmpresaSede_id';
    protected $fillable = ['seguimientoClienteEmpresaSede_id','sedeEmpresa_id','seguimientoCliente_id','observacion'];


    public function sedeEmpresa()
    {
        return $this->belongsTo(SedeEmpresaCliente::class,'sedeEmpresa_id');
    }

    public function seguimiento()
    {
        return $this->belongsTo(SeguimientoCliente::class,'seguimientoCliente_id');
    }

    
}
