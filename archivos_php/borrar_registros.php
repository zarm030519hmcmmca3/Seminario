<? php 
require_once ( "conexion.php" );

$ id = $ _GET [ 'id' ];

$ seg_id = mysqli_real_escape_string ( $ conexión , $ id );
$ borrar = "ELIMINAR DE datos_usuarios DONDE ID = {$ seg_id}" ;
$ resultado = mysqli_query ( $ conexión , $ borrar );
encabezado ( "ubicación: ../index.php" );
?>
