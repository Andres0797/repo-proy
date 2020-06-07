<?php
namespace Proyecto\Modelo;
require $_SERVER['DOCUMENT_ROOT']. '\vendor\autoload.php';

use Proyecto\Controlador\mysql as mysql;
use Proyecto\Modelo\AdminDAO as AdminDAO;
 
// LIBRERIAS USADAS
use Dotenv\Dotenv;
use Firebase\JWT\JWT; 
use Ramsey\Uuid\Uuid;

class Administrador{

    private $nombreUsuario; 
    private $email; 
    private $password; 
    private $nombre;
    private $conexion;
    private $nuevo;
    private $dotenv;

    public function __construct(){
        $this->dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
        $this->dotenv->load();
        $this->nuevo = new mysql();
        $this->conexion = $this->nuevo->conectar();

    }
    
    private function validarNombreUsuario(string $nombreUsuario) : bool {
        $sentencia  = "SELECT * FROM administrador WHERE usuario='".$nombreUsuario."'";
        $ejecutar   = $this->nuevo->consultar($sentencia);
        if ($this->nuevo->f_total($ejecutar) < 1){
            return false;
        }
        return true;
    }
    private function validarCorreoElectronico(string $email) : bool {
        $sentencia  = "SELECT * FROM administrador WHERE email='".$email."'";
        $ejecutar   = $this->nuevo->consultar($sentencia);
        if ($this->nuevo->f_total($ejecutar) < 1){
            return false;
        }
        return true;
    }
    private function crearCookie(string $token,\DateTime $expiracion){

        setcookie("token",$token,$expiracion->getTimeStamp(),"/");

    }
    //CERRAR SESION 
    public function cerrarSesion(){
        $pasado = new \DateTime("10 days ago");
        setcookie("token","",$pasado->getTimeStamp(),"/");
    }
    // CREAR TOKEN CON FORMATO JWT
    private function setToken(string $usuario){
        $ahora  = new \DateTime(); 
        $futuro = new \DateTime(" now +3 minutes");
        $clave_privada = getenv("LLAVE_JWT");
        $alcance = ["usuario" => $usuario]; 
        $payload = [
            "iat"   => $ahora->getTimeStamp(),
            "exp"   => $futuro->getTimeStamp(),
            "aud"   => "http://localhost",
            "data" => $alcance
        ];
        $token = JWT::encode($payload,$clave_privada,"HS256");
        $this->crearCookie($token,$futuro); 
        return $token;
    }
    // INICIAR SESION
    public function getUsuario(string $usuario,string $password): AdminDAO{
        $sentenciaBusca = "SELECT * FROM administrador WHERE usuario='".$usuario."' LIMIT 1";
        $conectaBusca   = $this->nuevo->consultar($sentenciaBusca);
        $resultadoFilas = $this->nuevo->f_fila($conectaBusca);
        if (!$this->validarNombreUsuario($usuario) || !password_verify($password,$resultadoFilas->password)){
            throw new \Exception("Usuario/Contrasena incorrectos", 505);
        }
        // INICIO PROCESO DE INICIO DE SESION
        $token = $this->setToken($usuario);

        $daoCompleto                    = new AdminDAO();
        $daoCompleto->id_admin          =    $resultadoFilas->id_admin;
        $daoCompleto->nombreUsuario     =    $resultadoFilas->usuario;
        $daoCompleto->nombre            =    $resultadoFilas->nombre;
        $daoCompleto->email             =    $resultadoFilas->email;
        $daoCompleto->creado_el         =    $resultadoFilas->creado_el;
        $daoCompleto->actualizado_el    =    $resultadoFilas->actualizado_el;
        $daoCompleto->token             =    $token;

        return $daoCompleto;

    }
    // REGISTRAR USUARIO
    public function setUsuario(string $nombreUsuario,string $email,string $password,string $nombre) : AdminDAO{
        // GENERO UN ID UNICO PARA EL USUARIO DE FORMATO UUID
        $uuidObj            = Uuid::uuid4();
        $id_admin           = $uuidObj->toString();  

        // PROCESO DE VALIDACION 
        if (func_num_args() != 4){
            throw new \Exception("Todos los campos son obligatorios", 505);
        }
        else if ($this->validarNombreUsuario($nombreUsuario)){
            throw new \Exception("El Usuario ya existe y debe ser unico", 505);
        }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            throw new \Exception("El correo electronico no tiene un formato valido", 505);
        }else if($this->validarCorreoElectronico($email)){
            throw new \Exception("El correo electronico ya existe y debe ser unico", 505);
        }
        //  AHORA ENCRIPTO LA CONTRASENA CON UN ALGORITMO DE COSTO 7 
        $encriptado = password_hash($password,PASSWORD_BCRYPT,['cost' => 7]);

        // UNA VEZ SUPERADA LA VALIDACION INGRESA EL ADMIN A LA BASE DE DATOS
        $sentencia = "INSERT INTO administrador (id_admin,usuario,password,nombre,email,creado_el,actualizado_el) VALUES ('".$id_admin."','".$nombreUsuario."','".$encriptado."','".$nombre."','".$email."',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP())";
        $conectado = $this->nuevo->consultar($sentencia);
        if (!$conectado){
            throw new \Exception("Error al agregar el usuario a la base de datos", 505);
        }
        // UNA VEZ AGREGADO EL ADMIN A LA BASE DE DATOS, BUSCO EL ADMIN YA AGREGADO PARA DEVOLVERLO 
        $sentenciaBusca = "SELECT * FROM administrador WHERE id_admin='".$id_admin."' LIMIT 1";
        $conectaBusca   = $this->nuevo->consultar($sentenciaBusca);
        $resultadoBusca = $this->nuevo->f_fila($conectaBusca); 
        // ADEMAS DE LOS DATOS DEL ADMIN NORMAL TAMBIEN SE VA A DEVOLVER UN TOKEN JWT
        $token = $this->setToken($resultadoBusca->usuario);
        // ALMACENO TODOS LOS DATOS COMO PROPIEDADES DEL OBJ ADMINDAO Y HAGO EL RETURN
        $daoCompleto  = new AdminDAO();
        $daoCompleto->id_admin          =    $resultadoBusca->id_admin;
        $daoCompleto->nombreUsuario     =    $resultadoBusca->usuario;
        $daoCompleto->nombre            =    $resultadoBusca->nombre;
        $daoCompleto->email             =    $resultadoBusca->email;
        $daoCompleto->creado_el         =    $resultadoBusca->creado_el;
        $daoCompleto->actualizado_el    =    $resultadoBusca->actualizado_el;
        $daoCompleto->token             =    $token;
        
        return $daoCompleto;

    }


    private function modificarUsuario($id){ return ; }

    private function eliminarUsuario($id){ return ; }

}

    


?>