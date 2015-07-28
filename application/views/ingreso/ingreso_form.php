<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Nueva Boleta</h1>
    </div>
    <div class="col-lg-12">
                <?php 
                    
                    $idEntidad = $entidad->idEntidad;
                    
                
                    $rut = array(
                                    'class'         => 'form-control',
                                    'type'          => 'text',
                                    'id'            => 'disabledInput',
                                    'disabled'      => 'true',
                                    'value'         => $this->session->userdata('rut_entidad_form')
                                    
                                  );
                    $nombreEntidad = array(
                                    'class'         => 'form-control',
                                    'type'          => 'text',
                                    'id'            => 'disabledInput',
                                    'disabled'      => 'true',
                                    'value'         => $entidad->nombre
                                    
                                  );
                    
                
                    $num_boleta = array(
                                    'name'          => 'num_boleta',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Numero de boleta',
                                    'type'          => 'text',
                                    'value'         => set_value('num_boleta'),
                                    'required'      => ''
                                  );
                    $monto_boleta = array(
                                    'name'          => 'monto_boleta',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Monto boleta',
                                    'type'          => 'text',
                                    'onkeypress'    => 'return ValidNum(this);',
                                    'required'      => 'true'
                                  );
                    $fecha_recepcion = array(
                                    'name'          => 'fecha_recepcion',
                                    'class'         => 'form-control',
                                    'type'          => 'text',
                                    'required'      => 'true'
                                  );
                    $fecha_emision = array(
                                    'name'          => 'fecha_emision',
                                    'class'         => 'form-control',
                                    'type'          => 'text',
                                    'style'         => 'width:100px',
                                    'required'      => 'true'
                                  );
                    $fecha_vencimiento = array(
                                    'name'          => 'fecha_vencimiento',
                                    'class'         => 'form-control',
                                    'type'          => 'text',
                                    'style'         => 'width:100px',
                                    'required'      => 'true'
                                  );
                    $denominacion = array(
                                    'name'          => 'denominacion',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Denominacion de estudio',
                                    'type'          => 'text',
                                    'required'      => ''
                                  );
                    
                    $btn_insertar = array (
                                    'name'          => 'Guardar',
                                    'value'         => 'Guardar',
                                    'content'       => 'Guardar',
                                    'type'          => 'Submit',
                                    'class'         => 'btn btn-outline btn-primary'
                                );
                    
                    $btn_atras = array (
                                    'name'          => 'Atras',
                                    'content'       => 'Atras',
                                    'class'         => 'btn btn-outline btn-default'
                                );
                    
                    ?>
                    
                   
                <div class="col-lg-12">        
                        <?php echo form_open(base_url().'index.php/boleta_controller/insert_boleta'); ?>      

                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td class="active">Rut</td>
                            <td colspan="7"><?php echo form_input($rut); ?></td>
                        </tr>
                        <tr>
                            <td class="active">Razón Social</td>
                            <td colspan="7"><div id="razon_social"><?php echo form_input($nombreEntidad); ?></div></td>
                        </tr>
                        <tr class="active">
                            <td>N° Boleta</td>
                            <td>Fecha Recepción</td>
                            <td>Fecha Emisión</td>
                            <td colspan="2">Fecha Vecimiento</td>
                            <td colspan="3">Tipo Boleta</td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo form_input($num_boleta); ?>
                            </td>
                            <td>
                                <div id="sandbox-container" style="width: 150px">
                                    <div class="input-group date">
                                                    <?php echo form_input($fecha_recepcion); ?><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div id="sandbox-container" style="width: 140px">
                                    <div class="input-group date">
                                        <?php echo form_input($fecha_emision); ?><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                                <div id="sandbox-container" style="width: 140px">
                                    <div class="input-group date">
                                        <?php echo form_input($fecha_vencimiento); ?><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
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
                            <td colspan="4"><?php echo form_input($denominacion); ?></td>
                            <td colspan="3">
                                <select name="id_banco" class="form-control">
                                    <?php foreach ($bancos as $banco) { ?>
                                        <option value="<?php echo $banco->idBanco ?>"><?php echo $banco->nombre_banco ?></option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="active"><b>Monto boleta</b></td>
                            <td><?php echo form_input($monto_boleta); ?></td>
                            <td colspan="3">
                                <select name="id_moneda" class="form-control">
                                    <?php foreach ($monedas as $moneda) { ?>
                                        <option value="<?php echo $moneda->idMoneda ?>"><?php echo $moneda->nombre_moneda ?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <td colspan="3">
                                <a href="<?php echo base_url();?>?sec=nueva_boleta"><?php echo form_button($btn_atras);?></a>
                                <?php echo form_button($btn_insertar);?>
                            </td>
                        <input type="hidden" name="idEntidad" id="idEntitad" value="<?php echo $idEntidad;?>" />
                        </tr>
                    </table>
        <?php echo form_close(); ?>
                
                </div>
<script>

$('#sandbox-container .input-group.date').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "dd-mm-yyyy"
});


</script>

