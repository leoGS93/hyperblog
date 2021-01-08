<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatEps extends Model
{
    protected $primaryKey = 'eps_id';
    protected $fillable=['eps_id','nombre'];
}
