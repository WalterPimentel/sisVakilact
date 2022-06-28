<?php
function ConectarBD(){    
    
    $conexion = null;
    $nombreUser = "root";
    $password = "M]Z8FSDH6uNdo2Rp";

    try{

        $conexion = new PDO("mysql:host=localhost;dbname=dbvakilact",$nombreUser,$password);

    }catch(PDOException $e){

        echo "(Error al conectar con la base de datos): ".$e;
        exit;
        
    }
    return $conexion;
}

function miConexionBD(){
    
    $servidor = 'localhost';
    $BD='dbvakilact';
    $nombreUser = "root";
    $password = "M]Z8FSDH6uNdo2Rp";

    $conexion = new mysqli($servidor, $nombreUser, $password, $BD);

    if($conexion-> connect_error){

        die("Conexión fallida: " . $conexion-> connect_error);

    }
    return $conexion;
}
?>