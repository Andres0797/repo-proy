<?php
namespace Modelo\Administrador;

class Administrador extends mysql{

    private $usuario; 
    private $email; 
    private $password; 
    private $nombre; 


    public static function conUsuario( $usuario ){
        $instancia = new self(); 
        return $instancia->listarPorUsuario(); 
    }

    private function getUsuario($usuario,$password){ return; }

    private function setUsuario($usuario,$email,$password,$nombre){}

    private function modificarUsuario($id){ return ; }

    private function eliminarUsuario($id){ return ; }

}

    


?>