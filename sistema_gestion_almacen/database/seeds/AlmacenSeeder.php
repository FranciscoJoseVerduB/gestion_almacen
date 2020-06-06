<?php

use App\Almacen;
use App\Direccion;
use App\Geolocalizacion;
use App\Sujeto;
use Illuminate\Database\Seeder;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            DB::beginTransaction();
            $direccion = new Direccion([
                'direccion' => 'C\' Ejemplo Almacen, nº 1',
                'poblacion' => 'Cartagena',
                'codigoPostal' => '30900',
                'provincia' => 'Murcia',
                'pais' => 'España'
            ]);  $direccion->save();

            $sujeto = new Sujeto([
                'nombre' => 'Almacen Cartagena',
                'primerApellido' => '',
                'segundoApellido' => '',
                'nif' => '1234123A',
                'email' => 'almacen@ejemplo.com',
                'telefono' => '333666999',
                'personaContacto' => 'Roberto',
                'paginaWeb' => '',
                'direccion_id' => $direccion->id
            ]); $sujeto->save();

            $geolocalizacion = new Geolocalizacion([
                'latitud' => '4.78',
                'longitud' => '1.78'
            ]); $geolocalizacion->save();

            $almacen = new Almacen([
                'codigo' => '20000000',
                'sujeto_id' => $sujeto->id,
                'geolocalizacion_id' => $geolocalizacion->id
            ]); $almacen->save();

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
    }
}
