<?php
 
 include ("mysql.php");

 //Cambiar el true por false si es un MySQL Nuevo (Por ejemplo XAMPP Recien Instalado) 
 $conexionDefectoA 	= true;

 //Conectamos con mysql
 $conexion = new mysql;
 $conexion->base 	= "proyecto_visitas";
 if ($conexionDefectoA){
 	$conexion->servidor	= "localhost";
 	$conexion->usuario	= "root";
 	$conexion->clave 	= "";
 }
 $conexion->conectar();
 
?>