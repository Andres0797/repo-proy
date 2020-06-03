<?php
namespace Proyecto\Modelo; 


class AdminDAO{

    public $nombreUsuario;
    public $creado_el;
    public $actualizado_el; 
    public $email; 
    public $id_admin;
    public $nombre; 
    public $token;
    
    /*
    public function  __constructor($id_admin,$nombreUsuario,$nombre,$email,$creado_el,$actualizado_el,$token){
        $this->nombreUsuario    = $nombreUsuario;
        $this->creado_el        = $creado_el;
        $this->actualizado_el   = $actualizado_el;
        $this->id_admin         = $id_admin;
        $this->email            = $email;
        $this->nombre           = $nombre;
        $this->token            = $token;
    }
    */
    
    public function obtenerTodo(){ 
        return [
            "id_admin"              => $this->id_admin,
            "nombreUsuario"         => $this->nombreUsuario,
            "nombre"                => $this->nombre,
            "email"                 => $this->email,
            "creado_el"             => $this->creado_el,
            "actualizado_el"        => $this->actualizado_el,
            "token"                 => $this->token

        ];
    }

}