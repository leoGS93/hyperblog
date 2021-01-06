<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatContrato extends Model
{
    protected $primaryKey = 'catContrato_id';
    protected $fillable=['catContrato_id','nombre','observacion'];
}
