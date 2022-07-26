<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
        <title >Ventas</title>
        <link rel="stylesheet" href="../estilos/estilos.css">
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
                conexion.open("GET", "productosxSede.php?c="+str, true);
                //po ultimo enviamos la conexion
                conexion.send();

            }
            
            function CalcPrice(str){
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
                    document.getElementById("calc").innerHTML=conexion.responseText; 
                }
            }

            conexion.open("GET", "CalcPrice.php?p="+str, true);
            conexion.send();

        }

	    </script>        
    </head>
    <body>
        <?php
        require_once("../index.php");
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
        ?>
        <div class="divGeneral">
            <div class="divGestion">
                <div class="divRegsitro">
                    <form action="ventas.php" method="POST">
                        <h1>Gestión Ventas</h1>  
                        <fieldset class="containerGestion">
                            <h2>Venta Cabecera</h2>
                            <article>
                                <section>
                                    <table>
                                        <tr>
                                            <td class="tdGestion">Cliente<p><input type="text" name="txtCli"></td>
                                            <td class="tdGestion"> Vendedor<p><input type="text" name="txtVend"></td>
                                            <td class="tdGestion">Sede
                                                <form>                                                                                            
                                                    <select class="seleccion" name="slctSedes" id="slctSedes" onclick="muestraselect(this.value)">
                                                    <option value="1">Seleccione Sede</option>
                                                    <?php include "mostrarSedes.php" ?>
                                                    </select>
                                                </form>
                                            </td> 
                                            <td class="tdGestion">Fecha de Venta<p><input type="date" name="txtFVenta" id="fechaActual"></td>                                            
                                        </tr>
                                    </table>
                                </section>
                            </article>
                        </fieldset>
                        <div id="div">
                        </div>
                    </form>
                </div>
                <?php
                        if(isset($_POST['btnChk'])){
                            echo $_POST['btnChk'];
                        }                        
                    ?>                           
            </div>            
        </div>                 
    </body>
    <script src="../js/jquery-3.4.0.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</html>