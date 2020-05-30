<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Almacen
 *
 * @property int $id
 * @property string $codigo
 * @property int $sujeto_id
 * @property int $gelocalizacion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Sujeto|null $sujeto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen whereGelocalizacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen whereSujetoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Almacen whereUpdatedAt($value)
 */
	class Almacen extends \Eloquent {}
}

namespace App{
/**
 * App\Direccion
 *
 * @property int $id
 * @property string $direccion
 * @property string $poblacion
 * @property string $codigoPostal
 * @property string $provincia
 * @property string $pais
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Sujeto $sujeto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion whereCodigoPostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion wherePais($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion wherePoblacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Direccion whereUpdatedAt($value)
 */
	class Direccion extends \Eloquent {}
}

namespace App{
/**
 * App\Familia
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Subfamilia[] $subfamilias
 * @property-read int|null $subfamilias_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Familia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Familia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Familia query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Familia whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Familia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Familia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Familia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Familia whereUpdatedAt($value)
 */
	class Familia extends \Eloquent {}
}

namespace App{
/**
 * App\Geolocalizacion
 *
 * @property int $id
 * @property string $latitud
 * @property string $longitud
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Almacen $almacen
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Geolocalizacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Geolocalizacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Geolocalizacion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Geolocalizacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Geolocalizacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Geolocalizacion whereLatitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Geolocalizacion whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Geolocalizacion whereUpdatedAt($value)
 */
	class Geolocalizacion extends \Eloquent {}
}

namespace App{
/**
 * App\Impuesto
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property float $porcentaje
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Producto[] $productos
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto wherePorcentaje($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Impuesto whereUpdatedAt($value)
 */
	class Impuesto extends \Eloquent {}
}

namespace App{
/**
 * App\Marca
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Producto[] $productos
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Marca whereUpdatedAt($value)
 */
	class Marca extends \Eloquent {}
}

namespace App{
/**
 * App\PermisosRol
 *
 * @property int $id
 * @property int $permisoAdministrador
 * @property int $modificarDatosMaestros
 * @property int $verPanelRecursos
 * @property int $verPanelUsuarios
 * @property int $verPanelPedidos
 * @property int $verPanelRecepciones
 * @property int $verPanelStock
 * @property int $verPanelAlmacenes
 * @property int $verPanelProveedores
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Rol $rol
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereModificarDatosMaestros($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol wherePermisoAdministrador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereVerPanelAlmacenes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereVerPanelPedidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereVerPanelProveedores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereVerPanelRecepciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereVerPanelRecursos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereVerPanelStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PermisosRol whereVerPanelUsuarios($value)
 */
	class PermisosRol extends \Eloquent {}
}

namespace App{
/**
 * App\Producto
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property float $precio
 * @property int|null $subfamilia_id
 * @property int|null $marca_id
 * @property int $impuesto_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Impuesto|null $impuesto
 * @property-read \App\Marca|null $marca
 * @property-read \App\Stock $stock
 * @property-read \App\Subfamilia|null $subfamilia
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereImpuestoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereMarcaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereSubfamiliaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Producto whereUpdatedAt($value)
 */
	class Producto extends \Eloquent {}
}

namespace App{
/**
 * App\Proveedor
 *
 * @property int $id
 * @property string $codigo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Sujeto|null $sujeto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Proveedor whereUpdatedAt($value)
 */
	class Proveedor extends \Eloquent {}
}

namespace App{
/**
 * App\Rol
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\PermisosRol|null $permisoRol
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rol whereUserId($value)
 */
	class Rol extends \Eloquent {}
}

namespace App{
/**
 * App\Stock
 *
 * @property int $id
 * @property float $cantidad
 * @property int $producto_id
 * @property int $almacen_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Almacen[] $almacenes
 * @property-read int|null $almacenes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Producto[] $productos
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereAlmacenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereUpdatedAt($value)
 */
	class Stock extends \Eloquent {}
}

namespace App{
/**
 * App\Subfamilia
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int $familia_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Familia|null $familia
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Producto[] $productos
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia whereFamiliaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subfamilia whereUpdatedAt($value)
 */
	class Subfamilia extends \Eloquent {}
}

namespace App{
/**
 * App\Sujeto
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $primerApellido
 * @property string|null $segundoApellido
 * @property string $nif
 * @property string $email
 * @property string|null $telefono
 * @property string|null $personaContacto
 * @property string|null $paginaWeb
 * @property int $direccion_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Almacen $almacen
 * @property-read \App\Direccion|null $direccion
 * @property-read \App\Proveedor $proveedor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereDireccionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereNif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto wherePaginaWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto wherePersonaContacto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto wherePrimerApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereSegundoApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sujeto whereUpdatedAt($value)
 */
	class Sujeto extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $password
 * @property string $email
 * @property string $telefono
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Rol|null $rol
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

