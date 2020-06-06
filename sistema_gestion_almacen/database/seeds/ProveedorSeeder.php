<?php

use App\Direccion;
use App\Proveedor;
use App\Sujeto;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        try{
            $direccion = new Direccion([
                'direccion' => 'C\' Ejemplo Proveedor, nº 1',
                'poblacion' => 'Mazarron',
                'codigoPostal' => '30800',
                'provincia' => 'Murcia',
                'pais' => 'España'
            ]); $direccion->save();

            $sujeto = new Sujeto([
                'nombre' => 'Hermanos Electrisistas SL',
                'primerApellido' => '',
                'segundoApellido' => '',
                'nif' => '9887654A',
                'email' => 'hermanos@prueba.com',
                'telefono' => '222999666',
                'personaContacto' => 'Julia',
                'paginaWeb' => '',
                'direccion_id' => $direccion->id
            ]); $sujeto->save();

            $proveedor = new Proveedor([
                'codigo' => '40000000',
                'sujeto_id' => $sujeto->id
            ]); $proveedor->save();
        
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
    
    }
}
