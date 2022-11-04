<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-logo.png">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../estilos/estilos.css">    
</head>
<body class="bodyLogeo">
    <form action="" method="POST">
        <br>
        <br>
        <br>
        <div class="divLogin">
            <a href="../index.php" class="linkAtras"><img src="../imagenes/btnAtras.png" class="imgAtras" align="left"></a>
            <br>
            <h2>Recuperar Contraseña</h2>
            <p><br>
            <input type="text" name="correo" placeholder="Ingrese su correo@dominio" class="txtEspecial"></p>
            <p>
            <input type="text" name="dni" placeholder="Ingrese su número de DNI" class="txtEspecial"></p>
            <p class="center"><input class="btnSession" type="submit" value="Recuperar" name="btnRecuperar"></p>
            <p style="color:#FF0000;">&nbsp;
            <?php
            if(isset($_POST['btnRecuperar'])){
                include_once '../includes/db.php';
                $db = new DB();
                $correoForm = $_POST['correo'];
                $dniForm = $_POST['dni'];
                $resultado=$db->connect()->prepare("SELECT CORREO, DNI FROM usuarios WHERE CORREO = :correo AND DNI = :dni;");
                $resultado->execute(['correo' => $correoForm, 'dni' => $dniForm]);
                $row = $resultado->fetch(PDO::FETCH_NUM);

                if ($row == true){                    
                    include_once 'passrandom.php';                
                    $contra = generatePassword(8);
                    $pass = md5($contra);
                    
                    $queryCambioPass=$db->connect()->prepare("UPDATE usuarios SET PASS = :pass WHERE CORREO = :correo AND DNI = :dni;");

                    if($queryCambioPass->execute(['pass' => $pass, 'correo' => $correoForm, 'dni' => $dniForm]) === true){
                        
                        $mensaje = "Un cordial saludo\r\n
                        Se acaba de solicitar recuperación de su contraseña del Sistema Web Vakilact\r\n
                        Ingrese a vakilact.pe con su nueva contraseña: ".$contra."\r\n
                        Si Usted no fue quien solicito este cambio, comuniquese inmediatamente con su Gerente";
                        $mensaje = wordwrap($mensaje, 150, "\r\n");                            
                        mail($correoForm, 'Lácteos Vakilact', $mensaje);
                        ?>
                        <meta http-equiv="refresh" content="0;url=../index.php">
                        <script>
                            alert("Se acaba de enviar un mensaje a su correo con su nueva contraseña.");                        
                        </script>                    
                        <?php                    
                        exit;
                    }
                }else{
                    echo "Correo y/o DNI incorrectos.";        
                }
            }
            ?>
            &nbsp;</p>            
        </div>
    </form>
</body>
</html>