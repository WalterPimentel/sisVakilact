<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title >Reporte PDF</title>
        <link rel="stylesheet" href="../estilos/estilos.css">
    </head>
    <body>
    <?php
    require_once("../index.php");
    ?>
        <div class="divGeneral">
            <div class="divGestion">
                <div class="divRegsitro">                                                   
                                    <?php            
                                    if(isset($_REQUEST['btnReporteAdmins'])){
                                        $tit = "Administradores";
                                    ?>
                    <h1>Reporte <?php echo $tit; ?> PDF</h1>
                    <fieldset class="containerGestion">                            
                            <article>
                                <section>
                                    <form method="POST" action="fpdf/reportadmins.php" target="_blank">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="tdGestion">Sede                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas las sedes</option>
                                                            <?php include "mostrarSedes.php" ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Puesto                                           
                                                        <select class="seleccion" name="slctPuesto">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas los puestos</option>
                                                            <?php include "mostrarPuestos.php" ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Desde la fecha de registro
                                                        <input type="date" name="txtFreg" value="2000-01-01">
                                                    </td>
                                                    <td class="tdGestion">Desde la fecha de salida
                                                        <input type="date" name="txtFsal">
                                                    </td>
                                                </tr>                                            
                                                <tr>
                                                    <td class="tdGestion" colspan="4">                                                    
                                                        <input type="submit" value="Reporte PDF" id="btnReportPDF" target="_blank" class="Botones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>                         
                                    <?php                                                
                                    }elseif(isset($_REQUEST['btnReporteVendedores'])){
                                        $tit = "Vendedores";
                                    ?>
                                    <h1>Reporte <?php echo $tit; ?> PDF</h1>
                    <fieldset class="containerGestion">                            
                            <article>
                                <section>
                                    <form method="POST" action="fpdf/reportvendedores.php" target="_blank">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="tdGestion">Sede                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas las sedes</option>
                                                            <?php include "mostrarSedes.php"; ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Puesto                                           
                                                        <select class="seleccion" name="slctPuesto">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas los puestos</option>
                                                            <?php include "mostrarPuestos.php"; ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Desde la fecha de registro
                                                        <input type="date" name="txtFreg" value="2000-01-01">
                                                    </td>
                                                    <td class="tdGestion">Desde la fecha de salida
                                                        <input type="date" name="txtFsal">
                                                    </td>
                                                </tr>                                            
                                                <tr>
                                                    <td class="tdGestion" colspan="4">                                                    
                                                        <input type="submit" value="Reporte PDF" id="btnReportPDF" target="_blank" class="Botones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>                         
                                    <?php  
                                    }elseif(isset($_REQUEST['btnReporteProducts'])){
                                        $tit = "Productos";
                                        ?>
                    <h1>Reporte <?php echo $tit; ?> PDF</h1>
                    <fieldset class="containerGestion">                            
                            <article>
                                <section>
                                    <form method="POST" action="fpdf/reportproducts.php" target="_blank">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="tdGestion">Sede                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas las sedes</option>
                                                            <?php include "mostrarSedes.php"; ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Nombre                                          
                                                        <select class="seleccion" name="slctNombre">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todos</option>
                                                            <?php include "mostrarNombreProduct.php"; ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Unidad de Medida
                                                        <select class="seleccion" name="slctUM">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todos</option>
                                                            <?php include "mostrarUM.php"; ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Desde la fecha de ingreso
                                                        <input type="date" name="txtFreg" value="2000-01-01">
                                                    </td>
                                                </tr>                                            
                                                <tr>
                                                    <td class="tdGestion" colspan="4">                                                    
                                                        <input type="submit" value="Reporte PDF" id="btnReportPDF" target="_blank" class="Botones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>                         
                                    <?php  
                                    }elseif(isset($_REQUEST['btnReporteInProducts'])){
                                        include "fpdf/reportadmins.php"; //dificil
                                    }elseif(isset($_REQUEST['btnReporteClis'])){
                                    ?>
                                    <form method="POST" action="fpdf/reportadmins.php" target="_blank">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="tdGestion">Sede                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas las sedes</option>
                                                            <?php include "mostrarSedes.php" ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Nombre del Cliente
                                                        <select class="seleccion" name="slctNombreCli">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas los puestos</option>
                                                            <?php include "mostrarNombreCli.php" ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Desde la fecha de registro
                                                        <input type="date" name="txtFreg" value="2000-01-01">
                                                    </td>
                                                </tr>                                            
                                                <tr>
                                                    <td class="tdGestion" colspan="3">                                                    
                                                        <input type="submit" value="Reporte PDF" id="btnReportPDF" target="_blank" class="Botones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>                         
                                    <?php  
                                    }elseif(isset($_REQUEST['btnReporteVentas'])){
                                    ?>
                                    <form method="POST" action="fpdf/reportadmins.php" target="_blank">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="tdGestion">Sede                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas las sedes</option>
                                                            <?php include "mostrarSedes.php" ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Vendedor                                          
                                                        <select class="seleccion" name="slctPuesto">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas los puestos</option>
                                                            <?php include "mostrarVendedor.php" ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Desde la fecha de Venta
                                                        <input type="date" name="txtFV" value="2000-01-01">
                                                    </td>
                                                </tr>                                            
                                                <tr>
                                                    <td class="tdGestion" colspan="3">                                                    
                                                        <input type="submit" value="Reporte PDF" id="btnReportPDF" target="_blank" class="Botones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>                         
                                    <?php  
                                    }elseif(isset($_REQUEST['btnReporteInsumos'])){
                                    ?>
                                    <form method="POST" action="fpdf/reportadmins.php" target="_blank">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="tdGestion">Sede                                            
                                                        <select class="seleccion" name="slctSedes">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas las sedes</option>
                                                            <?php include "mostrarSedes.php" ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Nombre                                          
                                                        <select class="seleccion" name="slctNombre">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas los puestos</option>
                                                            <?php include "mostrarPuestos.php" ?>
                                                        </select>
                                                    </td>
                                                    <td class="tdGestion">Desde la fecha de registro
                                                        <input type="date" name="txtFreg" value="2000-01-01">
                                                    </td>
                                                    <td class="tdGestion">Unidad de Medida
                                                        <select class="seleccion" name="slctUM">
                                                            <option value="" style="background-color: rgb(230, 230, 230);" selected>Todas las sedes</option>
                                                            <?php include "mostrarUM.php" ?>
                                                        </select>
                                                    </td>
                                                </tr>                                            
                                                <tr>
                                                    <td class="tdGestion" colspan="4">                                                    
                                                        <input type="submit" value="Reporte PDF" id="btnReportPDF" target="_blank" class="Botones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>                         
                                    <?php
                                    }elseif(isset($_REQUEST['btnReporteInInsumos'])){
                                        include "fpdf/reportinsumosin.php"; //dificil
                                    }else{
                                        ?>
                                        <script>
                                            alert("¡Ocurrió un error al generar un reporte!");
                                            return false;
                                        </script>
                                        <!--<meta http-equiv="refresh" content="0;url=master.php">-->
                                        <?php
                                        die();
                                    };            
                                    ?> 
                                </section>
                            </article> 
                    </fieldset>                                        
                </div>                
            </div>           
        </div>
    </body>
</html>
<!--
<input type="button" onclick="history.back()" name="volver atrás" value="volver atrás">
<a href="javascript:history.back()"> Volver Atrás</a>
<a href="javascript:history.back()"><img src="images/boton.jpg" height="33" width="100" alt="Botón"></a>
-->