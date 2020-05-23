<?php
namespace Proyecto\Modelo;

//require('../controlador/mysql.php');
use Proyecto\Controlador\mysql as mysql;

class Contador extends mysql{

	

	var $id_contador;
	var $numeroVisitas;
	var $nombreRuta;
	var $fecha;
	 
	


	/* Constructor para invocar y almacenar variables de inicio */
	function __construct($numeroVisitas,$nombreRuta){
		$this->numeroVisitas 	= 	$numeroVisitas;
		$this->nombreRuta 		= 	$nombreRuta;
		$this->usuario = "root";
		$this->setBaseNombre("proyecto_visitas");
		$this->conexion = $this->conectar();
	}


	/* Muestra todas las variables de la clase */ 
	function mostrarTodo(){

		$mensaje = "El contador tiene ".$this->numeroVisitas." y es para la ruta ".$this->nombreRuta." en ".$this->fecha."<br>";

		return $mensaje;
	}
	/*Incrementa una visita parcial (las del boton) */
	function incrementarContadorUno(){
		$this->numeroVisitas++;
	}
	/* Incrementar un numero de visitas determinado */ 
	function incrementarContadorMas($nuevosVisitantes){
		$this->numeroVisitas = $this->numeroVisitas + $nuevosVisitantes;
	}
	/* Numero de visitas en total de una ruta */
	function contadorTotalRuta($ruta){
		
		$conecto=$this->consultar("SELECT SUM(numeroVisitas) AS sumaTotal FROM rutascontador WHERE nombre='".$ruta."'");
		return 	$this->f_fila($conecto)->sumaTotal;
	}
	/* Consulta cual es el ID de una ruta poniendo el nombre de la ruta */
	function consultarIDRuta($ruta){
		$conecto=$this->consultar("SELECT * FROM ruta WHERE nombre='".$ruta."'");
		return $this->f_fila($conecto)->id_ruta;

	}
	/* Inserta un contador en la base de datos */
	function insertarContadorBD(){

		if ($this->consultarIDRuta($this->nombreRuta)!="NULL"){
			$preparar = "INSERT INTO contador_diario (id_contadord,fk_ruta,fecha,numeroVisitas) VALUES (NULL,'".$this->consultarIDRuta($this->nombreRuta)."',current_timestamp(),'".$this->numeroVisitas."')";
			$this->consultar($preparar);
			return "enviado con exito";

		}else{
			return "ha ocurrido un error";
		}		
		
	}

	function agregarContador($numeroVisitas,$fk_ruta){
		$sentencia = "INSERT INTO contador (id_contadord,numeroVisitas,fk_ruta) VALUES (NULL,".$numeroVisitas.",".$fk_ruta.")";
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Contador agregado";
		}else{
			return "Hubo un error al agregar";
		}
	}
	function modificarContador($id_contadord,$numeroVisitas,$fk_ruta){ 
		$sentencia = "UPDATE contador SET numeroVisitas='".$numeroVisitas."',fk_ruta=".$fk_ruta." WHERE id_contadord=".$id_contadord;
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Contador modificado correctamente";
		}else{
			return "Hubo un error al modificar el contador";
		}	
	}
	function eliminarContador($id_contadord){
		$sentencia = "DELETE FROM contador WHERE id_contadord=".$id_contadord;
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Contador eliminado correctamente";
		}else{
			return "Hubo un error al eliminar el contador";
		}

	}
}


?>