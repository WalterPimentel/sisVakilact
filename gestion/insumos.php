<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title >Insumos</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>    
    <body>
        <?php                                                           
            require_once("../index.php");
            $scriptSelectInsum = "SELECT * FROM insumos ORDER BY ID_SEDE ASC";
        ?>                                                    
        <div class="divGeneral" style="margin-top: 100px;">            
            <div class="divGestion">                            
                    <div class="divRegsitro">
                        <form action="insumos.php" method="POST">
                            <h1>Gestión Insumos</h1>
                            <fieldset class="containerGestion">
                                <article>
                                    <section>                                    
                                        <?php 
                                            if (!isset($_REQUEST['btnEditar'])){                                            
                                        ?>
                                        <table>
                                            <tr>
                                                <input type="hidden" name="txtID">
                                                <td class="tdGestion">Fecha de Registro<input type="date" name="txtFechaIngreso" id="fechaActual"></td>
                                                <td class="tdGestion">Nombre<input type="text" name="txtNombre" required></td>
                                                <td class="tdGestion">Sede
                                                    <form>                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <?php
                                                            $scriptSelectSedes = "SELECT ID_SEDE, NOMBRE FROM sedes";                                                                                                
                                                            $stmt = $conectar->prepare($scriptSelectSedes);
                                                            $ejecucion = $stmt->execute();
                                                            $datos=$stmt->fetchAll(\PDO::FETCH_OBJ);                                              
                                                            foreach($datos as $dato){                                                                                                                             
                                                                ?>
                                                                <option style="background-color: <?php if(intval($dato->ID_SEDE)%2==0){ echo "rgb(230, 230, 230);";}else{ echo "white;";} ?>" value="<?php print($dato->ID_SEDE);  ?>"><?php print($dato->NOMBRE); ?></option>
                                                                <?php                                                            
                                                            }
                                                            $stmt=null;
                                                            $conectar=null;
                                                            ?>
                                                        </select>
                                                    </form>
                                                </td>                                                                                                                                                                                                                                    
                                            </tr>
                                            <tr>                                                 
                                                <td class="tdGestion">Unidad de Medida<input type="text" name="txtUM"></td>
                                                <td class="tdGestion">Precio de Compra<input type="text" name="txtPC"></td> 
                                            </tr>                                            
                                            <tr>
                                                <td class="tdGestion" colspan="3">
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones">
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones" disabled>
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                            </tr>
                                        </table>
                                                    <?php 
                                                    }elseif(isset($_REQUEST['btnEditar'])){                                    
                                                        $IDINSUMO = $_POST['btnEditar'];
                                                        $scriptSelectInsumporID = "SELECT * FROM insumos WHERE ID_INSUMO ='$IDINSUMO'";                                             
                                                        $llenarDatosInsum = mysqli_query($miconex, $scriptSelectInsumporID);
                                                        $llenado = mysqli_fetch_assoc($llenarDatosInsum);
                                                    ?>
                                        <table>
                                            <input type="hidden" name="txtID" value="<?php echo $llenado['ID_INSUMO'];?>">                                            
                                            <tr>
                                                <td class="tdGestion">Fecha de Registro<input type="date" name="txtFechaIngreso" value="<?php echo $llenado['F_REGISTRO'];?>"></td>
                                                <td class="tdGestion">Nombre<input type="text" name="txtNombre" value="<?php echo $llenado['NOMBRE_PRODCUTO'];?>" required></td>
                                                <td class="tdGestion">Sede
                                                    <form>                                            
                                                        <select class="seleccion" name="slctSedes" disabled>
                                                            <?php
                                                                $scriptSelectSedesDef = "SELECT ID_SEDE, NOMBRE FROM sedes WHERE ID_SEDE = '$llenado[ID_SEDE]'";  
                                                                $stmt2 = mysqli_query($miconex, $scriptSelectSedesDef);
                                                                $llenado2 = mysqli_fetch_assoc($stmt2); 
                                                            ?>
                                                            <option value="<?php echo $llenado2['ID_SEDE'];  ?>" selected><?php echo $llenado2['NOMBRE']; ?></option>                                                            
                                                            <?php
                                                            $scriptSelectSedes = "SELECT ID_SEDE, NOMBRE FROM sedes WHERE NOT ID_SEDE = '$llenado[ID_SEDE]'";                                                                                                
                                                            $stmt = $conectar->prepare($scriptSelectSedes);
                                                            $ejecucion = $stmt->execute();
                                                            $datos=$stmt->fetchAll(\PDO::FETCH_OBJ);                                                
                                                            foreach($datos as $dato){
                                                                ?>
                                                                <option value="<?php print($dato->ID_SEDE);  ?>"><?php print($dato->NOMBRE); ?></option>
                                                                <?php                                                                  
                                                            }
                                                            $stmt=null;
                                                            $conectar=null;
                                                            ?>
                                                        </select>
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="tdGestion">Unidad de Medida<input type="text" name="txtUM" value="<?php echo $llenado['UNIDAD_MEDIDA'];?>"></td>
                                                <td class="tdGestion">Precio de Compra<input type="text" name="txtPC" value="<?php echo $llenado['PRECIO_COMPRA'];?>"></td>
                                            </tr>                                            
                                            <tr>
                                                <td class="tdGestion" colspan="3">
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                            </tr>
                                        </table>
                                                <?php
                                                    }
                                                ?>                                                                                                                               
                                    </section>
                                </article>
                            </fieldset>
                        </form>
                    </div>
                    <div class="divBuscar">
                        <form action="insumos.php" method="GET">
                            <input type="text" id="txtBuscar" class="txtBuscar" placeholder="Buscar por Nombre o Sede" maxlength="64">
                            <input type="submit" value="Buscar" name="btnBuscar" class="Botones">
                        </form>
                    </div>
                    <?php 
                        if (isset($_REQUEST['btnRegistrar'])){
                            $fechaIngreso = $_POST['txtFechaIngreso'];
                            $sede = $_POST['slctSedes'];
                            $nombre = $_POST['txtNombre'];
                            $UM = $_POST['txtUM'];
                            $PC = $_POST['txtPC'];
                            $stock = 0;                         
                            
                            $scriptInsertInsum = "INSERT INTO insumos (ID_SEDE, F_REGISTRO, NOMBRE_PRODCUTO, UNIDAD_MEDIDA, STOCk, PRECIO_VENTA, PRECIO_COMPRA)
                                                                VALUES('$sede', '$fechaIngreso', '$nombre', '$UM', '$stock', '$stock', '$PC')";

                            if(mysqli_query($miconex, $scriptInsertInsum) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se registraron correctamente");                                                                                
                                    e.preventDefault();                                                                   
                                    window.location.replace("insumos.php");                                    
                                </script>
                                <meta http-equiv="refresh" content="0;url=insumos.php">                                  
                    <?php                                
                            }else{
                                $error = mysqli_error($miconex)." Error número: ".mysqli_errno($miconex);
                                ?>                                
                                <script>
                                    alert("Error al Registrar datos: <?php echo $error; ?>");                                                   
                                </script>                                  
                                <?php
                            }                                                           
                        }                                                

                        if (isset($_REQUEST['btnModificar'])){
                            $id=$_POST['txtID'];
                            $fechaIngreso = $_POST['txtFechaIngreso'];
                            $nombre = $_POST['txtNombre'];
                            $UM = $_POST['txtUM'];
                            $PC = $_POST['txtPC'];                           

                            $scriptModificarInsum ="UPDATE insumos SET F_REGISTRO = '$fechaIngreso', NOMBRE_PRODCUTO = '$nombre', UNIDAD_MEDIDA = '$UM',
                                                                                        PRECIO_COMPRA = '$PC'
                                                                                WHERE ID_INSUMO = '$id'";

                            if(mysqli_query($miconex, $scriptModificarInsum) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se actualizaron correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.href("insumos.php");                                    
                                </script>  
                                <?php
                            }else{
                                $error = mysqli_error($miconex)." Error número: ".mysqli_errno($miconex);
                                ?>
                                <script>
                                    alert("Error al Modificar datos: <?php echo $error; ?>");                                                   
                                </script>                                  
                                <?php               
                            }  
                        }

                        if (isset($_REQUEST['btnEliminar'])){                            
                            $idInsumEliminar = $_POST['btnEliminar'];
                            $nombreEliminar= mysqli_query($miconex, "SELECT NOMBRE_PRODCUTO FROM insumos WHERE ID_INSUMO = '$idInsumEliminar'");
                            $llamarNombreEliminar = mysqli_fetch_assoc($nombreEliminar);                            
                            $scriptEliminarInsum = "DELETE FROM insumos WHERE ID_INSUMO = '$idInsumEliminar'";
                            if(mysqli_query($miconex, $scriptEliminarInsum) === true){
                                ?>
                                <script>
                                    alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE_PRODCUTO']; ?>, se borró correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("productos.php");                                    
                                </script>  
                                <?php
                            }else{
                                $error = ", ya que tiene varios registros de ingreso. Error número: ".mysqli_errno($miconex).". Se recomienda eliminar primero los registros en Ingreso de Productos";
                                ?>
                                <script>
                                    alert("Error al eliminar producto <?php echo $llamarNombreEliminar['NOMBRE_PRODCUTO']; echo $error; ?>");                                                   
                                </script>                                  
                                <?php               
                            }            
                        }

                        if($resultado = mysqli_query($miconex, $scriptSelectInsum)){                                                     
                                ?>
                            <div class="div_tabla" style="overflow: auto;">
                                <table border="1" class="tablaRegistros">
                                    <tr bgcolor="4C4C4C" style="color: white;">
                                        <td><b>&nbsp;ID</b>&nbsp;</td>
                                        <td><b>&nbsp;F. Registro&nbsp;</b></td>                                        
                                        <td><b>&nbsp;Nombre&nbsp;</b></td>
                                        <td><b>&nbsp;Sede</b>&nbsp;</td>
                                        <td><b>&nbsp;U.M.&nbsp;</b></td>
                                        <td><b>&nbsp;P. Compra&nbsp;</b></td>
                                        <td><b>&nbsp;Acción&nbsp;</b></td>
                                    </tr>                            
                            <?php
                            $c=1;
                            while ($fila = mysqli_fetch_assoc($resultado) and $c >= 1){
                                $idsede = $fila['ID_SEDE'];                                
                                $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                $resultado2 = mysqli_query($miconex, $scriptSelectNombreSedes);
                                $columSedes = mysqli_fetch_assoc($resultado2);                        
                            ?>                                                        
                                        <tr bgcolor = "<?php if(intval($c)%2==0) echo 'E6E6E6';else echo 'white' ?>">                                            
                                            <td style="display: none;"><?php $c++; ?></td>
                                            <td><b>&nbsp;<?php echo $fila['ID_INSUMO'];?>&nbsp;</b></td>
                                            <td>&nbsp;<?php echo $fila['F_REGISTRO'];?>&nbsp;</td>                                            
                                            <td>&nbsp;<?php echo $fila['NOMBRE_PRODCUTO'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $columSedes['NOMBRE'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['UNIDAD_MEDIDA'];?>&nbsp;</td>                                           
                                            <td>&nbsp;<?php echo "S/. ".$fila['PRECIO_COMPRA'];?>&nbsp;</td>
                                            <td class="tdBotonTabla">
                                                <form value="<?php echo $fila['ID_INSUMO'];?>" id="<?php echo $fila['ID_INSUMO'];?>" action='insumos.php' method='post'>
                                                    <button type="submit" id="<?php echo $fila['ID_INSUMO'];?>" value="<?php echo $fila['ID_INSUMO'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                                    <button type="submit" id="<?php echo $fila['ID_INSUMO'];?>" value="<?php echo $fila['ID_INSUMO'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                                            
                                                </form>
                                            </td>                                            
                                        </tr>
                                    
                            <?php
                            }?>	
                                </table>
                            </div>
                        <?php                    	                                            
                        }                                                
                        mysqli_close($miconex);
                        ?>              
            </div>
        </div>
    </body>
</html>