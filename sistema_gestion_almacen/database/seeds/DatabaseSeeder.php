<?php

 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { 
        $this->call(UsuarioSeeder::class);
        $this->call(FamiliaSeeder::class);
        $this->call(SubfamiliaSeeder::class);
        $this->call(ImpuestoSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(MovimientoSeeder::class);
        $this->call(PedidosEstados::class);
    }
}
