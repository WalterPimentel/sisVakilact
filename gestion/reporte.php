<?php
if(isset($_REQUEST['btnReporteAdmins'])){

}elseif(isset($_REQUEST['btnReporteVendedores'])){

}elseif(isset($_REQUEST['btnReporteSedes'])){

}elseif(isset($_REQUEST['btnReporteProducts'])){

}elseif(isset($_REQUEST['btnReporteInProducts'])){

}elseif(isset($_REQUEST['btnReporteClis'])){

}elseif(isset($_REQUEST['btnReporteVentas'])){
    
}elseif(isset($_REQUEST['btnReporteProvees'])){

}elseif(isset($_REQUEST['btnReporteInsumos'])){

}elseif(isset($_REQUEST['btnReporteInInsumos'])){

}else{
    ?>
    <script>
        alert("¡Ocurrió un error al generar un reporte!");
        return false;
    </script>
    <?php
}
?>