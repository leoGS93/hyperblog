<?php

namespace App\Http\Controllers\api;

use App\Empleado;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEmpleadoPost;
use App\Http\Requests\UpdateEmpleadoPut;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\ApiResponseController;

class EmpleadoController extends ApiResponseController
{
    public function index()
    {
        $empleados=Empleado::with('catSangre','catEmpleado:catEmpleado_id,nombre','catSexo','catArl','estadosCivil','catContrato:catContrato_id,nombre','catFondoPensiones','catEps','catBancos')->get();
        return $this->successResponse(["empleados" => $empleados]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), StoreEmpleadoPost::myRules());
   
        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{
          
            $imageName='';

            if (isset($request['avatar'])) {
                $base64_image = $request['avatar'];
         
                $image_parts = explode(";base64,", $base64_image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $imageName='/images/empleados/'.Str::random(20).'.'.$image_type;
                
                Storage::disk('s3')->put($imageName, $image_base64);
            }
            
            $datos=$validator->validated();

            $empleado=new Empleado();
            $empleado->id_tipEmpleado=$request['id_tipEmpleado'];
            $empleado->id_tipSangre=$request['id_tipSangre'];
            $empleado->cedula=$request['cedula'];
            $empleado->eps=$request['eps'];
            $empleado->arl=$request['arl'];
            $empleado->priNom=$request['priNom'];
            $empleado->segNom=$request['segNom'];
            $empleado->priApe=$request['priApe'];
            $empleado->segApe=$request['segApe'];
            $empleado->email=$request['email'];
            $empleado->numTelefono=$request['numTelefono'];
            $empleado->direccion=$request['direccion'];
            if($imageName != ''){
              $empleado->avatar=$imageName;
            }
            
            $empleado->save();
          
            return $this->successResponse("exito");
        }
    }


    public function show($id)
    {
        $empleado = Empleado::where('id_empleado',$id)->firstOrFail();
        return $this->successResponse(["empleado" => $empleado]);
    }

    public function actualizar(Request $request, $id)
    {
        $empleado=Empleado::find($id);

        $validator = Validator::make($request->all(),[
            'id_tipEmpleado' =>'required',
            'id_tipSangre'=> 'required',
            'priNom'=> 'required',
            'priApe'=> 'required',
            'email'=>['required',
                       'string',
                        'email',
                        'max:255',
                        Rule::unique('empleados', 'email')->ignore($empleado->id_empleado, 'id_empleado'),
                        ],
            'numTelefono'=>'required',
            'direccion' => 'required',
             
        ]);

        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{
            
            
      
            $datos=$validator->validated();

            
            $empleado->id_tipEmpleado=$request['id_tipEmpleado'];
            $empleado->id_tipSangre=$request['id_tipSangre'];
            $empleado->cedula=$request['cedula'];
            $empleado->eps=$request['eps'];
            $empleado->arl=$request['arl'];
            $empleado->priNom=$request['priNom'];
            $empleado->segNom=$request['segNom'];
            $empleado->priApe=$request['priApe'];
            $empleado->segApe=$request['segApe'];
            $empleado->email=$request['email'];
            $empleado->numTelefono=$request['numTelefono'];
            $empleado->direccion=$request['direccion'];

            if($request['avatar'] != null){
                $base64_image = $request['avatar'];            
                $image_parts = explode(";base64,", $base64_image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $imageName='/images/empleados/'.Str::random(20).'.'.$image_type;
                
                Storage::disk('s3')->put($imageName, $image_base64);

                $empleado::deleteImagen($empleado->avatar);
                $empleado->avatar=$imageName;
            }

            $empleado->save();
          
            return $this->successResponse("exito");
        }
    }
}
