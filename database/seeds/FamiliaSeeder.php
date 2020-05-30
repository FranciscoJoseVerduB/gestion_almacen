<?php

use App\Familia;
use Illuminate\Database\Seeder;

class FamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $familia1 = Familia::create([
            'codigo' => 'HER01',
            'nombre' => 'Herramientas' 
        ]); 

        $familia2 = Familia::create([
            'codigo' => 'CAJ02',
            'nombre' => 'Cajas' 
        ]); 
        $familia3 = Familia::create([
            'codigo' => 'ENV03',
            'nombre' => 'Envases' 
        ]); 

    }
}
