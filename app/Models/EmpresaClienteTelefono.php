<?php

namespace App\Models;



use App\Models\CatTelefono;
use Illuminate\Database\Eloquent\Model;


class EmpresaClienteTelefono extends Model
{
    protected $primaryKey = 'empresaClienteTelefono_id';
    protected $fillable = ['empresaClienteTelefono_id','empresa_id','catTelefono_id','numero'];

    public function categoria()
    {
        return $this->belongsTo(CatTelefono::class,'catTelefono_id');
    }
}
