<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Nuevo Documento</h1>
    </div>
    <div class="col-lg-12">
                <?php 
                    
                    foreach ($entidad as $value) {
                        $idEntidad = $value->idEntidad;
                        $nombre = $value->nombre;

                    }
                    
                    ?>
                <div class="col-lg-10">
                        <?php 
                            if(validation_errors()){?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo validation_errors();?>
                                </div>
                        <?php } ?>
                </div>    
                   
                <div class="col-lg-12">        
                        
                        <form name="form1" method="post" action="<?php echo base_url()?>index.php/boleta_controller/insert_boleta">      

                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td class="active">Rut</td>
                            <td colspan="7"><input type="text" class="form-control" disabled="true" value="<?php echo $this->session->userdata('rut_entidad_form')?>" /></td>
                        </tr>
                        <tr>
                            <td class="active">Razón Social</td>
                            <td colspan="7"><div id="razon_social"><input type="text" class="form-control" disabled="true" value="<?php echo $nombre?>" /></div></td>
                        </tr>
                        <tr class="active">
                            <td>N° Documento</td>
                            <td>Fecha Recepción</td>
                            <td>Fecha Emisión</td>
                            <td colspan="2">Fecha Vecimiento</td>
                            <td colspan="3">Tipo Documento</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="num_boleta" value="<?php echo set_value('num_boleta');?>" class="form-control" placeholder="Numero de documento">
                            </td>
                            <td>
                                <div id="sandbox-container" style="width: 150px">
                                    <div class="input-group date">
                                        <input type="text" name="fecha_recepcion" id="fecha_recepcion" class="form-control" onfocus="this.blur();" required value="<?php echo date("d-m-Y")?>" /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div id="sandbox-container" style="width: 140px">
                                    <div class="input-group date">
                                        <input type="text" name="fecha_emision" id="fecha_emision" class="form-control" onfocus="this.blur();" required value="<?php echo date("d-m-Y")?>" /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div id="sandbox-container" style="width: 140px">
                                    <div class="input-group date" style="width: 140px">
                                        <input type="text" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" onfocus="this.blur();" required value="<?php echo date("d-m-Y")?>" /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td colspan="3">
                                <select name="id_tipo" class="form-control">
                                            <?php foreach ($tipos as $tipo) { ?>
                                                <option value="<?php echo $tipo->idTipoBoleta ?>"><?php echo $tipo->descripcion_tipo_boleta ?></option>
                                            <?php }?>
                                </select>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>Tipo Garantía</td>
                            <td colspan="4">Denominación de Estudio</td>
                            <td colspan="3">Banco</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="id_garantia" class="form-control">
                                    <?php foreach ($garantias as $garantia) { ?>
                                        <option value="<?php echo $garantia->idTipoGarantia ?>"><?php echo $garantia->descripcion ?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <td colspan="4"><input type="text" name="denominacion" value="<?php echo set_value('denominacion');?>" class="form-control"/></td>
                            <td colspan="3">
                                <select name="id_banco" class="form-control">
                                    <?php foreach ($bancos as $banco) { ?>
                                        <option value="<?php echo $banco->idBanco ?>"><?php echo $banco->nombre_banco ?></option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="active">Monto Documento</td>
                            <td><input type="text" class="form-control" onkeyup="format(this)" onchange="format(this)" name="monto_boleta" value="<?php echo set_value('monto_boleta');?>" placeholder="Monto documento" id="monto_boleta" /></td>
                            <td colspan="3">
                                <select name="id_moneda" class="form-control">
                                    <?php foreach ($monedas as $moneda) { ?>
                                        <option value="<?php echo $moneda->idMoneda ?>"><?php echo $moneda->nombre_moneda ?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <td colspan="3">
                                <a class="btn btn-default" href="<?php echo base_url();?>index.php/plantilla_controller/?sec=nueva_boleta">Volver</a>
                                <input onclick=" return ValidaFechasBoleta(document.getElementById('fecha_recepcion').value,document.getElementById('fecha_emision').value,document.getElementById('fecha_vencimiento').value)" type="submit" class="btn btn-outline btn-primary" value="Guardar" name="guardar"/>
                            </td>
                            <input type="hidden" name="idEntidad" id="idEntitad" value="<?php echo $idEntidad;?>" />
                        </tr>
                    </table>
                </form>
            </div>
<script>
//fin valida num

$('#sandbox-container .input-group.date').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "dd-mm-yyyy"
});


function format(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
}


</script>

