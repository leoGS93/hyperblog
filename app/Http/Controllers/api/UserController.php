<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\ApiResponseController;

class UserController extends ApiResponseController
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }
    
    public function index()
    {
        $users=User::get();
        return $this->successResponse(["users" => $users]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), StoreUserPost::myRules());
   
        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{

            $imageName='';
            if (isset($request['foto'])) {
                $base64_image = $request['foto'];
         
                $image_parts = explode(";base64,", $base64_image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $imageName='/images/users/'.Str::random(20).'.'.$image_type;
                
                Storage::disk('s3')->put($imageName, $image_base64);
            }

            $datos=$validator->validated();

            $user=new User();
            $user->name=$request['name'];
            $user->secondname=$request['secondname'];
            $user->surname=$request['surname'];
            $user->secondsurname=$request['secondsurname'];
            $user->email=$request['email'];
            $user->password=Hash::make($request['password']);
            $user->rol_id=$request['id_tipo'];
            if($imageName != ''){
                $user->avatar=$imageName;
            }
            $user->save();
          
            return $this->successResponse("exito");
        }
    }


    public function actualizar(Request $request, $id)
    {
        $user=User::find($id);
        $validator = Validator::make($request->all(),[
            'name' =>'required|string|max:255',
            'surname'=> 'required|string|max:255',
        ]);
        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }else{

            $datos=$validator->validated();

          
            $user->name=$request['name'];
            $user->secondname=$request['secondname'];
            $user->surname=$request['surname'];
            $user->secondsurname=$request['secondsurname'];
            if($request['foto'] != ''){
                $base64_image = $request['foto'];            
                $image_parts = explode(";base64,", $base64_image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $imageName='/images/users/'.Str::random(20).'.'.$image_type;
                
                Storage::disk('s3')->put($imageName, $image_base64);

                $user::deleteImagen($user->foto);
                $user->foto=$imageName;
            }
            $user->save();
          
            return $this->successResponse("exito");
        }
    }
}
