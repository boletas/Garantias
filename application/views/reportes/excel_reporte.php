<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte".date('Y-m-d-His').".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
<table border="1">
    <tr>
        <td><b>N°</b></td>
        <td><b>Rut</b></td>
        <td><b>Nombre</b></td>
        <td><b>Tipo</b></td>
        <td><b>Monto</b></td>
    </tr>
    <?php echo $html; ?>
    <tr>
        <td colspan="4" align="right"><b>Monto Total &nbsp;</b></td>
        <td align="right"><b>$ <?php echo $total; ?>.-</b></td>
    </tr>
</table>