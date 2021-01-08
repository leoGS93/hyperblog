<?php

namespace App\Models;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Producto extends Model
{

    
    public $timestamps = false;
    protected $primaryKey = 'id_producto';
    protected $fillable=['id_producto','nombre','descripcion','stock','img'];

    protected $dates =['deleted_at'];

    public static function setFoto($foto,$actual=false)
    {
        if ($foto) {
           if ($actual) {
            Storage::disk('s3')->delete($actual);
           }
           
           $imageName=Str::random(20).'.'.$foto->getClientOriginalExtension();
               
           $imageName='/images/inventario/'.Str::random(20).'.'.$foto->getClientOriginalExtension();

           $imagen = Image::make($foto);
    
           //$imagen->fit(1500, 900);

           Storage::disk('s3')->put("$imageName",$imagen->stream());

           return $imageName;
        }else{
            return false;
        }
    }

    public static function deleteImagen($foto)
    {
        Storage::disk('s3')->delete($foto);
    }
}
