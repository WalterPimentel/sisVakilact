<input type="button" onclick="history.back()" name="volver atrás" value="volver atrás">
<!--
<a href="javascript:history.back()"> Volver Atrás</a>
<a href="javascript:history.back()"><img src="images/boton.jpg" height="33" width="100" alt="Botón"></a>
-->
<?php
if(isset($_REQUEST['btnReporteAdmins'])){    
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteVendedores'])){
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteSedes'])){
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteProducts'])){
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteInProducts'])){
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteClis'])){
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteVentas'])){
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteProvees'])){
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteInsumos'])){
    include "fpdf/reportadmins.php";
}elseif(isset($_REQUEST['btnReporteInInsumos'])){
    include "fpdf/reportadmins.php";
}else{
    ?>
    <script>
        alert("¡Ocurrió un error al generar un reporte!");
        return false;
    </script>
    <?php
};
?>