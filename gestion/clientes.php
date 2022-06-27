<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
    <title >Clientes</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
    <body>
        <?php                                                           
            require("../index.php");
            $miconex= miConexionBD();
            $conectar = ConectarBD();
            $scriptSelectClientes = "SELECT * FROM clientes";
            if (isset($_REQUEST['btnCancelar'])){
        ?>
                <script>                 
                    e.preventDefault();                                                                   
                    window.location.replace("clientes.php");
                </script>                                            
        <?php
            }
        ?>
        <script>            
            window.onload = function(){
                var fecha = new Date(); //Fecha actual
                var mes = fecha.getMonth()+1; //obteniendo mes
                var dia = fecha.getDate(); //obteniendo dia
                var ano = fecha.getFullYear(); //obteniendo año
                if(dia<10)
                    dia='0'+dia; //agrega cero si el menor de 10
                if(mes<10)
                    mes='0'+mes //agrega cero si el menor de 10
                document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
            }
        </script>                                                         
        <header>
            header
        </header>
        <div class="divGeneral">
            <div>
                <nav class="nav1">
                    Usuario
                </nav>
                <article class="article1">
                            Men&uacute; Principal
                </article>
                <nav class="nav2">
                    <table class="tablaLateral"> 
                        <tr class="trLateral">
                            <td><a href="dashboard.php" class="link">DashBoard</a></td>
                        <tr class="trLateral">
                            <td><a href="administradores.php" class="link">Administradores</a></td>
                        <tr class="trLateral"> 
                            <td><a href="vendedor.php" class="link">Vendedor</a></td>
                        <tr class="trLateral">
                            <td><a href="sedes.php" class="link">Sedes</a></td>
                        <tr class="trLateral">
                            <td><a href="productos.php" class="link">Productos</a></td>
                        <tr class="trLateral">                    
                            <td><a href="productos_in.php" class="link">Ingreso Productos</a></td>
                        <tr class="trLateral">
                            <td><a href="clientes.php" class="link">Clientes</a></td>
                        <tr class="trLateral">
                            <td><a href="ventas.php" class="link">Ventas</a></td>
                        <tr class="trLateral">
                            <td><a href="proveedores.php" class="link">Proveedores</a></td>
                        <tr class="trLateral">
                            <td><a href="insumos.php" class="link">Insumos</a></td>
                        <tr class="trLateral">
                            <td><a href="insumos_in.php" class="link">Ingreso Insumos</a></td>
                    </table>
                </nav>
            </div>
            <div class="divGestion">                            
                    <div class="divRegsitro">
                        <form action="clientes.php" method="POST">
                            <fieldset class="containerGestion">
                                <legend>Registrar datos</legend>
                                <article>
                                    <section>
                                        <table>
                                            <tr>
                                                <?php 
                                                    if (!isset($_REQUEST['btnEditar'])){                                            
                                                ?>
                                                <input type="hidden" name="txtID">
                                                <td class="tdGestion">DNI o RUC<input type="text" name="txtDNI" minlength="8" maxlength="11" pattern="[0-9]+" required></td>
                                                <td class="tdGestion">Nombre<input type="text" name="txtNombre" required></td>
                                                <td class="tdGestion">Apellido Paterno<input type="text" name="txtApelliedoPaterno"></td>
                                                <td class="tdGestion">Apellido Materno<input type="text" name="txtApellidoMaterno"></td>                                                
                                            </tr>
                                            <tr>
                                                <td class="tdGestion">Correo<input type="text" name="txtCorreo" placeholder="nombre@dominio.com"></td>
                                                <td class="tdGestion">Telefono<input type="text" name="txtTelefono" minlength="9" pattern="[0-9]+"></td>                                                                        
                                                <td class="tdGestion">Sede
                                                    <form>                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <?php
                                                            $scriptSelectSedes = "SELECT ID_SEDE, NOMBRE FROM sedes";
                                                            $scriptSelectSedesDef = "SELECT ID_SEDE, NOMBRE FROM sedes WHERE ID_SEDE = '' ";                                                                                                
                                                            $stmt = $conectar->prepare($scriptSelectSedes);
                                                            $ejecucion1 = $stmt->execute();
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
                                                <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" id="fechaActual"></td>                                                
                                            </tr>
                                            <tr>
                                                <td class="tdGestion" colspan="4">
                                                <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones">
                                                <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones" disabled>
                                                <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                                    <?php 
                                                    }elseif(isset($_REQUEST['btnEditar'])){
                                                        $IDCLIENTE = $_POST['btnEditar'];
                                                        $scriptSelectClienteporID = "SELECT * FROM clientes WHERE ID_CLIENTE ='$IDCLIENTE'";                                             
                                                        $llenarDatosCliente = $miconex->query($scriptSelectClienteporID);
                                                        $llenado = $llenarDatosCliente->fetch_assoc();
                                                    ?>
                                                <input type="hidden" name="txtID" value="<?php echo $llenado['ID_CLIENTE'];?>">
                                                <td class="tdGestion">DNI<input type="text" name="txtDNI" value="<?php echo $llenado['DNI_RUC'];?>" required></td>
                                                <td class="tdGestion">Nombre<input type="text" name="txtNombre" value="<?php echo $llenado['NOMBRE'];?>" required></td>
                                                <td class="tdGestion">Apellido Paterno<input type="text" name="txtApelliedoPaterno" value="<?php echo $llenado['APELLIDO_P'];?>" ></td>
                                                <td class="tdGestion">Apellido Materno<input type="text" name="txtApellidoMaterno" value="<?php echo $llenado['APELLIDO_M'];?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="tdGestion">Correo<input type="text" name="txtCorreo" value="<?php echo $llenado['CORREO'];?>"></td>
                                                <td class="tdGestion">Telefono<input type="text" name="txtTelefono" minlength="9" pattern="[0-9]+" value="<?php echo $llenado['TELEFONO'];?>"></td>                                                                        
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
                                                                $scriptSelectSedes = "SELECT ID_SEDE, NOMBRE FROM sedes WHERE NOT ID_SEDE = '$llenado2[ID_SEDE]'";
                                                                $stmt = $conectar->prepare($scriptSelectSedes);
                                                                $ejecucion2 = $stmt->execute();
                                                                $datos2=$stmt->fetchAll(\PDO::FETCH_OBJ);                                                
                                                                foreach($datos2 as $dato2){
                                                            ?>
                                                                    <option value="<?php print($dato2->ID_SEDE);  ?>"><?php print($dato2->NOMBRE); ?> </option>
                                                                <?php 
                                                                }
                                                                $stmt=null;
                                                                $conectar=null;                                                                
                                                                ?>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="tdGestion">Fecha de Registro<input type="date" name="txtFechaIngreso" value="<?php echo $llenado['FECHA_REGISTRO'];?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="tdGestion" colspan="4">
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                                <?php
                                                        $llenarDatosCliente->close();
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
                        <form action="clientes.php" method="GET">
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
                            $correo = $_POST['txtCorreo'];
                            $telefono = $_POST['txtTelefono'];
                            $fechaIngreso = $_POST['txtFechaIngreso'];
                            $sede = $_POST['slctSedes'];
                            
                            $scriptInsertClientes = "INSERT INTO clientes (ID_SEDE, DNI_RUC, NOMBRE, APELLIDO_P,
                                                                                APELLIDO_M, CORREO, TELEFONO, FECHA_REGISTRO)
                                                                VALUES('$sede', '$DNI', '$nombre', '$apellidoPaterno', '$apellidoMaterno', 
                                                                        '$correo' ,'$telefono' ,'$fechaIngreso')";

                            if($miconex->query($scriptInsertClientes) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se registraron correctamente");                                                                                
                                    e.preventDefault();                                                                   
                                    window.location.replace("clientes.php");                                    
                                </script>                                  
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
                            $correo = $_POST['txtCorreo'];
                            $telefono = $_POST['txtTelefono'];
                            $fechaIngreso = $_POST['txtFechaIngreso'];
                            $sede = $_POST['slctSedes'];

                            $scriptModificarCliente ="UPDATE clientes SET ID_SEDE = '$sede', DNI_RUC = '$DNI',  NOMBRE = '$nombre', 
                                                                                APELLIDO_P = '$apellidoPaterno', APELLIDO_M = '$apellidoMaterno', 
                                                                                CORREO = '$correo', TELEFONO = '$telefono', 
                                                                                FECHA_REGISTRO = '$fechaIngreso'
                                                                            WHERE ID_CLIENTE = '$id'";

                            if($miconex->query($scriptModificarCliente) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se actualizaron correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("clientes.php");                                    
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
                            $idClienteEliminar = $_POST['btnEliminar'];
                            $nombreEliminar= $miconex->query("SELECT NOMBRE FROM clientes WHERE ID_CLIENTE = '$idClienteEliminar'");
                            $llamarNombreEliminar = $nombreEliminar->fetch_assoc();                            
                            $scriptEliminarCliente = "DELETE FROM clientes WHERE ID_CLIENTE = '$idClienteEliminar '";
                            if($miconex->query($scriptEliminarCliente) === true){
                                ?>
                                <script>
                                    alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE']; ?>, se borró correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("clientes.php");                                    
                                </script>  
                                <?php
                            }else{
                                $error = $miconex->error." Error número: ".mysqli_errno($miconex);
                                ?>
                                <script>
                                    alert("Error al Eliminar registro: <?php echo $error; ?>");                                                   
                                </script>                                  
                                <?php               
                            }            
                            $nombreEliminar->close();
                        }                        

                        if($resultado = $miconex->query($scriptSelectClientes)){                                                     
                                ?>
                            <div class="div_tabla" style="overflow: auto;">
                                <table border="1" class="tablaRegistros">
                                    <tr>
                                        <td><b>&nbsp;ID&nbsp;</b></td>
                                        <td><b>&nbsp;DNI ó RUC</b>&nbsp;</td>
                                        <td><b>&nbsp;Nombre&nbsp;</b></td>
                                        <td><b>&nbsp;Apellido Paterno&nbsp;</b></td>
                                        <td><b>&nbsp;Apellido Materno&nbsp;</b></td>                                        
                                        <td><b>&nbsp;Correo&nbsp;</b></td>
                                        <td><b>&nbsp;Teléfono&nbsp;</b></td>
                                        <td><b>&nbsp;Sede Registrada&nbsp;</b></td>
                                        <td><b>&nbsp;Fecha Registro&nbsp;</b></td>
                                        <td><b>&nbsp;Accción&nbsp;</b></td>
                                    </tr>                            
                            <?php                             
                            while ($fila = $resultado->fetch_assoc()){
                                $idsede = $fila['ID_SEDE'];                                
                                $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                $resultado2 = $miconex->query($scriptSelectNombreSedes);
                                $columSedes = $resultado2->fetch_assoc();                        
                            ?>                    
                                    <form value="<?php echo $fila['ID_CLIENTE'];?>" id="<?php echo $fila['ID_CLIENTE'];?>" action='clientes.php' method='post'>
                                        <tr>
                                            <td><b>&nbsp;<?php echo $fila['ID_CLIENTE'];?>&nbsp;</b></td>
                                            <td>&nbsp;<?php echo $fila['DNI_RUC'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['NOMBRE'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['APELLIDO_P'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['APELLIDO_M'];?>&nbsp;</td>                                            
                                            <td>&nbsp;<?php echo $fila['CORREO'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['TELEFONO'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $columSedes['NOMBRE'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['FECHA_REGISTRO'];?>&nbsp;</td>
                                            <td class="tdBotonTabla">
                                                <button type="submit" id="<?php echo $fila['ID_CLIENTE'];?>" value="<?php echo $fila['ID_CLIENTE'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                                <button type="submit" id="<?php echo $fila['ID_CLIENTE'];?>" value="<?php echo $fila['ID_CLIENTE'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                  
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
                <script> 
                                            
                    function llenarDatos(e){
                        var id = e.id;
                        console.log(id);
                        var formulario = document.getElementById(id);
                        formulario.submit();
                    }

                    function Confirmar(e){
                    var mensaje = "¿Esta seguro de eliminar este registro?";

                        if (!confirm(mensaje)){                    
                        e.preventDefault();                   
                        }
                    }
                </script>                
            </div>
        </div>
        <script src="../js/predeterminado.js"></script>
    </body>
</html>