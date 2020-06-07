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
                'verPanelRecursos' => true,

                'verPanelUsuarios' => true,
                'modificarPanelUsuarios' => true,

                'verPanelProductos' => true,
                'modificarPanelProductos'=> true,
 
 
 
                'verPanelPedidos' => true,
                'modificarPanelPedidos'=>true,

                'verPanelRecepciones' => true,
                'modificarPanelRecepciones'=>true,

                'verPanelStock' => true,
                'modificarPanelStock'=>true,

                'verPanelAlmacenes' => true,
                'modificarPanelAlmacenes' => true,

                'verPanelProveedores' => true,            
                'modificarPanelProveedores' => true,
            ]);     
            $permisosRol->save();

        

            $rol = new Rol([
                'codigo' => 'admin',
                'nombre' => 'administrador',
                'permisosrole_id' => $permisosRol->id 
            ]); 
            $rol->save();
    
            $user = new User([
                'codigo' =>'admin',
                'nombre' => 'Usuario administrador',
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
