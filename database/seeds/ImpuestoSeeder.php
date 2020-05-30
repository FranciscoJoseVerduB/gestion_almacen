<?php

use App\Impuesto;
use Illuminate\Database\Seeder;

class ImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $impuesto1 = Impuesto::create([
            'codigo' => 'NAC001',
            'nombre' => 'IVA estándar',
            'porcentaje' => 21
        ]); 
        $impuesto2 = Impuesto::create([
            'codigo' => 'NAC002',
            'nombre' => 'IVA reducido',
            'porcentaje' => 10
        ]); 
        $impuesto3 = Impuesto::create([
            'codigo' => 'NAC003',
            'nombre' => 'IVA Superreducido',
            'porcentaje' => 4
        ]); 
        $impuesto4 = Impuesto::create([
            'codigo' => 'NAC004',
            'nombre' => 'IVA exento',
            'porcentaje' => 0
        ]); 
    }
}
