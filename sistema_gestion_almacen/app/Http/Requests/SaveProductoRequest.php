<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductoRequest extends FormRequest
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
            'codigo' =>'required|max:20|unique:productos'.($this->producto? ',codigo,'.$this->producto->id : ''),
            'nombre' =>'required|max:50',
            'precio' => 'required|numeric|min:0',
            'subfamilia_id' => 'required',
            'marca_id' => 'required',
            'impuesto_id' => 'required'
        ];
    }
    public function messages(){
        return [
            'codigo' =>'El producto necesita un codigo',
            'nombre' =>'El producto necesita un nombre',
            'precio' =>'El producto necesita un precio superior a 0',
            'subfamilia_id' =>'El producto necesita pertenecer a una subfamilia',
            'marca_id' =>'El producto necesita una marca',
            'impuesto_id' =>'El producto necesita tener un tipo de impuesto. (IVA)',
        ];
    }
}
