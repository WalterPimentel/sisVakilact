<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
    <title >Inicio</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
    <body>
        <?php
            require_once("../index.php");                                                                  
            if (isset($_REQUEST['btnCancelar'])){
        ?>
                <script>                 
                    e.preventDefault();                                                                   
                    window.location.replace("productos.php");
                </script>                                            
        <?php
            }
        ?>
    </body>
</html>