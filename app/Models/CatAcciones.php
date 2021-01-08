<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class CatAcciones extends Model
{

    protected $primaryKey = 'catAccion_id';
    protected $fillable = ['catAccion_id','nombre'];

    
}
