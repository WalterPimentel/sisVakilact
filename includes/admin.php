<?php

include_once 'db.php';

class User extends DB{

    private $nombre;
    private $correo;

    public function userExists($correo,  $pass){

        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE CORREO = :correo AND PASS = :pass');
        $query->execute(['correo' => $correo, 'pass' => $pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($correo){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE CORREO = :correo');
        $query->execute(['correo' => $correo]);

        foreach ($query as $currentUser){  
            $this->idAdmin = $currentUser['ID_USER'];
            $this->nombre = $currentUser['NOMBRE'];
            $this->apellido_p = $currentUser['APELLIDO_P'];
            $this->apellido_m = $currentUser['APELLIDO_M'];
            $this->sede = $currentUser['ID_SEDE'];
            $this->puesto = $currentUser['ID_ROL'];
            $this->correo = $currentUser['CORREO'];
        }
    }

    public function getIdAdmin(){
        return $this->idAdmin;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido_p(){
        return $this->apellido_p;
    }
    public function getApellido_m(){
        return $this->apellido_m;
    }
    public function getSede(){
        return $this->sede;
    }
    public function getPuesto(){
        return $this->puesto;
    }
    public function getCorreo(){
        return $this->correo;
    }
}
?>