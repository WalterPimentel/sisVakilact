<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title >Reporte Excel</title>
        <link rel="stylesheet" href="../estilos/estilos.css">
    </head>
    <body>
    <?php
    require_once("../index.php");
    ?>
        <div class="divGeneral">
            <div class="divGestion">
                <div class="divRegsitro">
                    <h1>Reporte Administradores Excel</h1>
                    <fieldset class="containerGestion">                            
                            <article>
                                <section>                                    
                                    <?php            
                                    if(isset($_REQUEST['btnReporteAdminsxl'])){
                                    ?>
                                    <form method="POST" action="../reporteadminsxl.php" target="_blank">
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
                                                        <input type="submit" value="Reporte Excel" id="btnReportXL" target="_blank" class="Botones">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>                         
                                    <?php                                                
                                    }elseif(isset($_REQUEST['btnReporteVendedoresxl'])){
                                    ?>
                                    <form method="POST" action="fpdf/reporteadminsxl.php" target="_blank">
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
                                    }elseif(isset($_REQUEST['btnReporteSedesxl'])){
                                        include "fpdf/reportsedes.php";
                                    }elseif(isset($_REQUEST['btnReporteProductsxl'])){
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
                                    }elseif(isset($_REQUEST['btnReporteInProductsxl'])){
                                        include "fpdf/reportadmins.php"; //dificil
                                    }elseif(isset($_REQUEST['btnReporteClisxl'])){
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
                                    }elseif(isset($_REQUEST['btnReporteVentasxl'])){
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
                                    }elseif(isset($_REQUEST['btnReporteProveesxl'])){
                                        include "fpdf/reportprovees.php";
                                    }elseif(isset($_REQUEST['btnReporteInsumosxl'])){
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
                                    }elseif(isset($_REQUEST['btnReporteInInsumosxl'])){
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