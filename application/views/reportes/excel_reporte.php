<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte".date('Y-m-d-His').".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
<table border="1">
    <tr>
        <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>N°</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Rut</b></td>
        <!--<td class="active"><b>Nombre</b></td>-->
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Emisón</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Vencimiento</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Tipo</b></td>
        <td class="active" colspan="2" align="center" style="width: 120px" style="color: #ffffff; background: #333333"><b>Montos</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Monto (CLP)</b></td>
    </tr>
    <?php echo $html; ?>
    <tr>
        <td colspan="7" align="right"><b>Monto Total &nbsp;</b></td>
        <td align="right"><b>$ <?php echo $total; ?>.-</b></td>
    </tr>
</table>