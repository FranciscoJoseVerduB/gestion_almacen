<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProveedorRequest extends FormRequest
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
            'codigo' =>'required|max:20|unique:users'.($this->proveedor? ',codigo,'.$this->proveedor->id : ''),
            'nombre' =>'required|max:50', 
            'primerApellido' => 'max:50',
            'segundoApellido' => 'max:50',
            'nif' => 'required|max:20', 
            'email' => 'required|email',
            'telefono' => 'required|regex:/[0-9]{9}/', 
            'personaContacto' => 'max:50',
            'paginaWeb' => 'max:50',
            'direccion' => 'required|max:50',
            'poblacion' => 'required|max:20',
            'codigoPostal' => 'required|max:10',
            'provincia' => 'required|max:20',
            'pais' => 'required|max:20'
        ]; 

        
  
    }
    
    public function messages(){
        return [
            'codigo' =>'El proveedor necesita un codigo',
            'nombre' =>'El proveedor necesita un nombre',   
            'primerApellido.max' => 'El campo Primer Apellido sólo puede tener 50 carácteres máximo',
            'segundoApellido.max' => 'El campo segundo Apellido sólo puede tener 50 carácteres máximo',
            'nif' => 'El proveedor necesita un NIF válido', 
            'email' => 'Debe introducir un email valido',
            'telefono' => 'El teléfono debe estar compuesto de 9 digitos', 
            'personaContacto' => 'Introduzca una persona de contacto. Máximo 50 carácteres',
            'paginaWeb' => 'Introduzca una pagina web de referencia. Máximo 50 carácteres',
            'direccion' => 'El proveedor necesita una direccion',
            'poblacion' => 'El proveedor necesita una poblacion',
            'codigoPostal' => 'El proveedor necesita un código Postal',
            'provincia' => 'El proveedor necesita una provincia',
            'pais' => 'El proveedor necesita un pais'
        ];
    }
}
