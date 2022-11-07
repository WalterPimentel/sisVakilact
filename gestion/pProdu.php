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

        if($_SESSION['ID_ROL'] == 3){
            require_once 'mProdu.php';            
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
                            <img onclick = "location='productos.php'" class="imgPrincipal" src="../imagenes/productos.png">
                            <img onclick = "location='productos_in.php'" class="imgPrincipal" src="../imagenes/productos_in.png">
                            <img onclick = "location='proveedores.php'" class="imgPrincipal" src="../imagenes/proveedores.png">
                        </td>
                    </tr>
                    <tr>
                        <td>                            
                            <img onclick = "location='insumos.php'" class="imgPrincipal" src="../imagenes/insumos.png">
                            <img onclick = "location='insumos_in.php'" class="imgPrincipal" src="../imagenes/insumos_in.png">
                            <img onclick = "location='insumos_out.php'" class="imgPrincipal" src="../imagenes/insumos_out.png">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>