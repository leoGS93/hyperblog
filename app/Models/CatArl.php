<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatArl extends Model
{
    protected $primaryKey = 'arl_id';
    protected $fillable=['arl_id','nombre'];

}
