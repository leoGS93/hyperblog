<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatBancos extends Model
{
    protected $primaryKey = 'banco_id';
    protected $fillable=['banco_id','nombre'];


}
