<?php

use App\Familia;
use App\Subfamilia;
use Illuminate\Database\Seeder;

class SubfamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $subFamilia = new Subfamilia([
            'codigo' => 'HER0001',
            'nombre' => 'Herramientas de mano' ,
            'familia_id' => Familia::firstOrFail()->id
        ]);
        $subFamilia->save();

        $subFamilia = new Subfamilia([
            'codigo' => 'HER0002',
            'nombre' => 'Herramientas mecanicas' ,
            'familia_id' => Familia::firstOrFail()->id
        ]);
        $subFamilia->save();

        $subFamilia = new Subfamilia([
            'codigo' => 'HER0003',
            'nombre' => 'Herramientas electricas' ,
            'familia_id' => Familia::firstOrFail()->id
        ]);
        $subFamilia->save();
        
        $subFamilia = new Subfamilia([
            'codigo' => 'CAJ0001',
            'nombre' => 'Cajas de carton' ,
            'familia_id' => Familia::where('codigo','like', '%CAJ%' )->first()?Familia::where('codigo','like', '%HE%' )->first()->id: null
        ]);
        $subFamilia->save();
        
    }
}
