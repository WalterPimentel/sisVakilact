<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title >Administradores</title>
        <link rel="stylesheet" href="../estilos/estilos.css">
    </head>
    <body>
        <?php                                                           
            require_once("../index.php");
            $scriptSelectAdmin = "SELECT * FROM administradores";
        ?>                                                        
        <div class="divGeneral">
            <div class="divGestion">                            
                <div class="divRegsitro">
                    <form action="administradores.php" method="POST">
                        <h1>Gestión Administradores</h1>
                        <fieldset class="containerGestion">                            
                            <article>
                                <section>
                                    <table>
                                        <tr>
                                            <?php 
                                                if (!isset($_REQUEST['btnEditar'])){                                            
                                            ?>
                                            <input type="hidden" name="txtID">
                                            <td class="tdGestion">DNI<input type="text" name="txtDNI" minlength="8" maxlength="8" pattern="[0-9]+" required></td>
                                            <td class="tdGestion">Nombre<input type="text" name="txtNombre" required></td>
                                            <td class="tdGestion">Apellido Paterno<input type="text" name="txtApelliedoPaterno" required></td>
                                            <td class="tdGestion">Apellido Materno<input type="text" name="txtApellidoMaterno"></td>
                                            <td class="tdGestion">Puesto<input type="text" name="txtPuesto"></td>
                                        </tr>
                                        <tr>
                                            <td class="tdGestion">Correo<input type="text" name="txtCorreo" placeholder="nombre@dominio.com"></td>
                                            <td class="tdGestion">Telefono<input type="text" name="txtTelefono" minlength="9" pattern="[0-9]+"></td>                                                                        
                                            <td class="tdGestion">Sede
                                                <form>                                            
                                                    <select class="seleccion" name="slctSedes">
                                                        <?php include "mostrarSedes.php" ?>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" id="fechaActual"></td>
                                            <td class="tdGestion">Fecha de Salida<input type="date" name="txtFechaSalida" disabled></td>
                                        </tr>
                                        <tr>
                                            <td class="tdGestion" colspan="5">
                                                <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones">
                                                <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones" disabled>
                                                <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                            </td>
                                                <?php 
                                                }elseif(isset($_REQUEST['btnEditar'])){
                                                    $IDADMIN = $_POST['btnEditar'];
                                                    $scriptSelectAdminporID = "SELECT * FROM administradores WHERE ID_ADMIN ='$IDADMIN'";                                             
                                                    $llenarDatosAdmin = $miconex->query($scriptSelectAdminporID);
                                                    $llenado = $llenarDatosAdmin->fetch_assoc();
                                                ?>
                                            <input type="hidden" name="txtID" value="<?php echo $llenado['ID_ADMIN'];?>">
                                            <td class="tdGestion">DNI<input type="text" name="txtDNI" value="<?php echo $llenado['DNI_RUC'];?>" require></td>
                                            <td class="tdGestion">Nombre<input type="text" name="txtNombre" value="<?php echo $llenado['NOMBRE'];?>" require></td>
                                            <td class="tdGestion">Apellido Paterno<input type="text" name="txtApelliedoPaterno" value="<?php echo $llenado['APELLIDO_P'];?>" ></td>
                                            <td class="tdGestion">Apellido Materno<input type="text" name="txtApellidoMaterno" value="<?php echo $llenado['APELLIDO_M'];?>"></td>
                                            <td class="tdGestion">Puesto<input type="text" name="txtPuesto" value="<?php echo $llenado['PUESTO'];?>"></td>
                                        </tr>
                                        <tr>
                                            <td class="tdGestion">Correo<input type="text" name="txtCorreo" value="<?php echo $llenado['CORREO'];?>"></td>
                                            <td class="tdGestion">Telefono<input type="text" minlength="9" pattern="[0-9]+" name="txtTelefono" value="<?php echo $llenado['TELEFONO'];?>"></td>                                                                        
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
                                                            $scriptSelectSedes = "SELECT ID_SEDE, NOMBRE FROM sedes WHERE NOT ID_SEDE = '$llenado2[ID_SEDE]' ";                                                                  
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
                                            <td class="tdGestion">Fecha de Registro<input type="date" name="txtFechaIngreso" value="<?php echo $llenado['FECHA_REGISTRO'];?>"></td>
                                            <td class="tdGestion">Fecha de Salida<input type="date" name="txtFechaSalida" value="<?php echo $llenado['FECHA_SALIDA'];?>"></td>
                                        </tr>
                                        <tr>
                                            <td class="tdGestion" colspan="5">
                                                <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                            </td>
                                            <?php
                                                    $llenarDatosAdmin->close();
                                                    $stmt2->close();
                                                }
                                            ?>                                                                                   
                                        </tr>
                                    </table>
                                </section>
                            </article>
                        </fieldset>
                    </form>
                </div>
                <div class="divBuscar">
                    <form action="administradores.php" method="GET">
                        <input type="text" id="txtBuscar" class="txtBuscar" placeholder="Buscar por DNI, apellido o nombre" maxlength="64">
                        <input type="submit" value="Buscar" name="btnBuscar" class="Botones">
                    </form>
                </div>
                <?php 
                    if (isset($_REQUEST['btnRegistrar'])){
                        $DNI = $_POST['txtDNI'];
                        $nombre = $_POST['txtNombre'];
                        $apellidoPaterno = $_POST['txtApelliedoPaterno'];
                        $apellidoMaterno = $_POST['txtApellidoMaterno'];
                        $puesto = $_POST['txtPuesto'];
                        $correo = $_POST['txtCorreo'];                        
                        $fechaIngreso = $_POST['txtFechaIngreso'];
                        $sede = $_POST['slctSedes'];
                        
                        if(empty($telefono = $_POST['txtTelefono'])){

                            $scriptInsertAdmins = "INSERT INTO administradores (ID_SEDE, DNI_RUC, NOMBRE, APELLIDO_P,
                                                                            APELLIDO_M, PUESTO, CORREO, TELEFONO, FECHA_REGISTRO, PASS)
                                                            VALUES('$sede', '$DNI', '$nombre', '$apellidoPaterno', '$apellidoMaterno', 
                                                                    '$puesto' ,'$correo' ,'000000000' ,'$fechaIngreso', 'Admin6789')";
                        }else{

                            $telefono = $_POST['txtTelefono'];
                            $scriptInsertAdmins = "INSERT INTO administradores (ID_SEDE, DNI_RUC, NOMBRE, APELLIDO_P,
                                                                            APELLIDO_M, PUESTO, CORREO, TELEFONO, FECHA_REGISTRO, PASS)
                                                            VALUES('$sede', '$DNI', '$nombre', '$apellidoPaterno', '$apellidoMaterno', 
                                                                    '$puesto' ,'$correo' ,'$telefono' ,'$fechaIngreso', 'Admin6789')";  
                        }                                                                                      

                        if($miconex->query($scriptInsertAdmins) === true){
                ?>
                            <script>
                                alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se registraron correctamente");                                                                                
                                e.preventDefault();                                                                   
                                window.location.href("administradores.php");                                    
                            </script>
                            <meta http-equiv="refresh" content="0;url=administradores.php">                                   
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
                        $id = $_POST['txtID'];
                        $DNI = $_POST['txtDNI'];
                        $nombre = $_POST['txtNombre'];
                        $apellidoPaterno = $_POST['txtApelliedoPaterno'];
                        $apellidoMaterno = $_POST['txtApellidoMaterno'];
                        $puesto = $_POST['txtPuesto'];
                        $correo = $_POST['txtCorreo'];                        
                        $fechaIngreso = $_POST['txtFechaIngreso'];                         
                        $sede = $_POST['slctSedes'];
                        
                        if(empty($fechaSalida = $_POST['txtFechaSalida']) and empty($telefono = $_POST['txtTelefono'])){

                            $scriptModificarAdmin ="UPDATE administradores SET ID_SEDE = '$sede', DNI_RUC = '$DNI',  NOMBRE = '$nombre', 
                                                                            APELLIDO_P = '$apellidoPaterno', APELLIDO_M = '$apellidoMaterno', 
                                                                            PUESTO = '$puesto', CORREO = '$correo', TELEFONO = '000000000', 
                                                                            FECHA_SALIDA = '0000-00-00', FECHA_REGISTRO = '$fechaIngreso'
                                                                        WHERE ID_ADMIN = '$id'";

                        }elseif(empty($telefono = $_POST['txtTelefono'])){

                            $fechaSalida = $_POST['txtFechaSalida'];
                            $scriptModificarAdmin ="UPDATE administradores SET ID_SEDE = '$sede', DNI_RUC = '$DNI',  NOMBRE = '$nombre', 
                                                                            APELLIDO_P = '$apellidoPaterno', APELLIDO_M = '$apellidoMaterno', 
                                                                            PUESTO = '$puesto', CORREO = '$correo', TELEFONO = '000000000', 
                                                                            FECHA_SALIDA = '$fechaSalida', FECHA_REGISTRO = '$fechaIngreso'
                                                                        WHERE ID_ADMIN = '$id'";

                        }elseif(empty($fechaSalida = $_POST['txtFechaSalida'])){

                            $telefono = $_POST['txtTelefono'];
                            $scriptModificarAdmin ="UPDATE administradores SET ID_SEDE = '$sede', DNI_RUC = '$DNI',  NOMBRE = '$nombre', 
                                                                            APELLIDO_P = '$apellidoPaterno', APELLIDO_M = '$apellidoMaterno', 
                                                                            PUESTO = '$puesto', CORREO = '$correo', TELEFONO = '$telefono', 
                                                                            FECHA_REGISTRO = '$fechaIngreso', FECHA_SALIDA = '0000-00-00'
                                                                        WHERE ID_ADMIN = '$id'";
                        }else{

                            $fechaSalida = $_POST['txtFechaSalida'];
                            $telefono = $_POST['txtTelefono'];
                            $scriptModificarAdmin ="UPDATE administradores SET ID_SEDE = '$sede', DNI_RUC = '$DNI',  NOMBRE = '$nombre', 
                                                                            APELLIDO_P = '$apellidoPaterno', APELLIDO_M = '$apellidoMaterno', 
                                                                            PUESTO = '$puesto', CORREO = '$correo', TELEFONO = '$telefono', 
                                                                            FECHA_REGISTRO = '$fechaIngreso', FECHA_SALIDA = '$fechaSalida'
                                                                        WHERE ID_ADMIN = '$id'";
                        }                      
                                            
                        if($miconex->query($scriptModificarAdmin) === true){
                ?>
                            <script>
                                alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se actualizaron correctamente");                 
                                e.preventDefault();                                                                   
                                window.location.href("administradores.php");                                    
                            </script>  
                            <meta http-equiv="refresh" content="0;url=administradores.php">
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
                        $idAdminEliminar = $_POST['btnEliminar'];                            
                        $scriptEliminarAdmin = "DELETE FROM administradores WHERE ID_ADMIN = '$idAdminEliminar'";
                        if($miconex->query($scriptEliminarAdmin) === true){
                            ?>
                            <script>
                                alert("¡Exito!, El registro se borró correctamente");                 
                                e.preventDefault();                                                                   
                                window.location.href("administradores.php");                                    
                            </script>  
                            <meta http-equiv="refresh" content="0;url=administradores.php">
                            <?php
                        }else{
                            $error = $miconex->error." Error número: ".mysqli_errno($miconex);
                            ?>
                            <script>
                                alert("Error al Eliminar registro: <?php echo $error; ?>");                                                   
                            </script>                                  
                            <?php               
                        }            
                    }                        

                    if($resultado = $miconex->query($scriptSelectAdmin)){                                                     
                            ?>
                        <div class="div_tabla" style="overflow-x: auto; overflow-y: auto;">
                            <table class="tablaRegistros" border="1">
                                <tr bgcolor="4C4C4C" style="color: white;">
                                    <td><b>&nbsp;ID&nbsp;</b></td>
                                    <!--<td><b>&nbsp;Perfil&nbsp;</b></td>-->
                                    <td><b>&nbsp;DNI</b>&nbsp;</td>
                                    <td><b>&nbsp;Nombre&nbsp;</b></td>
                                    <td><b>&nbsp;Ap. Paterno&nbsp;</b></td>
                                    <td><b>&nbsp;Ap. Materno&nbsp;</b></td>
                                    <td><b>&nbsp;Puesto&nbsp;</b></td>
                                    <td><b>&nbsp;Correo&nbsp;</b></td>
                                    <td><b>&nbsp;Teléfono&nbsp;</b></td>
                                    <td><b>&nbsp;Sede Registrada&nbsp;</b></td>
                                    <td><b>&nbsp;F. Registro&nbsp;</b></td>
                                    <td><b>&nbsp;F. Salida&nbsp;</b></td>
                                    <td><b>&nbsp;Accción&nbsp;</b></td>
                                </tr>                            
                        <?php
                        $c=1;                             
                        while ($fila = $resultado->fetch_assoc() and $c >= 1){
                            $idsede = $fila['ID_SEDE'];                                
                            $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                            $resultado2 = $miconex->query($scriptSelectNombreSedes);
                            $columSedes = $resultado2->fetch_assoc();                        
                        ?>                    
                                <form value="<?php echo $fila['ID_ADMIN'];?>" id="<?php echo $fila['ID_ADMIN'];?>" action='administradores.php' method='post'>
                                    <tr bgcolor = "<?php if(intval($c)%2==0) echo 'E6E6E6';else echo 'white' ?>">                                            
                                        <td style="display: none;"><?php $c++; ?></td>
                                        <td><b>&nbsp;<?php echo $fila['ID_ADMIN'];?>&nbsp;</b></td>
                                        <!--<td><img height="50px" src="data:image/png;base64,<?php //echo base64_encode($fila['F_PERFIL']); ?>"/></td>-->
                                        <td>&nbsp;<?php echo $fila['DNI_RUC'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $fila['NOMBRE'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $fila['APELLIDO_P'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $fila['APELLIDO_M'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $fila['PUESTO'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $fila['CORREO'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $fila['TELEFONO'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $columSedes['NOMBRE'];?>&nbsp;</td>
                                        <td style="width: 100px;" >&nbsp;<?php echo $fila['FECHA_REGISTRO'];?>&nbsp;</td>
                                        <td style="width: 100px;" >&nbsp;<?php echo $fila['FECHA_SALIDA'];?>&nbsp;</td>
                                        <td style="width: 120px;" >
                                            <button type="submit" id="<?php echo $fila['ID_ADMIN'];?>" value="<?php echo $fila['ID_ADMIN'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                            <button type="submit" id="<?php echo $fila['ID_ADMIN'];?>" value="<?php echo $fila['ID_ADMIN'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                  
                                        </td>
                                    </tr>
                                </form>
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
                <br>
                <table align="center">
                    <tbody>
                        <tr>
                            <td>
                                <form action="reporte.php" method="POST">
                                    <button type="submit" name="btnReporteAdmins" class="Botones">Reporte en PDF</button>            
                                </form>
                            </td>
                            <td>
                                <form action="reporteXL.php" method="POST">
                                    <button type="submit" name="btnReporteAdminsxl" class="Botones">Reporte en Excel</button>            
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>                                
            </div>
        </div>        
    </body>
</html>