<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoPut extends FormRequest
{
    
    public static function myRules(){
        return [
            'id_tipEmpleado' =>'required',
            'id_tipSangre'=> 'required',
            'priNom'=> 'required',
            'priApe'=> 'required',
            'email'=>'required|string|email|max:255|unique:empleados',
            'numTelefono'=>'required|min:12',
        ];
    }


    public function authorize()
    {
        return false;
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
