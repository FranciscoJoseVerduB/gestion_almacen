<?php

use App\User;
use App\Rol;
use App\PermisosRol;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            $permisosRol = new PermisosRol([
                'permisoAdministrador' => true,
                'modificarDatosMaestros' => true,
                'verPanelRecursos' => true,
                'verPanelUsuarios' => true,
                'verPanelPedidos' => true,
                'verPanelRecepciones' => true,
                'verPanelStock' => true,
                'verPanelAlmacenes' => true,
                'verPanelProveedores' => true,            
            ]);     
            $permisosRol->save();

        

            $rol = new Rol([
                'codigo' => 'admin',
                'nombre' => 'administrador',
                'permisosrole_id' => $permisosRol->id 
            ]); 
            $rol->save();
    
            $user = new User([
                'codigo' =>'prueba',
                'nombre' => 'prueba',
                'password' => bcrypt('teleco'),
                'email' => 'prueba@prueba.com',
                'telefono' => '333666999'
            ]);
            $user->rol()->associate($rol);
            $user->save();

            
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }


    }
}
