<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
    <title>Salida Insumos</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>

<body>
    <?php

    use LDAP\Result;

    require_once("home.php");
    $scriptSelectInsum = "SELECT * FROM insumos ORDER BY NOMBRE_PRODCUTO ASC";
    $scriptSelectInsumIn = "SELECT * FROM insumos_in ORDER BY ID_inINSUMO DESC";
    $scriptSelectInsumOut = "SELECT * FROM insumos_out ORDER BY ID_SALIDA DESC";
    if (isset($_REQUEST['btnCancelar'])) {
    ?>
        <meta http-equiv="refresh" content="0;url=insumos_out.php">
    <?php
    }
    ?>
    <div class="divGeneral" style="margin-top: 100px;">
        <div class="divGestion">
            <div class="divRegsitro">
                <form action="insumos_out.php" method="POST">
                    <h1>Gestión Salida de Insumos</h1>
                    <fieldset class="containerGestion">
                        <article class="fondoWhite">
                            <section class="fondoWhite">
                                <?php
                                if (!isset($_REQUEST['btnEditar'])) {
                                ?>
                                    <table>
                                        <tr>
                                            <input type="hidden" name="txtID">
                                            <td class="tdGestion">Insumo Saliente y Lugar
                                                <form>
                                                    <select class="seleccion" name="slctProduct">
                                                        <?php
                                                        if ($resultado = mysqli_query($miconex, $scriptSelectInsum)) {
                                                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                                                $idsede = $fila['ID_SEDE'];
                                                                $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                                                $resultado2 = mysqli_query($miconex, $scriptSelectNombreSedes);
                                                                $columSedes = mysqli_fetch_assoc($resultado2);
                                                        ?>
                                                                <option value="<?php echo $fila['ID_INSUMO']; ?>"><?php echo $fila['NOMBRE_PRODCUTO']; ?> - <?php echo $columSedes['NOMBRE']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="tdGestion">Cantidad<input type="number" name="txtCant" min="1" required></td>
                                            <td class="tdGestion">Fecha de Salida<input type="date" name="txtFechaSalida" id="fechaActual"></td>
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
                                } elseif (isset($_REQUEST['btnEditar'])) {

                                    $idSalida = $_POST['btnEditar'];
                                    $scriptSelectSalidaporID = "SELECT * FROM insumos_out WHERE ID_SALIDA ='$idSalida'";
                                    $llenarDatosSalida = mysqli_query($miconex, $scriptSelectSalidaporID);
                                    $llenado = mysqli_fetch_assoc($llenarDatosSalida);

                                    $idsede = $llenado['ID_SEDE'];
                                    $idinsum = $llenado['ID_INSUMO'];

                                    $scriptSelectInsumporIDnoDef = "SELECT * FROM insumos WHERE NOT ID_INSUMO ='$idinsum'";
                                    $scriptSelectInsumoporIDDef = "SELECT NOMBRE_PRODCUTO FROM insumos WHERE ID_INSUMO ='$idinsum'";
                                    $scriptSelectSedeporIDDef = "SELECT NOMBRE FROM sedes WHERE ID_SEDE ='$idsede'";

                                ?>
                                    <table>
                                        <input type="hidden" name="txtID" value="<?php echo $llenado['ID_SALIDA']; ?>">
                                        <tr>
                                            <td class="tdGestion">Insumo Saliente y Lugar
                                                <form>
                                                    <select class="seleccion" name="slctProduct" disabled>
                                                        <?php
                                                        if ($resultado = mysqli_query($miconex, $scriptSelectInsumporIDnoDef)) {

                                                            $resultado2 = mysqli_query($miconex, $scriptSelectInsumoporIDDef);
                                                            $llenarInsumDef = mysqli_fetch_assoc($resultado2);
                                                            $resultado3 = mysqli_query($miconex, $scriptSelectSedeporIDDef);
                                                            $llenarSedeDef = mysqli_fetch_assoc($resultado3);
                                                        ?>
                                                            <option value="<?php echo $llenado['ID_SALIDA']; ?>" selected><?php echo $llenarInsumDef['NOMBRE_PRODCUTO']; ?> - <?php echo $llenarSedeDef['NOMBRE']; ?></option>
                                                            <?php
                                                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                                                $idsede = $fila['ID_SEDE'];
                                                                $idinsum = $fila['ID_INSUMO'];

                                                                $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                                                $resultado4 = mysqli_query($miconex, $scriptSelectNombreSedes);
                                                                $columSedes = mysqli_fetch_assoc($resultado4);

                                                                $scriptSelectNombreInsum = "SELECT NOMBRE_PRODCUTO FROM insumos WHERE ID_INSUMO = '$idinsum'";
                                                                $resultado5 = mysqli_query($miconex, $scriptSelectNombreInsum);
                                                                $columInsum = mysqli_fetch_assoc($resultado5);
                                                            ?>
                                                                <option value="<?php echo $llenado['ID_INGRESO']; ?>"><?php echo $columInsum['NOMBRE_PRODCUTO']; ?> - <?php echo $columSedes['NOMBRE']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="tdGestion">Cantidad<input type="text" name="txtCant" value="<?php echo $llenado['CANTIDAD']; ?>" min="1" disabled></td>
                                            <td class="tdGestion">Fecha de Salida<input type="date" name="txtFechaSalida" value="<?php echo $llenado['F_SALIDA']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td class="tdGestion" colspan="6">
                                                <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                            </td>
                                        <?php
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
                <form action="productos_out.php" method="GET">
                    <input type="text" id="txtBuscar" class="txtBuscar" placeholder="Buscar por DNI, apellido o nombre" maxlength="64">
                    <input type="submit" value="Buscar" name="btnBuscar" class="Botones">
                </form>
            </div>
            <?php
            if (isset($_REQUEST['btnRegistrar'])) {
                $idinsum = $_POST['slctProduct'];
                $scriptSelectProductId = "SELECT ID_SEDE, NOMBRE_PRODCUTO, STOCK, PRECIO_COMPRA, PRECIO_VENTA  FROM insumos WHERE ID_INSUMO = '$idinsum';";
                $resultado = mysqli_query($miconex, $scriptSelectProductId);
                $fila = mysqli_fetch_assoc($resultado);
                $idsede = $fila['ID_SEDE'];
                $cantidad = intval($_POST['txtCant']);
                $prov = $_POST['slctProve'];
                $PCompra = $fila['PRECIO_COMPRA'] * $cantidad;
                $pTot = $fila['PRECIO_VENTA'] * $cantidad;
                $fSalida = $_POST['txtFechaSalida'];

                $scriptInsertInsumIn = "INSERT INTO insumos_out (ID_INSUMO, ID_SEDE, CANTIDAD, P_COMPRA, P_TOTAL, P_VENTA, F_SALIDA)
                                                            VALUES ('$idinsum', '$idsede', '$cantidad', '$PCompra', '$pTot', '0', '$fSalida');";

                $stockP = intval($fila['STOCK']);
                $resta = intval($stockP - $cantidad);
                $scriptInsertStockInsum = "UPDATE insumos SET STOCK = '$resta' WHERE ID_INSUMO = '$idinsum';";


                if ((mysqli_query($miconex, $scriptInsertStockInsum) === true) and mysqli_query($miconex, $scriptInsertInsumIn) === true) {
            ?>
                    <script>
                        alert("¡Exito!, Los datos se registraron correctamente");
                    </script>
                    <meta http-equiv="refresh" content="0;url=insumos_out.php">
                <?php
                } else {
                    $error = mysqli_error($miconex) . " Error número: " . mysqli_errno($miconex);
                ?>
                    <script>
                        alert("Error al Registrar datos: <?php echo $error; ?>");
                    </script>
                <?php
                }                
            }

            if (isset($_REQUEST['btnModificar'])) {
                $id = $_POST['txtID'];
                $fSalida = $_POST['txtFechaSalida'];

                $scriptModificarProduct = "UPDATE insumos_in SET F_INGRESO = '$fSalida' WHERE ID_SALIDA = '$id'";

                if (mysqli_query($miconex, $scriptModificarProduct) === true) {
                ?>
                    <script>
                        alert("¡Exito!, Los datos se actualizaron correctamente");
                    </script>
                    <meta http-equiv="refresh" content="0;url=insumos_out.php">
                <?php
                } else {
                    $error = mysqli_error($miconex) . " Error número: " . mysqli_errno($miconex);
                ?>
                    <script>
                        alert("Error al Modificar datos: <?php echo $error; ?>");
                    </script>
                <?php
                }
            }

            if (isset($_REQUEST['btnEliminar'])) {

                $idinsumEliminar = $_POST['btnEliminar'];
                $scriptSelectCanridadIngreso = mysqli_query($miconex, "SELECT CANTIDAD, ID_INSUMO FROM insumos_out WHERE ID_SALIDA = '$idinsumEliminar'");
                $cantidadSale = mysqli_fetch_assoc($scriptSelectCanridadIngreso);
                $sustraendo = intval($cantidadSale['CANTIDAD']);
                $idinsum = $cantidadSale['ID_INSUMO'];

                $nombreEliminar = mysqli_query($miconex, "SELECT NOMBRE_PRODCUTO, STOCK FROM insumos WHERE ID_INSUMO = '$idinsum'");
                $llamarNombreEliminar = mysqli_fetch_assoc($nombreEliminar);
                $minunedo = intval($llamarNombreEliminar['STOCK']);
                $stock = intval($minunedo + $sustraendo);
                $ScriptRestarStock = "UPDATE insumos SET STOCK = '$stock' WHERE ID_INSUMO = '$idinsum'";

                $scriptEliminarInsum = "DELETE FROM insumos_out WHERE ID_SALIDA = '$idinsumEliminar'";

                if (mysqli_query($miconex, $scriptEliminarInsum) === true and mysqli_query($miconex, $ScriptRestarStock) === true) {
                ?>
                    <script>
                        alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE_PRODCUTO']; ?>, se borró correctamente");
                    </script>
                    <meta http-equiv="refresh" content="0;url=insumos_out.php">
                <?php
                } else {
                    $error = mysqli_error($miconex) . " Error número: " . mysqli_errno($miconex);
                ?>
                    <script>
                        alert("Error al Eliminar registro: <?php echo $error; ?>");
                    </script>
                <?php
                }
            }

            if ($resultado = mysqli_query($miconex, $scriptSelectInsumOut)) {
                ?>
                <div class="div_tabla" style="overflow: auto;">
                    <table border="1" class="tablaRegistros">
                        <tr bgcolor="4C4C4C" style="color: white;">
                            <td><b>&nbsp;ID</b>&nbsp;</td>
                            <td><b>&nbsp;Nombre&nbsp;</b></td>
                            <td><b>&nbsp;Sede</b>&nbsp;</td>
                            <td><b>&nbsp;Cant.&nbsp;</b></td>
                            <td><b>&nbsp;P. tot. Compra&nbsp;</b></td>
                            <td><b>&nbsp;P. Tot. Venta&nbsp;</b></td>
                            <td><b>&nbsp;F. Salida&nbsp;</b></td>
                            <td><b>&nbsp;Acción&nbsp;</b></td>
                        </tr>
                        <?php
                        $c = 1;
                        while ($fila = mysqli_fetch_assoc($resultado) and $c >= 1) {

                            $idsede = $fila['ID_SEDE'];
                            $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede';";
                            $resultado2 = mysqli_query($miconex, $scriptSelectNombreSedes);
                            $columSedes = mysqli_fetch_assoc($resultado2);

                            $idinsum = $fila['ID_INSUMO'];
                            $scriptSelectNombreInsum = "SELECT NOMBRE_PRODCUTO FROM insumos WHERE ID_INSUMO = '$idinsum'";
                            $resultado3 = mysqli_query($miconex, $scriptSelectNombreInsum);
                            $columInsum = mysqli_fetch_assoc($resultado3);

                        ?>
                            <form value="<?php echo $fila['ID_SALIDA']; ?>" id="<?php echo $fila['ID_SALIDA']; ?>" action='insumos_out.php' method='post'>
                                <tr bgcolor="<?php if (intval($c) % 2 == 0) echo 'E6E6E6';
                                                else echo 'white' ?>">
                                    <td style="display: none;"><?php $c++; ?></td>
                                    <td><b>&nbsp;<?php echo $fila['ID_SALIDA']; ?>&nbsp;</b></td>
                                    <td>&nbsp;<?php echo $columInsum['NOMBRE_PRODCUTO']; ?>&nbsp;</td>
                                    <td>&nbsp;<?php echo $columSedes['NOMBRE']; ?>&nbsp;</td>
                                    <td>&nbsp;<?php echo $fila['CANTIDAD']; ?>&nbsp;</td>
                                    <td>&nbsp;<?php echo "S/. " . $fila['P_COMPRA']; ?>&nbsp;</td>
                                    <td>&nbsp;<?php echo "S/. " . $fila['P_TOTAL']; ?>&nbsp;</td>
                                    <td>&nbsp;<?php echo $fila['F_SALIDA']; ?>&nbsp;</td>
                                    <td class="tdBotonTabla">
                                        <button type="submit" id="<?php echo $fila['ID_SALIDA']; ?>" value="<?php echo $fila['ID_SALIDA']; ?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                        <button type="submit" id="<?php echo $fila['ID_SALIDA']; ?>" value="<?php echo $fila['ID_SALIDA']; ?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>
                                    </td>
                                </tr>
                            </form>
                        <?php
                        } ?>
                    </table>
                </div>
            <?php
            }
            mysqli_close($miconex);
            ?>
            <br>
            <table align="center">
                <tbody>
                    <tr>
                        <td>
                            <form action="reporte.php" method="POST">
                                <button type="submit" name="btnReporteInInsumos" class="Botones">Reporte en PDF</button>
                            </form>
                        </td>
                        <td>
                            <form action="reporteXL.php" method="POST">
                                <button type="submit" name="btnReporteInInsumosxl" class="Botones">Reporte en Excel</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../js/predeterminado.js"></script>
    <script src="../js/funciones.js"></script>
</body>

</html>