<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDotacionPut extends FormRequest
{
    
    public static function myRules(){
        return [
            'id_empleado'=> 'required',
            'id_producto'=>'required',
            'cantidad'=> 'required',
            'observacion'=>'required',
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
