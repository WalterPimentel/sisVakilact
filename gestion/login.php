<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="imagenes/icono-logo.png">
    <title>Iniciar Sesión</title>

    <link rel="stylesheet" href="estilos/estilos.css">
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
<body>
    <form action="" method="POST">
        <br>
        <br>
        <br>
        <div class="divLogin" style="background-color: #ccc; width: 360px; margin: auto;">
            <br>
            <h2>Iniciar sesión</h2>
            <img src="imagenes/logo.png">
            <p>Correo: <br>
            <input type="text" name="username"></p>
            <p>Contraseña: <br>
            <input type="password" name="password"></p>
            <p class="center"><input type="submit" value="Iniciar Sesión"></p>
            <?php
            if(isset($errorLogin)){
                echo $errorLogin;
            }
            ?>
            <br>
            <br>
        </div>
    </form>
</body>
</html>