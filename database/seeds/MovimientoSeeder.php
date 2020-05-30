<?php

use App\ClaveMovimiento;
use App\TipoMovimientoAlmacen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{

            $claveEntrada = new ClaveMovimiento([
                'codigo' => 'EN', 
                'esEntrada' => true
            ]); $claveEntrada->save();

            $claveSalida = new ClaveMovimiento([
                'codigo' => 'SA', 
                'esEntrada' => false
            ]);$claveSalida->save();

            $movEntradaREC = new TipoMovimientoAlmacen([
                'codigo' => 'ENREC',
                'nombre' => 'Entrada Recepcion',
                'claveMovimiento_id' => $claveEntrada->id
            ]);$movEntradaREC->save();

            $movSalidaREC = new TipoMovimientoAlmacen([
                'codigo' => 'SAREC',
                'nombre' => 'Salida Recepcion',
                'claveMovimiento_id' => $claveSalida->id
            ]);$movSalidaREC->save();
                
            $movEntradaPED = new TipoMovimientoAlmacen([
                'codigo' => 'ENPED',
                'nombre' => 'Entrada Pedido',
                'claveMovimiento_id' => $claveEntrada->id
            ]);$movEntradaPED->save();

            $movSalidaPED = new TipoMovimientoAlmacen([
                'codigo' => 'SAPED',
                'nombre' => 'Salida Pedido',
                'claveMovimiento_id' => $claveSalida->id
            ]);$movSalidaPED->save();

            $movEntradaREG = new TipoMovimientoAlmacen([
                'codigo' => 'ENREG',
                'nombre' => 'Entrada Regularizacion',
                'claveMovimiento_id' => $claveEntrada->id
            ]);$movEntradaREG->save();

            $movSalidaREG = new TipoMovimientoAlmacen([
                'codigo' => 'SAREG',
                'nombre' => 'Salida Regularizacion',
                'claveMovimiento_id' => $claveSalida->id
            ]);$movSalidaREG->save();

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
    }
}
