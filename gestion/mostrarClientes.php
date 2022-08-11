<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT DISTINCT NOMBRE FROM clientes WHERE ID_CLIENTE < '2147483647' ";
    $ejecutarConsulta=mysqli_query($miconex, $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){
        $nom=$fila['NOMBRE'];
        $consulta2="SELECT ID_CLIENTE FROM clientes WHERE NOMBRE ='$nom' AND ID_CLIENTE < '2147483647' ";
        $ejecutarConsulta2=mysqli_query($miconex, $consulta2);
        $fila2 = mysqli_fetch_array($ejecutarConsulta2);
    ?>
    <option value="<?php echo $fila2['ID_CLIENTE'] ?>"><?php echo $fila['NOMBRE'] ?></option>
    <?php        
    }    
?>