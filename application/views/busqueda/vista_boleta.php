<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detalle Documento <small>N°<?php echo $numero_boleta; ?></small></h1>
            <div class="text-right">
                <a class="btn btn-outline btn-primary " href="<?php echo base_url()?>index.php/anexo_controller/SelectBoleta/<?php echo $id_Boleta?>/2">Ver y/o Agregar anexo</a>
            </div>
        <br/>
    </div>
    <div class="col-lg-12">
        <?php 
            $form = array('name' => 'form1');
            echo form_open(base_url()."index.php/boleta_controller/ResultadoBoletas",$form);
        ?>
        <table class="table table-bordered">
            <tr>
                <td class="active">Rut</td>
                <td colspan="6"><?php echo $rut; ?></td>
            </tr>
            <tr>
                <td class="active">Razón Social</td>
                <td colspan="6"><?php echo $nombre; ?></td>
            </tr>
            <tr class="active">
                <td>N° Documento</td>
                <td>Fecha Recepción</td>
                <td>Fecha Emisión</td>
                <td>Fecha Vencimiento</td>
                <td colspan="3" width="250px">Vence</td>
            </tr>
            <tr>
                <td><?php echo $numero_boleta; ?></td>
                <td><?php echo $fecha_recepcion; ?></td>
                <td><?php echo $fecha_emision; ?></td>
                <td><?php echo $fecha_vencimiento; ?></td>
                <td colspan="3" <?=($clase ? $clase : "")?>><?php echo $vence; ?></td>
            </tr>
            <tr class="active">
                <td>Tipo Garantía</td>
                <td colspan="3">Denominación de Estudio</td>
                <td colspan="3">Banco</td>
            </tr>
            <tr>
                <td><?php echo $tipo_garantia; ?></td>
                <td colspan="3"><?php echo $denominacion; ?></td>
                <td colspan="3"><?php echo $nombre_banco; ?></td>
            </tr>
            <tr class="active">
                <td colspan="2">Tipo Documento</td>
                <td colspan="2">Estado Documento</td>
                <td colspan="3">Costo Total</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $tipo_boleta ?></td>
                <td colspan="2"><?php echo $estado_boleta ?></td>
                <td colspan="3"><b><?php echo $monto_boleta; ?></b></td>
            </tr>
        </table>
        <div align="right">
            <button class="btn btn-outline btn-default" name="volver" id="volver" onclick="Volver()">Volver</button>
            <?php if(!$idEstadoBoleta == 2){?>
            <button class="btn btn-outline btn-primary" name="Modificar" id="Modificar" onclick="Accion(2,<?php echo $id_Boleta?>)">Modificar <i class="fa fa-pencil"></i></button>
            <?php } ?>
        </div>
        <input type="hidden" name="volver" id="volver" /> 
        <input type="hidden" name="que" id="que" /> 
        <input type="hidden" name="id_boleta" id="id_boleta" />
        <?php echo form_close(); ?>
    </div>
<script>
function Accion(accion,id){
    document.getElementById('que').value = accion;
    document.getElementById('id_boleta').value = id;
    document.form1.submit();
}

function Volver(){
    document.form1.action = "<?php echo base_url()."index.php/boleta_controller/Volver"?>";
}
</script>