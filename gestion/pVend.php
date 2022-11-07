<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="../imagenes/icono-logo.png">
        <link rel="stylesheet" href="../estilos/estilos.css">
        <title >Usuarios</title>

    </head>
    <body>

        <?php

        include_once '../includes/conexiones.php';
        include_once '../includes/admin_session.php';
        include_once '../includes/admin.php';
        ?>
        <div style="display: none;">
        <?php

        $userSession = new UserSession();
        $user = new User();

        ?>
        </div>
        <?php

        if($_SESSION['ID_ROL'] == 2){
            require_once 'principal.php';
        }else{
            header("location: ../index.php");
        }

        ?>                
        <div class="divImg">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <h1 style="margin: auto;">Página Principal</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img onclick = "location='clientes.php'" class="imgPrincipal" src="../imagenes/clientes.png">
                            <img onclick = "location='ventas.php'" class="imgPrincipal" src="../imagenes/ventas.png">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </body>
</html>