<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientePost extends FormRequest
{
    
    public static function myRules(){
        return [
            'cargo' =>'required',
            'empresa'=> 'required',
            'priNombre'=>'required',
            'priApellido'=> 'required',
            'email'=>'required|string|email|max:255|unique:clientes',
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
