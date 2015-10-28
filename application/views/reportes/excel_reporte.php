<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte".date('Y-m-d-His').".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
<table border="1">
    <tr>
        <td>Vencimiento:</td>
        <td><?=($datos['vence'] == 1 ? "Vencidas" : ($datos['vence'] == 2 ? "Por vencer" : "Vencidas y Por vencer"))?></td>
    </tr>
    <tr>
        <td>Tipo Busqueda:</td>
        <td><?=($datos['tipo'] == 1 ? "Todas" : ($datos['tipo'] == 2 ? "RUT" : "Tipo de Boleta"))?></td>
    </tr>
    <tr>
        <td>Estado:</td>
        <td><?=($datos['estado'] == 0 ? "Todas" : ($datos['estado'] == 1 ? "Custodia" : ($datos['estado'] == 2 ? "Entregada" : "Pendiente")))?></td>
    </tr>
    <tr>
        <td>Periodo:</td>
        <td><?=($datos['periodo'] == 1 ? "Todas" : ($datos['periodo'] == 10 ? "10 Días" : ($datos['periodo'] == 20 ? "20 Días" : ($datos['periodo'] == 30 ? "30 Días" : ($datos['periodo'] == 60 ? "60 Días" : "90 Días")))))?></td>
    </tr>
    <tr>
        <td colspan="9">&nbsp;</td>
    </tr>
    <tr>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>N°</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Rut</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Emisón</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Vencimiento</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Tipo</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Vece en</b></td>
        <td class="active" colspan="2" align="center" style="width: 120px" style="color: #ffffff; background: #333333"><b>Montos</b></td>
        <td class="active" style="width: 120px" style="color: #ffffff; background: #333333"><b>Monto (CLP)</b></td>
    </tr>
    <?php echo $html; ?>
    <tr>
        <td colspan="8" align="right"><b>Monto Total &nbsp;</b></td>
        <td align="right"><b>$ <?php echo $total; ?>.-</b></td>
    </tr>
</table>