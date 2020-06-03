<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Proyecto\Modelo\Portal as Portal;
use \Proyecto\Modelo\Ruta as Ruta;
use \Proyecto\Modelo\Contador as Contador;

require 'vendor/autoload.php';

$app = new \Slim\App;

//Lista los portales que tienen rutas, es decir, portales de origen
$app->get('/portal/origenes', function (Request $request, Response $response) {
    $portalObj = new Portal();
    $response->getBody()->write($portalObj->listarOrigenes());
	return $response->withstatus(200);
});

// Obtiene los valores de un portal segun su ID
$app->get('/portal/{id}', function (Request $request, Response $response,array $args) {
    $portalObj = new Portal();

    $response->getBody()->write(json_encode($portalObj->listarPorId($args['id'])));
	return $response->withstatus(200);
});

//Lista las estaciones pertenecientes a un portal 
$app->get('/ruta/{id}/portales', function (Request $request, Response $response,array $args) {
    $rutaObj = new Ruta();
    
    $arregloBD = $rutaObj->listarEstacionesPorPortal($args["id"]);
    $listaRutas=array();
    foreach ($arregloBD as $llave => $valor) {
    	$listaRutas[]=$arregloBD[$llave][1];
    }
    $listaRutas = json_encode($listaRutas);
	$response->getBody()->write($listaRutas);
	return $response->withstatus(200);
});

// Crea un objeto contador y lo sube a la base de datos, idealmente
// cada vez que se reinicie el contador
$app->post('/contador', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $contadorObj = new Contador($datos['visitas'],$datos['ruta']);
    $response->getBody()->write($contadorObj->insertarContadorBD());
    return $response->withstatus(200);
});




$app->run();


?>