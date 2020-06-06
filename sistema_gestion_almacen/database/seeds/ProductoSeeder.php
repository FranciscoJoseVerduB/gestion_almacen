<?php

use App\Impuesto;
use App\Marca;
use App\Producto;
use App\Subfamilia;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $producto = Producto::create([
            'codigo' => 'HER0000001',
            'nombre' => 'Martillo',
            'precio' => 0.82,
            'subfamilia_id' =>  Subfamilia::firstOrFail()->id,
            'marca_id' =>  Marca::firstOrFail()->id,
            'impuesto_id' => Impuesto::firstOrFail()->id
        ]);
        
 
    }
}
