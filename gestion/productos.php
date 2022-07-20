<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title >Productos</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>    
    <body>
        <?php                                                           
            require_once("../index.php");
            $scriptSelectProduct = "SELECT * FROM productos_terminados ORDER BY NOMBRE ASC";
        ?>                                                    
        <div class="divGeneral" style="margin-top: 100px;">            
            <div class="divGestion">                            
                    <div class="divRegsitro">
                        <form action="productos.php" method="POST">
                            <h1>Gestión Productos</h1>
                            <fieldset class="containerGestion">
                                <article>
                                    <section>                                    
                                        <?php 
                                            if (!isset($_REQUEST['btnEditar'])){                                            
                                        ?>
                                        <table>
                                            <tr>
                                                <input type="hidden" name="txtID">
                                                <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" id="fechaActual"></td>
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
                                                                <option value="<?php print($dato->ID_SEDE);  ?>"><?php print($dato->NOMBRE); ?></option>
                                                                <?php                                                                 
                                                            }
                                                            $stmt=null;
                                                            $conectar=null;
                                                            ?>
                                                        </select>
                                                    </form>
                                                </td>                                                
                                                <td class="tdGestion">Unidad de Medida<input type="text" name="txtUM"></td>                                                                                     
                                            </tr>                                            
                                            <tr>
                                                <td class="tdGestion" colspan="5">
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones">
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones" disabled>
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                            </tr>
                                        </table>
                                                    <?php 
                                                    }elseif(isset($_REQUEST['btnEditar'])){                                    
                                                        $IDPRODUCT = $_POST['btnEditar'];
                                                        $scriptSelectProductporID = "SELECT * FROM productos_terminados WHERE ID_PRODUCTO ='$IDPRODUCT'";                                             
                                                        $llenarDatosProduct = $miconex->query($scriptSelectProductporID);
                                                        $llenado = $llenarDatosProduct->fetch_assoc();
                                                    ?>
                                        <table>
                                            <input type="hidden" name="txtID" value="<?php echo $llenado['ID_PRODUCTO'];?>">                                            
                                            <tr>
                                                <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" value="<?php echo $llenado['FECHA_INGRESO'];?>"></td>
                                                <td class="tdGestion">Nombre<input type="text" name="txtNombre" value="<?php echo $llenado['NOMBRE'];?>" required></td>
                                                <td class="tdGestion">Sede
                                                    <form>                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <?php
                                                                $scriptSelectSedesDef = "SELECT ID_SEDE, NOMBRE FROM sedes WHERE ID_SEDE = '$llenado[ID_SEDE]'";  
                                                                $stmt2 = $miconex->query($scriptSelectSedesDef);
                                                                $llenado2 = $stmt2->fetch_assoc(); 
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
                                                <td class="tdGestion">Unidad de Medida<input type="text" name="txtUM" value="<?php echo $llenado['UNIDAD_MEDIDA'];?>"></td>                                                
                                            </tr>                                            
                                            <tr>
                                                <td class="tdGestion" colspan="5">
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                            </tr>
                                        </table>
                                                <?php
                                                        $llenarDatosProduct->close();
                                                        $stmt2->close();
                                                    }
                                                ?>                                                                                                                               
                                    </section>
                                </article>
                            </fieldset>
                        </form>
                    </div>
                    <div class="divBuscar">
                        <form action="productos.php" method="GET">
                            <input type="text" id="txtBuscar" class="txtBuscar" placeholder="Buscar por DNI, apellido o nombre" maxlength="64">
                            <input type="submit" value="Buscar" name="btnBuscar" class="Botones">
                        </form>
                    </div>
                    <?php 
                        if (isset($_REQUEST['btnRegistrar'])){
                            $fechaIngreso = $_POST['txtFechaIngreso'];
                            $sede = $_POST['slctSedes'];
                            $nombre = $_POST['txtNombre'];
                            $UM = $_POST['txtUM'];
                            $stock = 0;                         
                            
                            $scriptInsertProduct = "INSERT INTO productos_terminados (ID_SEDE, FECHA_INGRESO, NOMBRE, UNIDAD_MEDIDA, STOCk)
                                                                VALUES('$sede', '$fechaIngreso', '$nombre', '$UM', '$stock')";

                            if($miconex->query($scriptInsertProduct) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se registraron correctamente");                                                                                
                                    e.preventDefault();                                                                   
                                    window.location.replace("productos.php");                                    
                                </script>
                                <meta http-equiv="refresh" content="0;url=productos.php">                                  
                    <?php                                
                            }else{
                                $error = $miconex->error." Error número: ".mysqli_errno($miconex);
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
                            $sede = $_POST['slctSedes'];
                            $nombre = $_POST['txtNombre'];
                            $UM = $_POST['txtUM'];                            

                            $scriptModificarProduct ="UPDATE productos_terminados SET ID_SEDE = '$sede', FECHA_INGRESO = '$fechaIngreso', NOMBRE = '$nombre', UNIDAD_MEDIDA = '$UM'
                                                                                WHERE ID_PRODUCTO = '$id'";

                            if($miconex->query($scriptModificarProduct) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se actualizaron correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("administradores.php");                                    
                                </script>  
                                <?php
                            }else{
                                $error = $miconex->error." Error número: ".mysqli_errno($miconex);
                                ?>
                                <script>
                                    alert("Error al Modificar datos: <?php echo $error; ?>");                                                   
                                </script>                                  
                                <?php               
                            }  
                        }

                        if (isset($_REQUEST['btnEliminar'])){                            
                            $idProductEliminar = $_POST['btnEliminar'];
                            $nombreEliminar= $miconex->query("SELECT NOMBRE FROM productos_terminados WHERE ID_PRODUCTO = '$idProductEliminar'");
                            $llamarNombreEliminar = $nombreEliminar->fetch_assoc();                            
                            $scriptEliminarProduct = "DELETE FROM productos_terminados WHERE ID_PRODUCTO = '$idProductEliminar'";
                            if($miconex->query($scriptEliminarProduct) === true){
                                ?>
                                <script>
                                    alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE']; ?>, se borró correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("productos.php");                                    
                                </script>  
                                <?php
                            }else{
                                $error = ", ya que tiene varios registros de ingreso. Error número: ".mysqli_errno($miconex).". Se recomienda eliminar primero los registros en Ingreso de Productos";
                                ?>
                                <script>
                                    alert("Error al eliminar producto <?php echo $llamarNombreEliminar['NOMBRE']; echo $error; ?>");                                                   
                                </script>                                  
                                <?php               
                            }            
                            $nombreEliminar->close();
                        }

                        if($resultado = $miconex->query($scriptSelectProduct)){                                                     
                                ?>
                            <div class="div_tabla" style="overflow: auto;">
                                <table border="1" class="tablaRegistros">
                                    <tr bgcolor="4C4C4C" style="color: white;">
                                        <td><b>&nbsp;ID</b>&nbsp;</td>
                                        <td><b>&nbsp;Fecha de Registro&nbsp;</b></td>                                        
                                        <td><b>&nbsp;Nombre&nbsp;</b></td>
                                        <td><b>&nbsp;Sede</b>&nbsp;</td>
                                        <td><b>&nbsp;Unidad de Medida&nbsp;</b></td>
                                        <td><b>&nbsp;Stock&nbsp;</b></td>
                                        <td><b>&nbsp;Acción&nbsp;</b></td>
                                    </tr>                            
                            <?php
                            $c=1;
                            while ($fila = $resultado->fetch_assoc() and $c >= 1){
                                $idsede = $fila['ID_SEDE'];                                
                                $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                $resultado2 = $miconex->query($scriptSelectNombreSedes);
                                $columSedes = $resultado2->fetch_assoc();                        
                            ?>                                                        
                                        <tr bgcolor = "<?php if(intval($c)%2==0) echo 'E6E6E6';else echo 'white' ?>">                                            
                                            <td style="display: none;"><?php $c++; ?></td>
                                            <td><b>&nbsp;<?php echo $fila['ID_PRODUCTO'];?>&nbsp;</b></td>
                                            <td>&nbsp;<?php echo $fila['FECHA_INGRESO'];?>&nbsp;</td>                                            
                                            <td>&nbsp;<?php echo $fila['NOMBRE'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $columSedes['NOMBRE'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['UNIDAD_MEDIDA'];?>&nbsp;</td>                                           
                                            <td>&nbsp;<?php echo $fila['STOCK'];?>&nbsp;</td>
                                            <td class="tdBotonTabla">
                                                <!-- <form value="<?php // echo $fila['ID_PRODUCTO'];?>" id="<?php // echo $fila['ID_PRODUCTO'];?>" action='productos_in.php' method='POST'>
                                                    <button type="submit" id="<?php // echo $fila['ID_PRODUCTO'];?>" value="<?php // echo $fila['ID_PRODUCTO'];?>" name="btnAgregar" class="btnAgregarStock">Agregar Stock</button>
                                                </form> -->
                                                <form value="<?php echo $fila['ID_PRODUCTO'];?>" id="<?php echo $fila['ID_PRODUCTO'];?>" action='productos.php' method='post'>
                                                    <button type="submit" id="<?php echo $fila['ID_PRODUCTO'];?>" value="<?php echo $fila['ID_PRODUCTO'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                                    <button type="submit" id="<?php echo $fila['ID_PRODUCTO'];?>" value="<?php echo $fila['ID_PRODUCTO'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                                            
                                                </form>
                                            </td>                                            
                                        </tr>
                                    
                            <?php
                                $resultado2->close();
                            }?>	
                                </table>
                            </div>
                        <?php                    	                  
                            $resultado->close();                            
                        }                                                
                        
                        $miconex->close();
                        ?>              
            </div>
        </div>
    </body>
</html>