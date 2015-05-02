<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detalles Boleta <small>N°<?php echo $numero_boleta; ?></small></h1>
    </div>
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <td class="active">Rut</td>
                <td colspan="5"><?php echo $rut; ?></td>
            </tr>
            <tr>
                <td class="active">Razón Social</td>
                <td colspan="5"><?php echo $nombre; ?></td>
            </tr>
            <tr class="active">
                <td>N° Boleta</td>
                <td>Estado Boleta</td>
                <td>Fecha Recepción</td>
                <td>Fecha Emisión</td>
                <td>Fecha Vecimiento</td>
                <td>Vence</td>
            </tr>
            <tr>
                <td><?php echo $numero_boleta; ?></td>
                <td><?php echo $estado_boleta; ?></td>
                <td><?php echo $fecha_recepcion; ?></td>
                <td><?php echo $fecha_emision; ?></td>
                <td><?php echo $fecha_vencimiento; ?></td>
                <td <?=($clase ? $clase : "")?>><?php echo $vence; ?></td>
            </tr>
            <tr class="active">
                <td>Tipo Garantía</td>
                <td colspan="4">Denominación de Estudio</td>
                <td>Banco</td>
            </tr>
            <tr>
                <td><?php echo $tipo_garantia; ?></td>
                <td colspan="4"><?php echo $denominacion; ?></td>
                <td><?php echo $nombre_banco; ?></td>
            </tr>
            <tr>
                <td colspan="5" align="right" class="active"><b>Costo Total</b></td>
                <td><b><?php echo $monto_boleta; ?></b></td>
            </tr>
        </table>
    </div>
</div>