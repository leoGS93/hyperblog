<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatFondoPensiones extends Model
{
    protected $primaryKey = 'catFondoPensiones_id';
    protected $fillable=['catFondoPensiones_id','nombre'];
}
