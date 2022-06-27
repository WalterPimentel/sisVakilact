<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
    <title >Sedes</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
    <body>
        <?php                                                           
            require("../index.php");
            $miconex= miConexionBD();
            $scriptSelectSedes = "SELECT * FROM sedes";
            if (isset($_REQUEST['btnCancelar'])){
        ?>
                <script>                 
                    e.preventDefault();                                                                   
                    window.location.replace("sedes.php");
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
                        <form action="sedes.php" method="POST">
                            <fieldset class="containerGestion">
                                <legend>Registrar datos</legend>
                                <article>
                                    <section>
                                        <table class="tablaCedes">
                                            <tr>
                                                <?php 
                                                    if (!isset($_REQUEST['btnEditar'])){                                            
                                                ?>
                                                <input type="hidden" name="txtID">
                                                <td>Dirección<br><input class="inputSedes" type="text" name="txtDireccion" placeholder="Jr., Av., Urb., ..." required></td>
                                            </tr>
                                            <tr>
                                                <td>Distrito<br><input class="inputSedes" type="text" name="txtDistrito"></td>
                                            </tr>
                                            <tr>
                                                <td>Ciudad<br><input class="inputSedes" type="text" name="txtCiudad"></td>
                                            </tr>
                                            <tr>
                                                <td>Nombre<br><input class="inputSedes" type="text" name="txtNombre" required></td>
                                            </tr>
                                            <tr>
                                                <td>                                               
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones">
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones" disabled>
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>                              
                                                    <?php 
                                                    }elseif(isset($_REQUEST['btnEditar'])){
                                                        $IDSEDE = $_POST['btnEditar'];
                                                        $scriptSelectSedeporID = "SELECT * FROM sedes WHERE ID_SEDE ='$IDSEDE'";                                             
                                                        $llenarDatosSede = $miconex->query($scriptSelectSedeporID);
                                                        $llenado = $llenarDatosSede->fetch_assoc();
                                                    ?>
                                                <input type="hidden" name="txtID" value="<?php echo $llenado['ID_SEDE'];?>">
                                                <td>Dirección<br><input value="<?php echo $llenado['DIRECCION'];?>" class="inputSedes" type="text" name="txtDireccion" placeholder="Jr., Av., Urb., ..." required></td>
                                            </tr>
                                            <tr>
                                                <td>Distrito<br><input value="<?php echo $llenado['DISTRITO'];?>" class="inputSedes" type="text" name="txtDistrito"></td>
                                            </tr>
                                            <tr>
                                                <td>Ciudad<br><input value="<?php echo $llenado['CIUDAD'];?>" class="inputSedes" type="text" name="txtCiudad"></td>
                                            </tr>
                                            <tr>
                                                <td>Nombre<br><input value="<?php echo $llenado['NOMBRE'];?>" class="inputSedes" type="text" name="txtNombre" required></td>
                                            </tr>
                                            <tr>
                                                <td>                                               
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                                <?php
                                                        $llenarDatosSede->close();
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
                        <form action="sedes.php" method="GET">
                            <input type="text" id="txtBuscar" class="txtBuscar" placeholder="Buscar por DNI, apellido o nombre" maxlength="64">
                            <input type="submit" value="Buscar" name="btnBuscar" class="Botones">
                        </form>
                    </div>
                    <?php 
                        if (isset($_REQUEST['btnRegistrar'])){
                            $Direccion = $_POST['txtDireccion'];
                            $Distrito = $_POST['txtDistrito'];
                            $Ciudad = $_POST['txtCiudad'];
                            $Nombre = $_POST['txtNombre'];
                            
                            $scriptInsertSede = "INSERT INTO sedes (DIRECCION, DISTRITO, CIUDAD, NOMBRE)
                                                                VALUES('$Direccion', '$Distrito', '$Ciudad', '$Nombre')";

                            if($miconex->query($scriptInsertSede) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $Nombre; ?>, se registraron correctamente");                                                                                
                                    e.preventDefault();                                                                   
                                    window.location.replace("sedes.php");                                    
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
                            $Direccion = $_POST['txtDireccion'];
                            $Distrito = $_POST['txtDistrito'];
                            $Ciudad = $_POST['txtCiudad'];
                            $Nombre = $_POST['txtNombre'];

                            $scriptModificarSede ="UPDATE sedes SET DIRECCION = '$Direccion',  DISTRITO = '$Distrito', 
                                                                    CIUDAD = '$Ciudad', NOMBRE = '$Nombre'                                 
                                                                        WHERE ID_SEDE = '$id'";

                            if($miconex->query($scriptModificarSede) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $Nombre; ?>, se actualizaron correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("sedes.php");                                    
                                </script>  
                                <?php
                            }else{
                                $error = $miconex->error.". Error número: ".mysqli_errno($miconex);
                                ?>
                                <script>
                                    alert("Error al Modificar datos: <?php echo $error; ?>");                                                   
                                </script>                                  
                                <?php               
                            }  
                        }

                        if (isset($_REQUEST['btnEliminar'])){                            
                            $idSedeEliminar = $_POST['btnEliminar'];
                            $nombreEliminar= $miconex->query("SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idSedeEliminar'");
                            $llamarNombreEliminar = $nombreEliminar->fetch_assoc();                            
                            $scriptEliminarSede = "DELETE FROM sedes WHERE ID_SEDE = '$idSedeEliminar'";
                            if($miconex->query($scriptEliminarSede) === true){
                                ?>
                                <script>
                                    alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE']; ?>, se borró correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("sedes.php");                                    
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

                        if($resultado = $miconex->query($scriptSelectSedes)){                                                     
                                ?>
                            <div class="div_tabla" style="overflow: auto;">
                                <table border="1" class="tablaRegistros">
                                    <tr>
                                        <td><b>&nbsp;ID&nbsp;</b></td>
                                        <td><b>&nbsp;Dirección</b>&nbsp;</td>
                                        <td><b>&nbsp;Distrito&nbsp;</b></td>
                                        <td><b>&nbsp;Ciudad&nbsp;</b></td>
                                        <td><b>&nbsp;Nombre&nbsp;</b></td>
                                        <td><b>&nbsp;Acción&nbsp;</b></td>
                                    </tr>                            
                            <?php                             
                            while ($fila = $resultado->fetch_assoc()){                 
                            ?>                    
                                    <form value="<?php echo $fila['ID_SEDE'];?>" id="<?php echo $fila['ID_SEDE'];?>" action='sedes.php' method='post'>
                                        <tr>
                                            <td><b>&nbsp;<?php echo $fila['ID_SEDE'];?>&nbsp;</b></td>
                                            <td>&nbsp;<?php echo $fila['DIRECCION'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['DISTRITO'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['CIUDAD'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['NOMBRE'];?>&nbsp;</td>
                                            <td class="tdBotonTabla">
                                                <button type="submit" id="<?php echo $fila['ID_SEDE'];?>" value="<?php echo $fila['ID_SEDE'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                                <button type="submit" id="<?php echo $fila['ID_SEDE'];?>" value="<?php echo $fila['ID_SEDE'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                  
                                            </td>
                                        </tr>
                                    </form>
                            <?php
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