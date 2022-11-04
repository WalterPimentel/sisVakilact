<?php

class UserSession{

    public function __construct(){
        session_start();        
    }

    public function setCurrentUser($correo){
        $_SESSION['CORREO'] = $correo;
    }

    public function getCurrentUser(){
        return $_SESSION['CORREO'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }

    Public function closeSessionAuto(){        
        $fechaGuardada = $_SESSION['ultimoAcceso'];
        $ahora = date('Y-n-j H:i:s');
        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
        if($tiempo_transcurrido >= 3600) {            
            session_unset();
            session_destroy();            
            header('location: ../index.php');
        }else{
           $_SESSION['ultimoAcceso'] = $ahora;
        }
    }
}

?>