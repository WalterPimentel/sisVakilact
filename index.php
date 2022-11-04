<?php

include_once 'includes/db.php';
include_once 'includes/admin.php';
include_once 'includes/admin_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['CORREO'])){

    $user->setUser($userSession->getCurrentUser());

    switch($_SESSION['ID_ROL']){
        case 1:           
            header('location: gestion/home.php');
        break;

        case 2:            
            header('location: gestion/principal.php');
        break;

        default:
    }

}else if(isset($_POST['username']) && isset($_POST['password'])){
    $correoForm = $_POST['username'];
    $passForm = $_POST['password'];

    $db = new DB();
    $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE CORREO = :username AND PASS = :password');
    $query->execute(['username' => $correoForm, 'password' => md5($passForm)]);

    $row = $query->fetch(PDO::FETCH_NUM);
    
    if($row == true){
        
        if($user->userExists($correoForm, $passForm)){

            $rol = $row[11];
            $userSession->setCurrentUser($correoForm);
            $user->setUser($correoForm);
            $_SESSION['ID_ROL'] = $rol;
            $_SESSION['ultimoAcceso']= date('Y-n-j H:i:s');

            switch($rol){
                case 1:                    
                    header('location: gestion/home.php');
                break;

                case 2:                    
                    header('location: gestion/principal.php');
                break;

                default:
            }

        }else{

        $errorLogin = "Correo y/o contraseña es incorrecta.";
        include_once 'gestion/login.php';
        }
        
    }else{
        
        $errorLogin = "Correo y/o contraseña es incorrecto.";
        include_once 'gestion/login.php';
    }

}else{    
    require_once 'gestion/login.php';
}