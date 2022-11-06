<?php
function ConectarBD(){    
    
    $conexion = null;
    $nombreUser = "vakilact_root";
    //$nombreUser = "id19187202_root";    
    $password = "M]Z8FSDH6uNdo2Rp";

    try{

        $conexion = new PDO("mysql:host=localhost;dbname=vakilact_BD",$nombreUser,$password);
        //$conexion = new PDO("mysql:host=localhost;dbname=id19187202_dbvakilact",$nombreUser,$password);

    }catch(PDOException $e){

        echo "(Error al conectar con la base de datos): ".$e;
        exit;
        
    }
    return $conexion;
}

function miConexionBD(){
    
    $servidor = 'localhost';
    $BD='vakilact_BD';    
    $nombreUser = "vakilact_root";
    //$BD='id19187202_dbvakilact';
    //$nombreUser = "id19187202_root";
    $password = "M]Z8FSDH6uNdo2Rp";

    $conexion = new mysqli($servidor, $nombreUser, $password, $BD);

    if($conexion-> connect_error){

        die("Conexión fallida: " . $conexion-> connect_error);

    }
    return $conexion;
}
?>