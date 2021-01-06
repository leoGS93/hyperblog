<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class CatStatu extends Model
{

    protected $primaryKey = 'status_id';
    protected $fillable = ['status_id','nombre'];

    
}
