<? php
require_once ( "archivos_php / conexion.php" );

// Definir las variables de los mensajes de errores
$ msgNombreError = $ msgA ApellidosError = $ msgCorreoError = $ msgTelefonoError = "" ;

if ( isset ( $ _POST [ 'enviar' ])) {
	$ nombre = trim ( $ _POST [ 'nombre' ]);
	$ apellido = trim ( $ _POST [ 'apellido' ]);
	$ correo = trim ( $ _POST [ 'correo' ]);
	$ telefono = recortar ( $ _POST [ 'telefono' ]);
	$ expTelefono = "/ ^ \ + \ d {3} \ s \ d {4} - \ d {4} $ /" ;
	
	// Verificar los Correos Electrónicos ya existentes
	$ buscarCorreos = "SELECCIONAR * DESDE datos_usuarios DONDE Correo = '{$ correo}'" ;
	$ consultaCorreos = mysqli_query ( $ conexion , $ buscarCorreos );
	$ verificarCorreos = mysqli_num_rows ( $ consultaCorreos );
	
	// Verificar los Números Telefónicos ya existentes
	$ buscarTelefonos = "SELECCIONAR * DESDE datos_usuarios DONDE Telefono = '{$ telefono}'" ;
	$ consultaTelefonos = mysqli_query ( $ conexion , $ buscarTelefonos );
	$ verificarTelefonos = mysqli_num_rows ( $ consultaTelefonos );
	
	// Validaciones necesarias para los campos Nombre, Apellido, Correo y Teléfono.
	if ( vacío ( $ nombre )) {
		$ msgNombreError = "Su Nombre es Requerido!" ;
	} else  if ( is_numeric ( $ nombre )) {
		$ msgNombreError = "No se permiten Numeros!" ;
	} else  if ( vacío ( $ apellido )) {
		$ msgA ApellidosError = "Su Apellido es Requerido!" ;
	} else  if ( is_numeric ( $ apellido )) {
		$ msgA lastError = "¡No se permiten Numeros!" ;
	} else  if ( vacío ( $ correo )) {
		$ msgCorreoError = "Su Correo Electrónico es Requerido!" ;
	} más  si (! filter_var ( $ correo , FILTER_VALIDATE_EMAIL )) {
		$ msgCorreoError = "Su Correo Electrónico es Invalido!" ;
	} else  if ( $ verificarCorreos > 0 ) {
		$ msgCorreoError = "El Correo Electrónico ya Existe!" ;
	} else  if ( vacío ( $ telefono )) {
		$ msgTelefonoError = "Su Número Telefónico es Requerido!" ;
	} else  if (! preg_match ( $ expTelefono , $ telefono )) {
		$ msgTelefonoError = "Su Número Telefónico es Invalido!" ;
	} else  if ( $ verificarTelefonos > 0 ) {
		$ msgTelefonoError = "El Número Telefónico ya Existe!" ;
	} más {
		// Registrar los datos de cada campo si TODOS fueron validados exitosamente
		$ registro = "INSERT INTO datos_usuarios (Nombre, Apellido, Correo, Telefono)
		VALORES ('{$ nombre}', '{$ apellido}', '{$ correo}', '{$ telefono}') " ;
		$ resultado = mysqli_query ( $ conexión , $ registro );
	}
}
?>
<! DOCTYPE html >
< html  lang = " es-HN " >
< cabeza >
<? php  include_once ( "archivos_php / meta_datos.php" );
echo  "<título>" . $ titulo_sitio . "</title> \ n" ;
echo  "<meta name = '{$ meta_nombre1}' content = '{$ autor}' /> \ n" ;
echo  "<meta name = '{$ meta_nombre2}' content = '{$ viewport}' /> \ n" ;
echo  "<meta name = '{$ meta_nombre3}' content = '{$ palabras clave}' /> \ n" ;
echo  "<meta name = '{$ meta_nombre4}' content = '{$ descripción}' /> \ n" ;
?>
< meta  http-equiv = " X-UA-Compatible " content = " IE = edge " />
< link  rel = " stylesheet " type = " text / css " href = " style / index.css " media = " screen " />
</ cabeza >
< cuerpo >
< div  id = " contenedor " >
<? php
$ titulo_contenido = "Registro simple de usuarios" ;
echo  "\ t <h1>" . $ titulo_contenido . "</h1> \ n" ;
?>

	< método de formulario  = " publicar " acción = " <? php echo htmlspecialchars ( $ _SERVER [ 'PHP_SELF' ]); ?> " >  
		<conjunto de campos >
		< leyenda > Ingrese sus Datos </ leyenda >
			< etiqueta > Nombre: </ etiqueta > 
			<? php  echo  "<span class = 'mensaje_error'>" . $ msgNombreError . "</span> \ n" ; ?>
			< input  type = " text " placeholder = " Su Nombre " name = " nombre " value = " <? php  if ( isset ( $ nombre )) echo  $ nombre ; ?> " />
			< etiqueta > Apellido: </ etiqueta > 
			<? php  echo  "<span class = 'mensaje_error'>" . $ msgA ApellidosError . "</span> \ n" ; ?>
			< input  type = " text " placeholder = " Su apellido " name = " apellido " value = " <? php  if ( isset ( $ apellido )) echo  $ apellido ; ?> " />
			< etiqueta > Correo Electrónico: </ etiqueta > 
			<? php  echo  "<span class = 'mensaje_error'>" . $ msgCorreoError . "</span> \ n" ; ?>
			< input  type = " text " placeholder = " usuario@dominio.com " name = " correo " value = " <? php  if ( isset ( $ correo )) echo  $ correo ; ?> " />
			< label > Teléfono: </ label > 
			<? php  echo  "<span class = 'mensaje_error'>" . $ msgTelefonoError . "</span> \ n" ; ?>
			< input  type = " text " placeholder = " + XXX XXXX-XXXX " name = " telefono " value = " <? php  if ( isset ( $ telefono )) echo  $ telefono ; ?> " />
			< input  type = " submit " name = " enviar " value = " registrador " />
		</ fieldset >
	</ formulario >
	
<? php
include_once ( "archivos_php / mostrar_registros.php" );

$ url_contenido = "../" ;
$ url_titulo_contenido = "Ir hacia atrás" ;
$ url_mensaje = "Ir Atrás" ;
echo  "\ t <a id='ir_atras' href='{$url_contenido}' title='{$url_titulo_contenido}'> {$ url_mensaje} </a> \ n" ;
?>
</ div >
</ cuerpo >
</ html >
