<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class SaveUserRequest extends FormRequest
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
            'codigo' =>'required|max:20|unique:users'.($this->usuario? ',codigo,'.$this->usuario->id : ''),
            'nombre' =>'required|max:50',
            'password' => $this->getMethod()==='POST'? 'required': '',
            'email' => 'required|email',
            'telefono' => 'required|regex:/[0-9]{9}/', 
            'role_id' => 'required'
        ];
    } 
    
    public function messages(){
        return [
            'codigo' =>'El usuario necesita un codigo',
            'nombre' =>'El usuario necesita un nombre', 
            'password' => 'Debe establecer una password',
            'email' => 'Debe introducir un email valido',
            'telefono' => 'El teléfono debe estar compuesto de 9 digitos',
            'role_id' => 'El usuario requiere un rol'
        ];
    }
}
