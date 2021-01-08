<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoPost extends FormRequest
{
    
    public static function myRules(){
        return [
            'id_tipEmpleado' =>'required',
            'id_tipSangre'=> 'required',
            'cedula'=>'required',
            'priNom'=> 'required',
            'priApe'=> 'required',
            'email'=>'required|string|email|max:255|unique:empleados',
            'numTelefono'=>'required',
        ];
    }


    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
          return $this->myRules();
    }
}
