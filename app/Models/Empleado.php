<?php

namespace App\Models;


use App\Models\CatArl;
use App\Models\CatEps;
use App\Models\CatSexo;
use App\Models\CatBancos;
use App\Models\CatSangre;
use App\Models\CatContrato;
use App\Models\CatEmpleado;
use App\Models\EstadosCivile;
use App\Models\CatFondoPensiones;
use Illuminate\Database\Eloquent\Model;


class Empleado extends Model
{
    
    public $timestamps = false;
    protected $primaryKey = 'empleado_id';
    protected $fillable=['empleado_id','catEmpleado_id','eps_id','arl_id','tipoSangre_id','sexo_id','estadoCivil_id','banco_id','fondoPension_id','catContrato_id','nombre','apellido','cedula','email','telefono','direccion','cuentaBancaria','sueldo','fechaNacimiento','fechaIngreso','fechaRetiro'];

    
    public function catEmpleado()
    {
        return $this->belongsTo(CatEmpleado::class,'catEmpleado_id');
    }

    public function catSangre()
    {
        return $this->belongsTo(CatSangre::class,'tipoSangre_id');
    }

    public function catSexo()
    {
        return $this->belongsTo(CatSexo::class,'sexo_id');
    }
    
    public function catArl()
    {
        return $this->belongsTo(CatArl::class,'arl_id');
    }

    public function estadosCivil()
    {
        return $this->belongsTo(EstadosCivile::class,'estadoCivil_id');
    }  

    public function catContrato()
    {
        return $this->belongsTo(CatContrato::class,'catContrato_id');
    }  

    public function catFondoPensiones()
    {
        return $this->belongsTo(CatFondoPensiones::class,'fondoPension_id');
    }  

    public function catEps()
    {
        return $this->belongsTo(CatEps::class,'eps_id');
    }    

    public function catBancos()
    {
        return $this->belongsTo(CatBancos::class,'banco_id');
    }

    // public static function setFoto($foto,$actual=false)
    // {
    //     if ($foto) {
    //        if ($actual) {
    //         Storage::disk('s3')->delete($actual);
    //        }
           
    //        $imageName=Str::random(20).'.'.$foto->getClientOriginalExtension();
               
    //        $imageName='/images/empleados/'.Str::random(20).'.'.$foto->getClientOriginalExtension();

    //        $imagen = Image::make($foto);
    
    //        //$imagen->fit(1500, 900);

    //        Storage::disk('s3')->put("$imageName",$imagen->stream());

    //        return $imageName;
    //     }else{
    //         return false;
    //     }
    // }

    // public static function deleteImagen($foto)
    // {
    //     Storage::disk('s3')->delete($foto);
    // }
}
