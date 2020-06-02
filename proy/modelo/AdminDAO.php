<?php
namespace Modelo\AdminDAO; 


class AdminDAO{

    public $usuario;
    public $creado_el;
    public $actualizado_el; 
    public $email; 
    public $id_admin;
    public $nombre; 
    
    public function  __constructor($id_admin,$usuario,$nombre,$email,$creado_el,$actualizado_el){
        $this->usuario          = $usuario;
        $this->creado_el        = $creado_el;
        $this->actualizado_el   = $actualizado_el;
        $this->id_admin         = $id_admin;
        $this->email            = $email;
        $this->nombre           = $nombre;
    }

}