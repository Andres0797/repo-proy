<?php
namespace Proyecto\Modelo;

use Proyecto\Controlador\mysql as mysql;

class Contador{

	private $conexion;
	private $nuevo;
	private $numeroVisitas;
	private $nombreRuta;
	/* Constructor para invocar y almacenar variables de inicio */
	function __construct($numeroVisitas,$nombreRuta){
		$this->numeroVisitas 	= 	$numeroVisitas;
		$this->nombreRuta 		= 	$nombreRuta;
		$this->nuevo = new mysql();
		$this->conexion = $this->nuevo->conectar();
	}
	function contadorIntervalos($ruta){
		// SELECT SUM(numeroVisitas) AS suma FROM contador_diario WHERE fk_ruta=1 AND HOUR(fecha)<12 AND HOUR(fecha)>10
		$resultadoHoras = [];
		for ($horaInicial=8; $horaInicial < 13 ; $horaInicial++) { 
			// $horaInicial 8 y $horaFinal 10 , hora evaluada = 9am  
			// $horaInicial 9 y $horaFinal 11 , hora evaluada = 10am
			// $horaInicial 10 y $horaFinal 12 , hora evaluada = 11am
			$horaFinal=$horaInicial+2;
			$sentencia = "SELECT SUM(numeroVisitas) as suma FROM contador_diario WHERE fk_ruta=".$ruta." AND HOUR(fecha)>".$horaInicial." AND HOUR(fecha)<".$horaFinal;
			$conecto=$this->nuevo->consultar($sentencia);
			$resultadoHoras[$horaInicial+1] =  $this->nuevo->f_fila($conecto)->suma;
		}
		
		return $resultadoHoras;
	}

	/* Numero de visitas en total de una ruta */
	function contadorTotalRuta($ruta){
		
		$conecto=$this->nuevo->consultar("SELECT SUM(numeroVisitas) AS sumaTotal 
		FROM rutascontador WHERE nombre='".$ruta."'");
		return 	$this->nuevo->f_fila($conecto)->sumaTotal;
	}
	/* Consulta cual es el ID de una ruta poniendo el nombre de la ruta */
	function consultarIDRuta($ruta){
		$conecto=$this->nuevo->consultar("SELECT * FROM ruta WHERE nombre='".$ruta."'");
		return $this->nuevo->f_fila($conecto)->id_ruta;

	}
	/* Inserta un contador en la base de datos */
	function insertarContadorBD(){

		if ($this->consultarIDRuta($this->nombreRuta)!="NULL"){
			$preparar = "INSERT INTO contador_diario (id_contadord,fk_ruta,fecha,numeroVisitas) VALUES (NULL,'".$this->consultarIDRuta($this->nombreRuta)."',current_timestamp(),'".$this->numeroVisitas."')";
			$this->nuevo->consultar($preparar);
			return "enviado con exito";

		}else{
			return "ha ocurrido un error";
		}		
		
	}

	function agregarContador($numeroVisitas,$fk_ruta){
		$sentencia = "INSERT INTO contador (id_contadord,numeroVisitas,fk_ruta) VALUES (NULL,".$numeroVisitas.",".$fk_ruta.")";
		$conectado = $this->nuevo->consultar($sentencia);
		if ($conectado){
			return "Contador agregado";
		}else{
			return "Hubo un error al agregar";
		}
	}
	function modificarContador($id_contadord,$numeroVisitas,$fk_ruta){ 
		$sentencia = "UPDATE contador SET numeroVisitas='".$numeroVisitas."',fk_ruta=".$fk_ruta." WHERE id_contadord=".$id_contadord;
		$conectado = $this->nuevo->consultar($sentencia);
		if ($conectado){
			return "Contador modificado correctamente";
		}else{
			return "Hubo un error al modificar el contador";
		}	
	}
	function eliminarContador($id_contadord){
		$sentencia = "DELETE FROM contador WHERE id_contadord=".$id_contadord;
		$conectado = $this->nuevo->consultar($sentencia);
		if ($conectado){
			return "Contador eliminado correctamente";
		}else{
			return "Hubo un error al eliminar el contador";
		}

	}
}


?>