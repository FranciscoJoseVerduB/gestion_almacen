<?php

use App\Marca;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marca = Marca::create([
            'codigo' => 'FRAN01',
            'nombre' => 'FRAN-SIN' 
        ]); 
    }
}
