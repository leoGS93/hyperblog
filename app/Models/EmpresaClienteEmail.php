<?php

namespace App\Models;


use App\Models\EmpresaCliente;
use Illuminate\Database\Eloquent\Model;

class EmpresaClienteEmail extends Model
{

    protected $primaryKey = 'empresaClienteEmail_id';
    protected $fillable = ['empresaClienteEmail_id','empresaCliente_id','email'];

    public function empresaCliente()
    {
        return $this->belongsTo(EmpresaCliente::class,'empresaCliente_id');
    }
}
