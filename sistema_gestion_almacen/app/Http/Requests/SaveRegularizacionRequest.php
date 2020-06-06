<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRegularizacionRequest extends FormRequest
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
            'almacen_id'=> 'required', 
            'lineas'=> 'required|array|min:1', 
        ];
    }

    public function messages(){
        return [  
            'fecha'=> 'Introduzca una fecha', 
            'almacen_id'=> 'Introduzca un almacen de destino', 
            'lineas.required'=> 'El pedido debe tener al menos 1 producto. No puede estar vacío' 
        ];
    }
}
