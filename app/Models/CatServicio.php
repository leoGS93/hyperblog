<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class CatServicio extends Model
{

    protected $primaryKey = 'catServicio_id';
    protected $fillable = ['catServicio_id','nombre','descripcion'];

    
}
