<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="imagenes/icono-logo.png">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos/estilos.css">    
</head>
<body class="bodyLogeo">
    <form action="" method="POST">
        <div class="divLogin">
            <br>
            <h2>Iniciar sesión</h2>
            <img src="imagenes/logo.png">
            </p></p>
            <input type="text" name="username" placeholder="Ingrese su correo@dominio" class="txtEspecial"></p>
            <input type="password" name="password" placeholder="Ingrese su contraseña" class="txtEspecial" ingr></p>
            <p class="center"><input class="btnSession" type="submit" value="Iniciar Sesión"></p>
            <p style="color:#FF0000;">&nbsp;
            <?php
            
            if(isset($errorLogin)){
                echo $errorLogin;
            }
            ?>
            &nbsp;</p></p>
            <a href="gestion/cambioPass.php" class="link">¿Olvido su contraseña?</a>
            <br>            
            <br>
        </div>
    </form>
</body>
</html>