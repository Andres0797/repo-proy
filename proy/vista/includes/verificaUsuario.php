<?php
$seleccionUsuario = $_COOKIE['id_portal'];

if (!isset($seleccionUsuario)){

    header("Location: http://".$_SERVER['SERVER_NAME']."/proy/vista/admin/listaPortales.php");
}



?>