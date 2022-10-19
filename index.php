<?php

include_once 'includes/admin.php';
include_once 'includes/admin_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['NOMBRE'])){

    $user->setUser($userSession->getCurrentUser());
    include_once 'gestion/home.php';

}else if(isset($_POST['username']) && isset($_POST['password'])){

    $correoForm = $_POST['username']; //es el imput de correo en realidad, cambiar nombre a correo
    $passForm = $_POST['password'];

    if($user->userExists($correoForm, $passForm)){

        $userSession->setCurrentUser($correoForm);
        $user->setUser($correoForm);

        include_once 'gestion/home.php';

    }else {

        $errorLogin = "Correo y/o contraseña es incorrecto";
        include_once 'gestion/login.php';
    }

}else{    
    include_once 'gestion/login.php';
}

?>