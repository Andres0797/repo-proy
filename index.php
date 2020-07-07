<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Proyecto\Modelo\Portal as Portal;
use \Proyecto\Modelo\Ruta as Ruta;
use \Proyecto\Modelo\Contador as Contador;
use \Proyecto\Modelo\Administrador;
use \Proyecto\Modelo\AdminDAO;
use \Tuupola\Middleware\JwtAuthentication as JwtAuth;
use \Dotenv\Dotenv;
require 'vendor/autoload.php';


// Defino guardias de autenticacion 
$app = new \Slim\App();
$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

// Seccion de Middleware
$app->add(new JwtAuth([
    "path" => ["/auth"],
    "ignore" => ["/auth/login","/auth/logout","/auth/registro"],
    "relaxed" => ["localhost"],
    "secret" => getenv("LLAVE_JWT") 

]));
// REGLAS CORS
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
// Fin de Middleware


//Lista los portales que tienen rutas, es decir, portales de origen
$app->get('/auth/prueba', function (Request $request, Response $response) {
    
    $response->getBody()->write("Prueba");
	return $response->withstatus(200);
});
$app->post('/auth/login', function (Request $request, Response $response) {
    $adminObj = new Administrador();
    $datos = $request->getParsedBody();
    try {
        $contenido = $adminObj->getUsuario($datos["username"],$datos["password"])->obtenerTodo();
        $respuesta = $response->withJson($contenido,200);
    } catch (\Throwable $e) {
        $respuesta =  $response->withJson(array('error' => 401, 'mensaje' => $e->getMessage()),401);
    }
    return $respuesta;
});
$app->get('/auth', function (Request $request, Response $response) {
    $adminObj   = new Administrador();
    $token      = $request->getAttribute("token");
    
    try {
        $id_admin        = $adminObj->getIdUsuario($token["data"]->usuario);
        $usuarioCompleto = $adminObj->getDatosUsuario($id_admin);
        $respuesta = $response->withJson($usuarioCompleto->obtenerTodo(),200);
    } catch (\Throwable $e) {
        $respuesta =  $response->withJson(array('error' => 401, 'mensaje' => $e->getMessage()),401);
    }
    return $respuesta;
});
$app->post('/auth/logout', function (Request $request, Response $response) {
    $adminObj = new Administrador();
    $datos = $request->getParsedBody();
    $response->getBody()->write(json_encode($adminObj->cerrarSesion()));
	return $response->withstatus(200);
});
$app->post('/auth/registro', function (Request $request, Response $response) {
    $adminObj = new Administrador();
    $datos = $request->getParsedBody();
    try {

        $usuarioRegistrado = $adminObj->setUsuario(
            $datos["nombreUsuario"],
            $datos["email"],
            $datos["password"],
            $datos["nombre"] 
        )->obtenerTodo();
        $respesta = $response->withJson($usuarioRegistrado,201);

    } catch (\Throwable $e) {
        $respuesta =  $response->withJson(array('error' => 401, 'mensaje' => $e->getCode()),401);
    }
    return $respuesta;
});
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