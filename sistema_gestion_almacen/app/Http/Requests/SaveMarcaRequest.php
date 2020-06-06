<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMarcaRequest extends FormRequest
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
            'codigo' =>'required|max:20|unique:marcas'.($this->marca? ',codigo,'.$this->marca->id : ''),
            'nombre' =>'required|max:50'
        ];
    } 

    public function messages(){
        return [
            'codigo' =>'El producto necesita un codigo',
            'nombre' =>'El producto necesita un nombre', 
        ];
    }
}
