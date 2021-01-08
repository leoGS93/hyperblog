<?php

namespace App\Http\Controllers\api;

use App\Cliente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientePost;
use App\Http\Requests\UpdateClientePut;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\ApiResponseController;

class ClienteController extends ApiResponseController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function index()
    {
        $clientes=Cliente::get();
        return $this->successResponse(["clientes" => $clientes]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), StoreClientePost::myRules());
   
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
                $imageName='/images/clientes/'.Str::random(20).'.'.$image_type;
                
                Storage::disk('s3')->put($imageName, $image_base64);
            }

            $datos=$validator->validated();

            $cliente=new Cliente();
            $cliente->cargo=$request['cargo'];
            $cliente->empresa=$request['empresa'];
            $cliente->priNombre=$request['priNombre'];
            $cliente->segNombre=$request['segNombre'];
            $cliente->priApellido=$request['priApellido'];
            $cliente->segApellido=$request['segApellido'];
            $cliente->email=$request['email'];
            $cliente->numTelefono=$request['numTelefono'];
            $cliente->direccion=$request['direccion'];
            if($imageName != ''){
                $cliente->avatar=$imageName;
            }
            $cliente->save();
          
            return $this->successResponse("exito");
        }
    }


    public function show($id)
    {
        $cliente = Cliente::where('id_cliente',$id)->firstOrFail();
        return $this->successResponse(["cliente" => $cliente]);
    }

    public function actualizar(Request $request, $id)
    {
        $cliente=Cliente::find($id);
        $validator = Validator::make($request->all(),[
            'cargo' =>'required',
            'empresa'=> 'required',
            'priNombre'=>'required',
            'priApellido'=> 'required',
            'email'=>['required',
                       'string',
                        'email',
                        'max:255',
                        Rule::unique('clientes', 'email')->ignore($cliente->id_cliente, 'id_cliente'),
                        ],
            'numTelefono'=>'required',
             
        ]);
        
        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{

            $datos=$validator->validated();

          
            $cliente->cargo=$request['cargo'];
            $cliente->empresa=$request['empresa'];
            $cliente->priNombre=$request['priNombre'];
            $cliente->segNombre=$request['segNombre'];
            $cliente->priApellido=$request['priApellido'];
            $cliente->segApellido=$request['segApellido'];
            $cliente->email=$request['email'];
            $cliente->numTelefono=$request['numTelefono'];
            $cliente->direccion=$request['direccion'];
            if($request['avatar'] != ''){
                $base64_image = $request['avatar'];            
                $image_parts = explode(";base64,", $base64_image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $imageName='/images/clientes/'.Str::random(20).'.'.$image_type;
                
                Storage::disk('s3')->put($imageName, $image_base64);

                $cliente::deleteImagen($cliente->avatar);
                $cliente->avatar=$imageName;
            }
            $cliente->save();
          
            return $this->successResponse("exito");
        }
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id)->delete();
   
        return $this->successResponse("exito");
    }
}
