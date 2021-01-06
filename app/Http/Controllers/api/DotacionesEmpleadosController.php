<?php

namespace App\Http\Controllers\api;

use App\Empleado;
use App\DotacionesEmpleado;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDotacionPost;
use App\Http\Requests\UpdateDotacionPut;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\ApiResponseController;

class DotacionesEmpleadosController extends ApiResponseController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function index()
    {
        $dotaciones=DotacionesEmpleado::with('empleado','producto')->get();
        return $this->successResponse(["dotaciones" => $dotaciones]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), StoreDotacionPost::myRules());
   
        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{

            $datos=$validator->validated();

            $dotacion=new DotacionesEmpleado();
            $dotacion->id_empleado=$request['id_empleado'];
            $dotacion->id_producto=$request['id_producto'];
            $dotacion->cantidad=$request['cantidad'];
            $dotacion->observacion=$request['observacion'];
            $dotacion->save();
          
            return $this->successResponse("exito");
        }
    }


    public function show($id)
    {
        $dotacion = DotacionesEmpleado::with('empleado','producto')->where('id_dotEmpleado',$id)->firstOrFail();
        return $this->successResponse(["dotacion" => $dotacion]);
    }

    public function actualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), UpdateDotacionPut::myRules());
        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{

            $datos=$validator->validated();

            $dotacion=DotacionesEmpleado::find($id);
            $dotacion->id_empleado=$request['id_empleado'];
            $dotacion->id_producto=$request['id_producto'];
            $dotacion->cantidad=$request['cantidad'];
            $dotacion->observacion=$request['observacion'];
            $dotacion->save();
          
            return $this->successResponse("exito");
        }
    }


    public function empleadosDotaciones($id)
    {
        $dotaciones = Empleado::with('dotaciones.producto:id_producto,nombre,img')->where('id_empleado',$id)->firstOrFail();
        return $this->successResponse(["dotaciones" => $dotaciones]);
    }
}
