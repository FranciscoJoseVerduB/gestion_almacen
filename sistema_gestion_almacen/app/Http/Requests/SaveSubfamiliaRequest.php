<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSubfamiliaRequest extends FormRequest
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
            'codigo' =>'required|max:20|unique:subfamilias'.($this->subfamilia? ',codigo,'.$this->subfamilia->id : ''),
            'nombre' =>'required|max:50',
            'familia_id' => 'required'
        ];
    }
    
    public function messages(){
        return [
            'codigo' =>'La subfamilia necesita un codigo',
            'nombre' =>'La subfamilia necesita un nombre', 
            'familia_id' => 'La subfamilia necesita una familia'
        ];
    }
}
