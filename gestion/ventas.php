<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
        <title >Ventas</title>
        <link rel="stylesheet" href="../estilos/estilos.css">            
    </head>
    <body>
        <script src="../js/jquery-3.4.0.min.js"></script>
        <script src="../js/funciones.js"></script>
        <script src="../js/popper.min.js"></script>        
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript">

            function muestraselect(str){ //funcion para crear la conexion asincronica

                var conexion;

                if(str==""){
                    document.getElementById("txtHint").innerHTML=""; // si la variable a enviar viene vacia retornamos a nada la funcion
                    return;
                }
                if (window.XMLHttpRequest){
                    conexion = new XMLHttpRequest();  // creamos una nueva instacion del obejeto XMLHttpRequest
                }

                // verificamos el onreadystatechange verifando que el estado sea de 4 y el estatus 200
                conexion.onreadystatechange=function(){  
                    if(conexion.readyState==4 && conexion.status==200){
                        //especificamos que en el elemento HTML cuyo id esa el de "div" vacie todos los datos de la respuesta 
                        document.getElementById("div").innerHTML=conexion.responseText; 
                    }
                }
                //abrimos una conexion asincronica usando el metodo GET y le enviamos la variable c
                conexion.open("GET", "listProduct.php?c="+str, true);
                //po ultimo enviamos la conexion
                conexion.send();

            }            

            function AgregarProductos(){

                let retorno = false;                           
                vendedor = document.getElementById('vendedor').value;
                sede = document.getElementById('slctSedes').value;
                cproduct = document.getElementById('idpord').value;
                cantidad = document.getElementById('cant').value;

                if(vendedor == null || vendedor.length == 0 || /^\s+$/.test(vendedor)){

                    alert("El campo del vendedor es OBLIGATORIO");
                    window.location.href = "ventas.php";
                    return false;

                }else if(sede == null || sede.length == 0 || /^\s+$/.test(sede)){

                    alert("La selección de una sede es OBLIGATORIA");
                    window.location.href = "ventas.php";                    
                    return false;

                }else if(cproduct == null || cproduct.length == 0 || /^\s+$/.test(cproduct)){
                
                    alert("El campo del ID del producto es OBLIGATORIO");
                    window.location.href = "ventas.php";
                    return false;

                }else if(cantidad == null || cantidad.length == 0 || /^\s+$/.test(cantidad)){

                    alert("El campo de cantidad es OBLIGATORIO");
                    window.location.href = "ventas.php";
                    return false;

                }else{                                        

                    if(document.getElementById('slctCli').disabled == false  &&
                    document.getElementById('slctSedes').disabled == false &&
                    document.getElementById('fechaActual').disabled == false &&
                    document.getElementById('vendedor').disabled == false){

                        document.getElementById('slctCli').disabled = true;
                        document.getElementById('slctSedes').disabled = true;
                        document.getElementById('fechaActual').disabled = true;
                        document.getElementById('vendedor').disabled = true;
                        
                        slctCli=$('#slctCli').val();
                        vendedor=$('#vendedor').val();
                        slctSedes=$('#slctSedes').val();
                        fechaActual=$('#fechaActual').val();
                        idpord=$('#idpord').val();
                        cant=$('#cant').val();
                        if( $('#rbV1').prop('checked') ) {
                            rbV1=$('#rbV1').val();
                        }else if($('#rbV2').prop('checked')){
                            rbV1=$('#rbV2').val();
                        }
                        agregardatos(slctCli, vendedor, slctSedes, fechaActual, idpord, cant, rbV1); 

                        document.getElementById('idpord').value = "";
                        document.getElementById('cant').value = "";

                    }else if(document.getElementById('slctCli').disabled == true  &&
                        document.getElementById('slctSedes').disabled == true &&
                        document.getElementById('fechaActual').disabled == true &&
                        document.getElementById('vendedor').disabled == true){
                
                        idpord=$('#idpord').val();
                        cant=$('#cant').val();
                        if( $('#rbV1').prop('checked') ) {
                            rbV1=$('#rbV1').val();
                        }else if($('#rbV2').prop('checked')){
                            rbV1=$('#rbV2').val();
                        }
                        volveragregardatos(idpord, cant, rbV1);

                        document.getElementById('idpord').value = "";
                        document.getElementById('cant').value = "";
                                                
                    }else{
                        alert("Ocurrió un error al agregar el producto");
                        return false;
                    }
                    retorno = true;                 
                }
                return retorno;        
            }
                        
            function mostrar(str){

                var conexion;

                if(str==""){
                    document.getElementById("txtHint").innerHTML="";
                    return;
                }
                if (window.XMLHttpRequest){
                    conexion = new XMLHttpRequest();
                }

                conexion.onreadystatechange=function(){
                    if(conexion.readyState==4 && conexion.status==200){
                        document.getElementById("agr").innerHTML=conexion.responseText; 
                    }
                }

                conexion.open("GET", "listaproductos.php?a="+str, true);
                conexion.send();
            }

            function QuitarProductos(str){

                var conexion;

                if(str==""){
                    document.getElementById("txtHint").innerHTML="";
                    return;
                }
                if (window.XMLHttpRequest){
                    conexion = new XMLHttpRequest();
                }

                conexion.open("GET", "quitarprodt.php?q="+str, true);
                conexion.send();                
                
            }
            
            function ConfirmarR(e){
                    var mensaje = "¿Esta seguro de REGISTRAR esta venta?";

                        if (!confirm(mensaje)){                    
                        e.preventDefault();                   
                        }
                    }

            function ConfirmarC(e){
            var mensaje = "¿Esta seguro de CANCELAR esta venta?";

                if (!confirm(mensaje)){                    
                e.preventDefault();                   
                }else{
                    var p = document.getElementById('btnQuitar').value;
                    QuitarProductos(p);                      
                }
            }

            function actualizarStock(){
                var s = document.getElementById('slctSedes').value;
                muestraselect(s);                
            }

            /*function Principal(){
                AgregarProductos().then(mostrar(str));
            }*/
	    </script>            
        <?php     
        require_once("../index.php");
        require_once("../includes/conexiones.php");
        $miconex= miConexionBD();
        $conectar = ConectarBD();
        $scriptSelectAllVentasCa = "SELECT * FROM venta_cabecera ORDER BY ID_VENTA DESC";
        $scriptSelectAllVentasCu = "SELECT * FROM venta_cuerpo ORDER BY ID_VENTA DESC";
        if (isset($_REQUEST['btnCancelar'])){
            ?>
            <script>                 
                e.preventDefault();                                                                   
                window.location.replace("ventas.php");
            </script>
            <meta http-equiv="refresh" content="0;url=ventas.php">                                    
            <?php
        }        

        if(isset($_REQUEST['btnQuitar'])){

            $ultimo="SELECT MAX(ID_VENTA) AS ID_VENTA from venta_cabecera";
            $ejecutar = mysqli_query($miconex, $ultimo);
            $valor= mysqli_fetch_assoc($ejecutar);
            $idventa=$valor['ID_VENTA'];

            $borrarVentaCu = "DELETE FROM venta_cuerpo WHERE ID_VENTA = '$idventa'";
            $borrarVentaCa = "DELETE FROM venta_cabecera WHERE ID_VENTA = '$idventa'";

            if(mysqli_query($miconex, $borrarVentaCu) === false || mysqli_query($miconex, $borrarVentaCa) === false){
                $error = mysqli_error($miconex)." Error número: ".mysqli_errno($miconex);
                ?>
                <script>
                    alert("Error al cancelar venta: <?php echo $error; ?>");
                    e.preventDefault();                                                                   
                    window.location.href("ventas.php");                                                   
                </script>                                 
                <meta http-equiv="refresh" content="0;url=ventas.php">                                     
                <?php 
            }
        }

        if(isset($_REQUEST['btnRegistrar'])){
            
            $ultimo="SELECT MAX(ID_VENTA) AS ID_VENTA from venta_cabecera";
            $ejecutar = mysqli_query($miconex, $ultimo);
            $valor= mysqli_fetch_assoc($ejecutar);
            $idventa=$valor['ID_VENTA'];

            $consultaTotal = "SELECT SUM(PRECIO_TOTAL) AS TOTAL FROM venta_cuerpo WHERE ID_VENTA = '$idventa';";
            $ejecutarConsultaTotal = mysqli_query($miconex, $consultaTotal);
            $resultado = mysqli_fetch_assoc($ejecutarConsultaTotal);
            $total = $resultado['TOTAL'];

            $actualizarTotal="UPDATE venta_cabecera SET COSTO_TOTAL = '$total' WHERE ID_VENTA = '$idventa';";
            
            if(mysqli_query($miconex, $actualizarTotal) === true){
                ?>
                <script>
                    alert("¡Exito!, venta <?php echo $$idventa ?>, se registro correctamente");                 
                    e.preventDefault();                                                                   
                    window.location.href("ventas.php");                                    
                </script>
                <meta http-equiv="refresh" content="0;url=ventas.php">                                 
                <?php
            }else{
                $error = mysqli_error($miconex)." Error número: ".mysqli_errno($miconex);
                ?>
                <script>
                    alert("Error al registrar venta: <?php echo $error; ?>");                                                   
                </script>                                                                  
                <?php   
            }
        }
        ?>
        <div class="divGeneral">
            <div class="divGestion">
                <div class="divRegsitro">
                    <form action="ventas.php" method="POST">
                        <h1>Gestión Ventas</h1>  
                        <fieldset class="containerGestion">
                            <article>
                                <section>
                                    <table style="margin: auto;">
                                        <tr>
                                        <td class="tdGestion">Cliente
                                                <form>                                                                                            
                                                    <select class="seleccion" name="slctCli" id="slctCli">
                                                    <option value="2147483647">Público General</option>
                                                    <?php include "mostrarClientes.php" ?>
                                                    </select>
                                                </form>
                                            </td> 
                                            <td class="tdGestion"> Vendedor<input type="text" name="txtVend" id="vendedor" required></td>
                                            <td class="tdGestion">Sede
                                                <form>                                                                                            
                                                    <select class="seleccion" name="slctSedes" id="slctSedes" onclick="muestraselect(this.value)">
                                                    <option style="background-color: rgb(230, 230, 230);" value="">Seleccione Sede</option>
                                                    <?php include "mostrarSedes.php" ?>
                                                    </select>
                                                </form>
                                            </td> 
                                            <td class="tdGestion">Fecha de Venta<input type="date" name="txtFVenta" id="fechaActual"></td>                                            
                                        </tr>
                                        <tr>
                                            <td><input type="text" placeholder="Ingrese ID de producto a vender" name="idpord" class="txtAgregar" id="idpord"></td>
                                            <td><input type="number" placeholder="Ingrese cantidad a vender" name="cant" class="txtAgregar" id="cant" min="1" pattern="^[0-9]+"></td>
                                            <td>
                                                <input type="radio" class="rbcbx" name="rbV" id="rbV1" value="1" checked>Al menor
                                                <input type="radio" class="rbcbx" name="rbV" id="rbV2" value="2">Al mayor
                                            </td>
                                            <td><input type="button" value="+ Agregar" name="btnAgregar" id="btnAgregar" class="btnAgregar" onclick="AgregarProductos(); setTimeout(mostrar, 256); setTimeout(actualizarStock, 512);"> </td>
                                        </tr>
                                    </table>
                                    <p>
                                    <div id="agr" style="margin: auto;">
                                    </div>
                                </section>
                            </article>
                        </fieldset>                                                                                                             
                        <div id="div" class="div_tabla" style="overflow: auto;">
                            <table border="1" class="tablaRegistros">
                                <tbody>
                                    <?php
                                    $consulta="SELECT * FROM productos_terminados ORDER BY ID_SEDE ASC";
                                    $ejecutarConsulta=mysqli_query($miconex, $consulta);                                                

                                    ?>
                                    <tr bgcolor="4C4C4C" style="color: white;">
                                        <td colspan="7"><b>Productos Disponibles</b></td>
                                    </tr>
                                    <tr bgcolor="4C4C4C" style="color: white;">
                                        <td><b>&nbsp;ID&nbsp;</b></td>
                                        <td><b>&nbsp;Nombre&nbsp;</b></td>
                                        <td><b>&nbsp;Stock&nbsp;</b></td>
                                        <td><b>&nbsp;Precio de venta al menor&nbsp;</b></td>
                                        <td><b>&nbsp;Precio de venta al mayor&nbsp;</b></td>
                                        <td><b>&nbsp;Sede&nbsp;</b></td>
                                        <td><b>&nbsp;Unidad de medida&nbsp;</b></td>                                
                                    </tr>
                                    <?php                            
                                    $r=1;
                                    while($fila = mysqli_fetch_array($ejecutarConsulta) and $r>=1){
                                        $iprod=$fila['ID_PRODUCTO'];                                                                                                                                                                
                                        $idsede=$fila['ID_SEDE'];
                                        
                                        $scriptSelectNombreSedes="SELECT NOMBRE FROM SEDES WHERE ID_SEDE = '$idsede' ORDER BY ID_SEDE ASC";

                                        $nomSede=$miconex->query($scriptSelectNombreSedes);
                                        $nombreSede=$nomSede->fetch_assoc();
                                        
                                            ?>
                                            <tr bgcolor = "<?php if(intval($r)%2==0) echo 'E6E6E6';else echo 'white' ?>">
                                                <td style="display: none;"><?php $r++; ?></td>
                                                <td><?php echo $fila['ID_PRODUCTO']; ?></td> 
                                                <td><?php echo $fila['NOMBRE']; ?></td>
                                                <td>&nbsp;<?php echo $fila['STOCK'];?>&nbsp;</td>
                                                <td>&nbsp;<?php echo "S/ ".$fila['PV_MIN'];?>&nbsp;</td>
                                                <td>&nbsp;<?php echo "S/ ".$fila['PV_MAX'];?>&nbsp;</td>
                                                <td>&nbsp;<?php echo $nombreSede['NOMBRE'];?>&nbsp;</td>
                                                <td>&nbsp;<?php echo $fila['UNIDAD_MEDIDA'];?>&nbsp;</td>
                                            </tr>
                                            <?php                                        
                                    }
                                    $nomSede->close();        
                                    mysqli_close($miconex);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>                           
            </div>            
        </div>                 
    </body>
</html>