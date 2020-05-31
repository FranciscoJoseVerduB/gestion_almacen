<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
    
 

    
        Schema::create('permisosRoles', function (Blueprint $table) {
            $table->id();
            $table->boolean('permisoAdministrador')->default(false); 
            $table->boolean('verPanelRecursos')->default(false); 

            $table->boolean('verPanelProductos')->default(false); 
            $table->boolean('modificarPanelProductos')->default(false); 
            

            $table->boolean('verPanelUsuarios')->default(false);
            $table->boolean('modificarPanelUsuarios')->default(false);
            
            $table->boolean('verPanelPedidos')->default(false);
            $table->boolean('modificarPanelPedidos')->default(false);
            
            $table->boolean('verPanelRecepciones')->default(false);
            $table->boolean('modificarPanelRecepciones')->default(false);

            $table->boolean('verPanelStock')->default(false);
            $table->boolean('modificarPanelStock')->default(false);
            
            $table->boolean('verPanelAlmacenes')->default(false);
            $table->boolean('modificarPanelAlmacenes')->default(false);

            $table->boolean('verPanelProveedores')->default(false);
            $table->boolean('modificarPanelProveedores')->default(false);

            $table->timestamps(); 
   
        });


        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); 
            $table->string('nombre');
            $table->unsignedBigInteger('permisosRole_id')->unique();
            $table->timestamps();  

            $table->foreign('permisosRole_id')->references('id')->on('permisosRoles');     
        });

        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre'); 
            $table->string('password'); 
            $table->string('email');
            $table->string('telefono');
            $table->rememberToken();
            $table->timestamps();


            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');     
        });
    



    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permisos_roles');

    }
}
