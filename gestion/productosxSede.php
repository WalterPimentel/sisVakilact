<!DOCTYPE html>
<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT * FROM ingreso_prodt";
    $ejecutarConsulta=mysqli_query($miconex, $consulta);
    ?>
    <link rel="stylesheet" href="../estilos/estilos.css">
    <fieldset class="containerGestion">
        <h2>Venta Cuerpo</h2>
        <article>
            <section>
                <div>
                    <table border="1">
                        <tbody>
                            <?php                    

                            $idsede=$_GET['c'];
                            $scriptSelectNombreSedes="SELECT NOMBRE FROM SEDES WHERE ID_SEDE = '$idsede'";

                            $nomSede=$miconex->query($scriptSelectNombreSedes);
                            $nombreSede=$nomSede->fetch_assoc();

                            ?>
                            <tr bgcolor="4C4C4C" style="color: white;">
                                <td colspan="5">Productos disponibles en <?php echo $nombreSede['NOMBRE'];?></td>
                                <td rowspan="2">Cantidad</td>
                                <td rowspan="2">Precio</td>
                            </tr>
                            <tr bgcolor="4C4C4C" style="color: white;">
                                <td colspan="2">&nbsp;Seleccione producto a vender&nbsp;</td>
                                <td>&nbsp;Stock&nbsp;</td>
                                <td>&nbsp;¿Venta al Menor?&nbsp;</td>
                                <td>&nbsp;¿Venta al Mayor?&nbsp;</td>
                            </tr>
                            <?php                            
                            $r=1;
                            while($fila = mysqli_fetch_array($ejecutarConsulta) and $r>=1){
                                
                                $iprod=$fila['ID_PRODUCTO'];                                
                                
                                $scripSelectNombreProduct="SELECT NOMBRE, STOCK, ID_PRODUCTO FROM productos_terminados WHERE ID_PRODUCTO = '$iprod'";
                                $resultado2 = $miconex->query($scripSelectNombreProduct);
                                $columNombre = $resultado2->fetch_assoc(); 
                                if($fila['ID_SEDE']==$_GET['c']){
                                    ?>
                                    <tr bgcolor = "<?php if(intval($r)%2==0) echo 'E6E6E6';else echo 'white' ?>">
                                        <td style="display: none;"><?php $r++; ?></td>
                                        <td><input type="checkbox" class="rbcbx" value="<?php echo $columNombre['ID_PRODUCTO']; ?>"></td>
                                        <td><?php echo $columNombre['NOMBRE']; ?></td>
                                        <td>&nbsp;<?php echo $columNombre['STOCK'];?>&nbsp;</td>
                                        <form method="POST" action="ventas.php" target="_blank">
                                            <td><label><input class="rbcbx" name="<?php echo $columNombre['ID_PRODUCTO'];?>" type="radio" value="<?php echo intval($fila['PRECIO_VENTAMIN']);?>" checked>S/. <?php echo $fila['PRECIO_VENTAMIN'];?></label></td>
                                            <td><label><input class="rbcbx" name="<?php echo $columNombre['ID_PRODUCTO'];?>" type="radio" value="<?php echo intval($fila['PRECIO_VENTAMAX']);?>">S/. <?php echo $fila['PRECIO_VENTAMAX'];?></label></td>                                            
                                        </form>
                                        <td>
                                            <form>
                                                <select name="slctCant" id="slctCant" onclick="CalcPrice(this.value)">
                                                    
                                                    <?php
                                                    $cant=0; 
                                                    while($cant < intval($columNombre['STOCK'])){
                                                        $cant++;
                                                        ?>
                                                        <option style="background-color: <?php if($cant%2==0){ echo "rgb(230, 230, 230);";}else{ echo "white;";} ?>" value="<?php echo $cant; ?>"><?php echo $cant; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <div id="calc">
                                                
                                            </div>                                                      
                                        </td>
                                        <td>
                                            <form method="POST" >
                                            &nbsp;<button type="submit" value="<?php echo $columNombre['ID_PRODUCTO']; ?>" name="btnChk" id="btnChk">&#10004;</button>&nbsp;
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            $nomSede->close();
                            $resultado2->close();
                            mysqli_close($miconex);
                            ?>
                            <tr bgcolor="4C4C4C" style="color: white;">
                                <td colspan="6">Precio Total</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <button>Registrar Venta</button>
                                    <button>Cancelar</button>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
            </section>
        </article>
    </fieldset>