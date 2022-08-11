<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT * FROM sedes";
    $ejecutarConsulta=mysqli_query($miconex, $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){
    ?>
    <option style="background-color: <?php if(intval($fila['ID_SEDE'])%2==0){ echo "rgb(230, 230, 230);";}else{ echo "white;";} ?>" value="<?php echo $fila['ID_SEDE'] ?>"><?php echo $fila['NOMBRE'] ?></option>
    <?php        
    }    
?>