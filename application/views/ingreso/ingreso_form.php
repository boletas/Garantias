<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Nueva Boleta</h1>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> Ingreso boleta en garantia</div>
            <div class="panel-body">
                <?php 
                $idEntidad;
                    $RutEntidad;
                    $nombre;
                    
                        foreach ($entidad as $value):
                            $idEntidad = $value->idEntidad;
                            $RutEntidad = $value->rut;
                            $nombre = $value->nombre;
                        endforeach;
                    
                
                    $rut = array(
                                    'class'         => 'form-control',
                                    'type'          => 'text',
                                    'value'         => $RutEntidad
                                    
                                  );
                    $nombreEntidad = array(
                                    'class'         => 'form-control',
                                    'type'          => 'text',
                                    'value'         => $nombre
                                    
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
                                    'required'      => 'true'
                                  );
                    $fecha_recepcion = array(
                                    'name'          => 'fecha_recepcion',
                                    'class'         => 'form-control',
                                    'style'         => 'width: 100px',
                                    'onfocus'       => 'this.blur();',
                                    'type'          => 'text',
                                    'required'      => 'true'
                                  );
                    $fecha_emision = array(
                                    'name'          => 'fecha_emision',
                                    'class'         => 'form-control',
                                    'style'         => 'width: 100px',
                                    'onfocus'       => 'this.blur();',
                                    'type'          => 'text',
                                    'required'      => 'true'
                                  );
                    $fecha_vencimiento = array(
                                    'name'          => 'fecha_vencimiento',
                                    'class'         => 'form-control',
                                    'style'         => 'width: 100px',
                                    'onfocus'       => 'this.blur();',
                                    'type'          => 'text',
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

                            <table class="table table-bordered">
                        <tr>
                            <td class="active">Rut</td>
                            <td colspan="5"><?php echo form_input($rut); ?></td>
                        </tr>
                        <tr>
                            <td class="active">Razón Social</td>
                            <td colspan="5"><?php echo form_input($nombreEntidad); ?></td>
                        </tr>
                        <tr class="active">
                            <td>N° Boleta</td>
                            <td>Fecha Recepción</td>
                            <td>Fecha Emisión</td>
                            <td>Fecha Vecimiento</td>
                            <td>Tipo Moneda</td>
                            <td>Tipo Garantía</td>
                        </tr>
                        <tr>
                            <td><?php echo form_input($num_boleta); ?></td>
                            <td>
                                <div id="sandbox-container" style="width: 135px">
                                    <div class="input-group date">
                                        <?php echo form_input($fecha_recepcion); ?><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                                
                            </td>
                            <td>
                                <div id="sandbox-container" style="width: 135px">
                                    <div class="input-group date">
                                         <?php echo form_input($fecha_emision); ?><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div id="sandbox-container" style="width: 135px">
                                    <div class="input-group date">
                                         <?php echo form_input($fecha_vencimiento); ?><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td><select name="id_moneda" class="form-control">
                                <?php foreach ($monedas as $moneda) { ?>
                                    <option value="<?php echo $moneda->idMoneda ?>"><?php echo $moneda->nombre_moneda ?></option>
                                <?php }?>
                                </select>
                            </td>
                            <td><select name="id_garantia" class="form-control">
                                <?php foreach ($garantias as $garantia) { ?>
                                    <option value="<?php echo $garantia->idTipoGarantia ?>"><?php echo $garantia->descripcion ?></option>
                                <?php }?>
                                </select>
                            </td>
                        </tr>
                        <tr class="active">
                            
                            <td colspan="4">Denominación de Estudio</td>
                            <td colspan="2">Banco</td>
                        </tr>
                        <tr>
                            
                            <td colspan="4"><?php echo form_input($denominacion); ?></td>
                            <td colspan="2"><select name="id_banco" class="form-control">
                                <?php foreach ($bancos as $banco) { ?>
                                    <option value="<?php echo $banco->idBanco ?>"><?php echo $banco->nombre_banco ?></option>
                                <?php }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6"><a href="<?php echo base_url();?>?sec=nueva_boleta"><?php echo form_button($btn_atras);?></a>
                                <?php echo form_button($btn_insertar);?>
                            </td>
                        </tr>
                    </table>    
                                <?php echo form_close(); ?>
                        
                        </div>
            </div>
            
            
<script>

$('#sandbox-container .input-group.date').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "mm-dd-yyyy"
});


</script>

