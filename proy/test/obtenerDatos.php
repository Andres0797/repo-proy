<?php

/*

if (isset($_POST['tipo_consulta'])){

	if ($_POST['tipo_consulta'] == 'verificarRegistro'){

		$ruta_recibida = $_POST['ruta'];

		$conecto = $conexion->consultar("SELECT id_ruta FROM ruta WHERE nombre='".$ruta_recibida."'");

		$id_ruta = $conexion->f_fila($conecto)->id_ruta;

		$now = new DateTime($date);
        $hoy=$now->format('Y-m-d');

        echo "hoy es ".$hoy; 



	}


 }else{

 	echo "Necesitas agregar un tipo consdulta";
 }
*/
        $ruta_recibida = 'H54';

		$conecto = $conexion->consultar("SELECT id_ruta FROM ruta WHERE nombre='".$ruta_recibida."'");
		$id_ruta = $conexion->f_fila($conecto)->id_ruta;
		$now = new DateTime($date);
        $hoy=$now->format('Y-m-d');

        echo "hoy es ".$hoy; 

