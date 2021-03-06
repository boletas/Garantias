<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Modificando Documento <small>N°<?php echo $numero_boleta; ?></small></h1>
        <?php if($idEstadoBoleta == 1){?>
            <div class="text-right">
                <a class="btn btn-outline btn-primary " href="<?php echo base_url()?>index.php/anexo_controller/SelectBoleta/<?php echo $id_Boleta?>/1">Ver y/o Agregar anexo</a>
            </div>
        <?php } ?>
        <br/>
    </div>
    <div class="col-lg-12">
        <?php 
            $form = array('name'    => 'form1');
            echo form_open(base_url()."index.php/boleta_controller/ModificaBoleta",$form);
        ?>
        <table class="table table-bordered">
            <tr>
                <td class="active">Rut</td>
                <td colspan="6"><?php echo $rut; ?></td>
            </tr>
            <tr>
                <td class="active">Razón Social</td>
                <td colspan="6"><div id="razon_social"><?php echo $nombre; ?></div>
                </td>
            </tr>
            <tr class="active">
                <td>N° Documento</td>
                <td>Fecha Recepción</td>
                <td>Fecha Emisión</td>
                <td>Fecha Vecimiento</td>
                <td colspan="3">Vence</td>
            </tr>
            <tr>
                <td>
                    <input type="text" required="true" class="form-control" name="numero_boleta" onkeypress="return ValidNum(this)" id="numero_boleta" value="<?php echo $numero_boleta; ?>"/>
                </td>
                <td>
                    <div id="sandbox-container" style="width: 150px">
                        <div class="input-group date">
                            <input type="text" class="form-control"  name="recepcion" id="recepcion" onfocus="this.blur();" value="<?php echo $fecha_recepcion;?>"/><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div id="sandbox-container" style="width: 135px">
                        <div class="input-group date">
                            <input type="text" class="form-control"  style="width: 100px" name="emision" id="emision" onfocus="this.blur();" value="<?php echo $fecha_emision;?>"/><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div id="sandbox-container" style="width: 135px">
                        <div class="input-group date">
                            <input type="text" class="form-control"  style="width: 100px" name="vencimiento" id="vencimiento" onfocus="this.blur();" value="<?php echo $fecha_vencimiento;?>"/><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </td>
                <td colspan="3" <?=($clase ? $clase : "")?>><?php echo $vence; ?></td>
            </tr>
            <tr class="active">
                <td>Tipo Garantía</td>
                <td colspan="4">Denominación de Estudio</td>
                <td colspan="2">Banco</td>
            </tr>
            <tr>
                <td><?php echo $tipo_garantia; ?></td>
                <td colspan="4"><input type="text" class="form-control" required="true"  name="denominacion" id="denominacion" value="<?php echo $denominacion; ?>"/></td>
                <td colspan="2"><?php echo $nombre_banco; ?></td>
            </tr>
            <tr class="active">
                <td colspan="2">Tipo Documento</td>
                <td colspan="2">Estado Documento</td>
                <td colspan="3">Costo Total</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $tipo_boleta ?></td>
                <td colspan="2"><?php echo $estado_boleta ?></td>
                <td align="center"><?php echo $codigo ?></td>
                <td colspan="2">
                    <input type="text" required="true" class="form-control" onkeyup="format(this)" onchange="format(this)"  name="monto" value="<?php echo $monto_boleta; ?>"/>
                </td>
            </tr>
        </table>
        <div align="right">
            <button class="btn btn-outline btn-default" name="volver" id="volver" onclick="Volver()">Volver</button>
            <button type="submit" class="btn btn-outline btn-primary" name="Modificar" id="Modificar" onclick="return ValidaFechasBoleta(document.getElementById('recepcion').value,document.getElementById('emision').value,document.getElementById('vencimiento').value)">Aceptar</button>
        </div>
        <input type="hidden" name="volver" id="volver" />
        <input type="hidden" name="id_boleta" id="id_boleta" value="<?php echo $id_Boleta; ?>"/>
        <input type="hidden" name="base" id="base" value="<?php echo base_url()?>"/>
        <?php echo form_close(); ?>
    </div>
    
<script>
function Volver(){
    document.form1.action = "<?php echo base_url()."index.php/boleta_controller/Volver"?>";
}

$('#sandbox-container .input-group.date').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "dd-mm-yyyy"
});

$('select#rut').on('change',function(){});

$(document).ready(function(){
    if ($("div#mensaje")) {
    setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
}});
</script>