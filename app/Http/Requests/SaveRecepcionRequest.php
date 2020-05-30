<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRecepcionRequest extends FormRequest
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
            'observaciones' => 'nullable',
            'fecha'=> 'required',
            'proveedor_id' => 'required',
            'almacen_id'=> 'required', 
            'lineas'=> 'required|array|min:1' 
        ];
    }

    public function messages(){
        return [  
            'fecha'=> 'Introduzca una fecha',
            'proveedor_id' => 'Introduzca un proveedor',
            'almacen_id'=> 'Introduzca un almacen de destino', 
            'lineas.required'=> 'La recepcion debe tener al menos 1 producto. No puede estar vacío' 
        ];
    }
}
