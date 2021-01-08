<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatSexo extends Model
{
    protected $primaryKey = 'sexo_id';
    protected $fillable=['sexo_id','nombre'];


}
