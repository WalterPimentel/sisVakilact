<!DOCTYPE html>
<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT * FROM productos_terminados";
    $ejecutarConsulta=mysqli_query($miconex, $consulta);
    ?>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <div>
        <table border="1" class="tablaRegistros">
            <tbody>
                <?php                        
                $idsede=$_GET['c'];
                $scriptSelectNombreSedes="SELECT NOMBRE FROM SEDES WHERE ID_SEDE = '$idsede'";

                $nomSede=mysqli_query($miconex, $scriptSelectNombreSedes);
                $nombreSede=mysqli_fetch_assoc($nomSede);

                ?>
                <tr bgcolor="4C4C4C" style="color: white;">
                    <td colspan="7"><b>Productos Disponibles <?php echo "en ".$nombreSede['NOMBRE']; ?></b></td>
                </tr>
                <tr bgcolor="4C4C4C" style="color: white;">
                    <td><b>&nbsp;ID&nbsp;</b></td>
                    <td><b>&nbsp;Nombre&nbsp;</b></td>
                    <td><b>&nbsp;Stock&nbsp;</b></td>
                    <td><b>&nbsp;Precio de venta al menor&nbsp;</b></td>
                    <td><b>&nbsp;Precio de venta al mayor&nbsp;</b></td>
                    <td><b>&nbsp;Unidad de medida&nbsp;</b></td>                                
                </tr>
                <?php                            
                $r=1;
                while($fila = mysqli_fetch_array($ejecutarConsulta) and $r>=1){                                                    
                    
                    if($fila['ID_SEDE']==$_GET['c']){
                        ?>
                        <tr bgcolor = "<?php if(intval($r)%2==0) echo 'E6E6E6';else echo 'white' ?>">
                            <td style="display: none;"><?php $r++; ?></td>
                            <td><?php echo $fila['ID_PRODUCTO']; ?></td>
                            <td><?php echo $fila['NOMBRE']; ?></td>
                            <td>&nbsp;<?php echo $fila['STOCK'];?>&nbsp;</td>
                            <td>&nbsp;<?php echo $fila['PV_MIN'];?>&nbsp;</td>
                            <td>&nbsp;<?php echo $fila['PV_MAX'];?>&nbsp;</td>
                            <td>&nbsp;<?php echo $fila['UNIDAD_MEDIDA'];?>&nbsp;</td>
                        </tr>
                        <?php
                    }
                }
                mysqli_close($miconex);
                ?>
            </tbody>
        </table>
    </div>