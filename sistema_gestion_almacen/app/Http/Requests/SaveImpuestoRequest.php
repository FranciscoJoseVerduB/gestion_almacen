<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveImpuestoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
        return [
            'codigo' =>'required|max:20|unique:impuestos'.($this->impuesto? ',codigo,'.$this->impuesto->id : ''),
            'nombre' =>'required|max:50',
            'porcentaje' => 'required|numeric|min:0', 
        ];
    }
    public function messages(){
        return [
            'codigo' =>'El producto necesita un codigo',
            'nombre' =>'El producto necesita un nombre',
            'porcentaje' =>'El producto necesita un porcentaje igual o superior a 0', 
        ];
    }
}
