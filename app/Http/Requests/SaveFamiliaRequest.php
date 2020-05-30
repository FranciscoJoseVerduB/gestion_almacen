<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFamiliaRequest extends FormRequest
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
            'codigo' =>'required|max:20|unique:familias'.($this->familia? ',codigo,'.$this->familia->id : ''),
            'nombre' =>'required|max:50'
        ];
    }
    
    public function messages(){
        return [
            'codigo' =>'La familia necesita un codigo',
            'nombre' =>'La familia necesita un nombre', 
        ];
    }
}
