<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class CatCotizaciones extends Model
{

    protected $primaryKey = 'catCotizacion_id';
    protected $fillable = ['catCotizacion_id','nombre'];

    
}
