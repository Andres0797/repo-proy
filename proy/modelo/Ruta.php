<?php
namespace Proyecto\Modelo;

use Proyecto\Controlador\mysql as mysql; 


class Ruta extends mysql{

	

	function __construct(){
		$this->usuario = "root";
		$this->setBaseNombre("proyecto_visitas");
		$this->conexion = $this->conectar();
	}

	function setNombre($nombre){
		$this->nombre = $nombre;
	}
	function setOrigen($origen){
		$this->origen = $origen;
	}
	//listar por id
	function listarEstacionesPorPortal($origen){
		$sentencia = "SELECT * FROM ruta WHERE fk_origen=".$origen;
		$conectado = $this->consultar($sentencia);
		$arreglo = $conectado->fetch_all();
		$conectado->free();
		return $arreglo;

	}

	function agregarRuta($nombre,$fk_origen,$fk_destino){
		$sentencia = "INSERT INTO ruta (id_ruta,nombre,fk_origen,fk_destino) VALUES 
		(NULL,".$nombre.",".$fk_origen.",".$fk_destino.")";
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Ruta agregada";
		}else{
			return "Hubo un error al agregar";
		}
	}
	function modificarRuta($id_ruta,$nombre,$fk_origen,$fk_destino){ 
		$sentencia = "UPDATE ruta SET nombre='".$nombre."',fk_origen=".$fk_origen.",fk_destino=".$fk_destino." 
		WHERE id_ruta=".$id_ruta;
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Ruta modificada correctamente";
		}else{
			return "Hubo un error al modificar la Ruta";
		}	
	}
	function eliminarRuta($id_ruta){
		$sentencia = "DELETE FROM ruta WHERE id_ruta=".$id_ruta;
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Ruta eliminada correctamente";
		}else{
			return "Hubo un error al eliminar la Ruta";
		}

	}



}
