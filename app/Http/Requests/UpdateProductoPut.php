<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoPut extends FormRequest
{
    
    public static function myRules(){
        return [
         
            'descripcion'=>'required',
            'stock'=> 'required',
         
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
