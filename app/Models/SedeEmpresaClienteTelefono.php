<?php

namespace App\Models;


use App\Models\CatTelefono;
use Illuminate\Database\Eloquent\Model;




class SedeEmpresaClienteTelefono extends Model
{
    protected $primaryKey = 'sedeEmpresaTelefono_id';
    protected $fillable = ['sedeEmpresaTelefono_id','sedeEmpresa_id','catTelefono_id','numero'];

    public function categoria()
    {
        return $this->belongsTo(CatTelefono::class,'catTelefono_id');
    }

    
}
