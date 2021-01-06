<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoPost extends FormRequest
{
    
    public static function myRules(){
        return [
            'nombre'=> 'required|unique:productos',
            'descripcion'=>'required',
            'stock'=> 'required',
            'img'=>'required',
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
