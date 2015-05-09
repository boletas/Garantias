<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Modificando Boleta <small>N°<?php echo $numero_boleta; ?></small></h1>
    </div>
    <div class="col-lg-12">
        <?php 
            $form = array('name'    => 'form1');
            echo form_open(base_url()."index.php/boleta_controller/ModificaBoleta",$form);
        ?>
        <table class="table table-bordered">
            <tr>
                <td class="active">Rut</td>
                <td colspan="6"><input type="text" class="form-control" name="rut" id="rut" value="<?php echo $rut; ?>"/></td>
            </tr>
            <tr>
                <td class="active">Razón Social</td>
                <td colspan="6"><input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"/></td>
            </tr>
            <tr class="active">
                <td>N° Boleta</td>
                <td>Estado Boleta</td>
                <td>Fecha Recepción</td>
                <td>Fecha Emisión</td>
                <td>Fecha Vecimiento</td>
                <td colspan="2">Vence</td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="form-control" name="numero_boleta" id="numero_boleta" value="<?php echo $numero_boleta; ?>"/>
                </td>
                <td><?php echo $estado_boleta; ?></td>
                <td>
                    <div id="sandbox-container" style="width: 150px">
                        <div class="input-group date">
                            <input type="text" class="form-control" name="recepcion" id="recepcion" onfocus="this.blur();" value="<?php echo $fecha_recepcion;?>"/><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div id="sandbox-container" style="width: 135px">
                        <div class="input-group date">
                            <input type="text" class="form-control" style="width: 100px" name="emision" id="emision" onfocus="this.blur();" value="<?php echo $fecha_emision;?>"/><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div id="sandbox-container" style="width: 135px">
                        <div class="input-group date">
                            <input type="text" class="form-control" style="width: 100px" name="vencimiento" id="vencimiento" onfocus="this.blur();" value="<?php echo $fecha_vencimiento;?>"/><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                </td>
                <td colspan="2" <?=($clase ? $clase : "")?>><?php echo $vence; ?></td>
            </tr>
            <tr class="active">
                <td>Tipo Garantía</td>
                <td colspan="4">Denominación de Estudio</td>
                <td colspan="2">Banco</td>
            </tr>
            <tr>
                <td><?php echo $tipo_garantia; ?></td>
                <td colspan="4"><input type="text" class="form-control" name="denominacion" id="denominacion" value="<?php echo $denominacion; ?>"/></td>
                <td colspan="2"><?php echo $nombre_banco; ?></td>
            </tr>
            <tr>
                <td colspan="5" align="right" class="active"><b>Costo Total</b></td>
                <td><?php echo $codigo; ?></td>
                <td>
                    <input type="text" class="form-control" name="monto" id="monto" onkeypress="return ValidNum(this);" value="<?php echo $monto_boleta; ?>"/>
                </td>
            </tr>
        </table>
        <div align="right">
            <button class="btn btn-outline btn-default" name="volver" id="volver" onclick="Volver()">Volver</button>
            <button class="btn btn-outline btn-primary" name="Modificar" id="Modificar" onclick="Accion(2,<?php echo $id_Boleta?>)">Aceptar </button>
            <!--<button class="btn btn-outline btn-danger" name="PDF" id="PDF">PDF <i class="fa fa-file-pdf-o"></i></button>-->
        </div>
        <input type="hidden" name="volver" id="volver" />
        <input type="hidden" name="id_boleta" id="id_boleta" value="<?php echo $id_Boleta; ?>"/>
        <?php echo form_close(); ?>
    </div>
<script>
function Volver(){
    document.form1.action = "<?php echo base_url()."index.php/boleta_controller/Volver"?>";
}

$('#rut').Rut({
    on_error: function(){ alert('Favor ingrese un rut valido'); 
    document.getElementById('rut').focus();
    }
});

$('#sandbox-container .input-group.date').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "mm-dd-yyyy"
});
</script>
</div>