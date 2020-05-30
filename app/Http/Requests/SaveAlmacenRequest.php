<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveAlmacenRequest extends FormRequest
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
            'codigo' =>'required|max:20|unique:users'.($this->almacen? ',codigo,'.$this->almacen->id : ''),
            'nombre' =>'required|max:50', 
            'primerApellido' => 'max:50',
            'segundoApellido' => 'max:50',
            'nif' => 'required|max:20', 
            'email' => 'required|email',
            'telefono' => 'required|regex:/[0-9]{9}/', 
            'personaContacto' => 'max:50',
            'paginaWeb' => 'max:50',
            'direccion' => 'required|max:50',
            'poblacion' => 'required|max:40',
            'codigoPostal' => 'required|max:10',
            'provincia' => 'required|max:40',
            'pais' => 'required|max:30'
        ]; 

        
  
    }
    
    public function messages(){
        return [
            'codigo' =>'El almacen necesita un codigo',
            'nombre' =>'El almacen necesita un nombre',   
            'primerApellido.max' => 'El campo Primer Apellido sólo puede tener 50 carácteres máximo',
            'segundoApellido.max' => 'El campo segundo Apellido sólo puede tener 50 carácteres máximo',
            'nif' => 'El almacen necesita un NIF válido', 
            'email' => 'Debe introducir un email valido',
            'telefono' => 'El teléfono debe estar compuesto de 9 digitos', 
            'personaContacto' => 'Introduzca una persona de contacto. Máximo 50 carácteres',
            'paginaWeb' => 'Introduzca una pagina web de referencia. Máximo 50 carácteres',
            'direccion' => 'El almacen necesita una direccion',
            'poblacion' => 'El almacen necesita una poblacion',
            'codigoPostal' => 'El almacen necesita un código Postal',
            'provincia' => 'El almacen necesita una provincia',
            'pais' => 'El almacen necesita un pais'
        ];
    }
}
