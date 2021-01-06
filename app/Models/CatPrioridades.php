<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class CatPrioridades extends Model
{

    protected $primaryKey = 'prioridad_id';
    protected $fillable = ['prioridad_id','nombre'];

    
}
