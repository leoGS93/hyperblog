<?php

namespace App\Http\Controllers\api;

use App\Producto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductoPost;
use App\Http\Requests\UpdateProductoPut;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\ApiResponseController;

class ProductoController extends ApiResponseController
{
    public function index()
    {
        $productos=Producto::get();
        return $this->successResponse(["productos" => $productos]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), StoreProductoPost::myRules());
   
        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{

            $imageName='';

            if (isset($request['img'])) {
                $base64_image = $request['img'];
         
                $image_parts = explode(";base64,", $base64_image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $imageName='/images/inventario/'.Str::random(20).'.'.$image_type;
                
                Storage::disk('s3')->put($imageName, $image_base64);
            }

            $datos=$validator->validated();

            $producto=new Producto();
            $producto->nombre=$request['nombre'];
            $producto->descripcion=$request['descripcion'];
            $producto->stock=$request['stock'];
            $producto->img=$imageName;
            $producto->save();
          
            return $this->successResponse("exito");
        }
    }


    public function show($id)
    {
        $producto = Producto::where('id_producto',$id)->firstOrFail();
        return $this->successResponse(["producto" => $producto]);
    }

    public function actualizar(Request $request, $id)
    {
        $producto=Producto::find($id);

        $validator = Validator::make($request->all(), [
            'nombre'=> ['required',
                       Rule::unique('productos','nombre')->ignore($producto->id_producto, 'id_producto'),
                       ],
            'descripcion'=>'required',
            'stock'=> 'required',
         
        ]);


        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{

            $datos=$validator->validated();

            
            $producto->nombre=$request['nombre'];
            $producto->descripcion=$request['descripcion'];
            $producto->stock=$request['stock'];

            if($request['img'] != ''){
                $base64_image = $request['img'];            
                $image_parts = explode(";base64,", $base64_image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $imageName='/images/inventario/'.Str::random(20).'.'.$image_type;
                
                Storage::disk('s3')->put($imageName, $image_base64);

                $producto::deleteImagen($producto->img);
                $producto->img=$imageName;
            }

            $producto->save();
          
            return $this->successResponse("exito");
        }
    }
}
