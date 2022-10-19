
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
}

?>