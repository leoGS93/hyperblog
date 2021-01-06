<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class SedeEmpresaClienteEmail extends Model
{
  
    protected $primaryKey = 'sedeEmpresaEmail_id';
    protected $fillable = ['sedeEmpresaEmail_id','sedeEmpresa_id','email'];

    
}
