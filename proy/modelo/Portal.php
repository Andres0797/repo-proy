<?php
namespace Proyecto\Modelo;

use Proyecto\Controlador\mysql as mysql;
use Proyecto\Modelo\Ruta as ruta;
//require_once('../controlador/mysql.php');

class Portal extends mysql{



	function __construct(){
		$this->usuario = "root";
		$this->setBaseNombre("proyecto_visitas");
		$this->conexion = $this->conectar();
	}
	function listarTodo(){
		$sentencia = "SELECT * FROM portal";
		$conectado = $this->consultar($sentencia);
		$arreglo = $conectado->fetch_all();
		$conectado->free();
		return $arreglo;
	}
	function listarOrigenes(){
		
		$sentencia = "SELECT DISTINCT fk_origen FROM ruta";
		$conectado = $this->consultar($sentencia);
		$arreglo = $conectado->fetch_all();
		$arregloFinal=[];
		foreach ($arreglo as $llave => $valor) {

			$idunico = $this->listarPorId($arreglo[$llave][0]);
			$arregloFinal[$llave]["id"]		=$idunico["general"]["id_portal"];
			$arregloFinal[$llave]["nombre"]	=$idunico["general"]["nombre"] ;
		}
		
		return json_encode($arregloFinal);
	}

	// Obtiene datos de un portal especifico por ID y sus rutas
	// si tiene rutas dependientes
	function listarPorId($id_portal){
		$sentencia = "SELECT * FROM portal WHERE id_portal=".$id_portal;
		$conectado = $this->consultar($sentencia);
		$arreglo = $conectado->fetch_all();
		$arreglado = [];
		$objRuta = new Ruta();
		$tablaRutas = $objRuta->listarEstacionesPorPortal($id_portal);
		$arreglado["general"]["id_portal"]  = $arreglo[0][0];
		$arreglado["general"]["nombre"] 	= $arreglo[0][1];
		$arreglado["general"]["esPortal"] 	= $arreglo[0][2];
		$arreglado["general"]["img"] 		= $arreglo[0][3];
		foreach ($tablaRutas as $llave => $valor) {
			$arreglado["rutas"][$llave]["id_ruta"] 		=  $tablaRutas[$llave][0];
			$arreglado["rutas"][$llave]["nombre"]  		=  $tablaRutas[$llave][1];
			$arreglado["rutas"][$llave]["nombre"]  		=  $tablaRutas[$llave][1];
			$arreglado["rutas"][$llave]["destino"]  	=  $tablaRutas[$llave][6];
		}
		$conectado->free();
		return $arreglado;
	}
	//agregar no recibe id
	function agregarEstacion($nombre,$esPortal){
		$sentencia = "INSERT INTO portal (id_portal,nombre,esPortal) VALUES (NULL,".$nombre.",".$esPortal.")";
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Estacion agregada";
		}else{
			return "Hubo un error al agregar";
		}
	}
	function modificarEstacion($id_portal,$nombre,$esPortal){ 
		$sentencia = "UPDATE portal SET nombre='".$nombre."',esPortal=".$esPortal." WHERE id_portal=".$id_portal;
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Estacion modificada correctamente";
		}else{
			return "Hubo un error al modificar la estacion";
		}	
	}
	function eliminarEstacion($id_portal){
		$sentencia = "DELETE FROM portal WHERE id_portal=".$id_portal;
		$conectado = $this->consultar($sentencia);
		if ($conectado){
			return "Estacion eliminada correctamente";
		}else{
			return "Hubo un error al eliminar la estacion";
		}

	}




}
