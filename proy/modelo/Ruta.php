<?php
namespace Proyecto\Modelo;

use Proyecto\Controlador\mysql as mysql; 


class Ruta{
	
	private $conexion; 
	private $nuevo; 
	function __construct(){
		$this->nuevo = new mysql();
		$this->conexion = $this->nuevo->conectar();
	}

	function setNombre($nombre){
		$this->nombre = $nombre;
	}
	function setOrigen($origen){
		$this->origen = $origen;
	}
	//listar rutas por portal
	function listarEstacionesPorPortal($origen){
		$sentencia = "SELECT * FROM ruta 
		LEFT JOIN portal ON (ruta.fk_destino=portal.id_portal) 
		WHERE fk_origen=".$origen." OR fk_transito=".$origen;
		$conectado = $this->nuevo->consultar($sentencia);
		$arreglo = $this->nuevo->f_todo($conectado);
		return $arreglo;

	}

	function agregarRuta($nombre,$fk_origen,$fk_destino){
		$sentencia = "INSERT INTO ruta (id_ruta,nombre,fk_origen,fk_destino) VALUES 
		(NULL,".$nombre.",".$fk_origen.",".$fk_destino.")";
		$conectado = $this->nuevo->consultar($sentencia);
		if ($conectado){
			return "Ruta agregada";
		}else{
			return "Hubo un error al agregar";
		}
	}
	function modificarRuta($id_ruta,$nombre,$fk_origen,$fk_destino){ 
		$sentencia = "UPDATE ruta SET nombre='".$nombre."',fk_origen=".$fk_origen.",fk_destino=".$fk_destino." 
		WHERE id_ruta=".$id_ruta;
		$conectado = $this->nuevo->consultar($sentencia);
		if ($conectado){
			return "Ruta modificada correctamente";
		}else{
			return "Hubo un error al modificar la Ruta";
		}	
	}
	function eliminarRuta($id_ruta){
		$sentencia = "DELETE FROM ruta WHERE id_ruta=".$id_ruta;
		$conectado = $this->nuevo->consultar($sentencia);
		if ($conectado){
			return "Ruta eliminada correctamente";
		}else{
			return "Hubo un error al eliminar la Ruta";
		}

	}



}
