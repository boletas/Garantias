<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Nueva Boleta</h1>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"> Ingreso boleta en garantia</div>
            <div class="panel-body">
                <?php 
                    if($this->session->flashdata('insert')){?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('insert')?> <?php if($this->session->flashdata('op')){?>¿Desea crear esta entidad?  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar</button><?php }?>
                    </div>
                    
                <?php } ?>
                    <!--** FIN MENSAJES**-->
                
                <?php 
                    
                    
                    if($this->session->userdata('opcion') == 'form1'){
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
                    }
                
                    $num_boleta = array(
                                    'name'          => 'num_boleta',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese numero de boleta',
                                    'type'          => 'text',
                                    'value'         => set_value('num_boleta'),
                                    'required'      => ''
                                  );
                    $monto_boleta = array(
                                    'name'          => 'monto_boleta',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese monto boleta',
                                    'type'          => 'text',
                                    'required'      => 'true'
                                  );
                    $fecha_recepcion = array(
                                    'name'          => 'fecha_recepcion',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese fecha recepcion. Ej: AÑO-MES-DIA',
                                    'type'          => 'text',
                                    'required'      => 'true'
                                  );
                    $fecha_emision = array(
                                    'name'          => 'fecha_emision',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese fecha emision. Ej: AÑO-MES-DIA',
                                    'type'          => 'text',
                                    'required'      => 'true'
                                  );
                    $fecha_vencimiento = array(
                                    'name'          => 'fecha_vencimiento',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese fecha vencimiento. Ej: AÑO-MES-DIA',
                                    'type'          => 'text',
                                    'required'      => 'true'
                                  );
                    $denominacion = array(
                                    'name'          => 'denominacion',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese denominacion de estudio',
                                    'type'          => 'text',
                                    'required'      => ''
                                  );
                    
                    $btn_insertar = array (
                                    'name'          => 'Guardar',
                                    'value'       => 'Guardar',
                                    'type'          => 'Submit',
                                    'class'         => 'btn btn-outline btn-primary'
                                );
                    
                    $btn_atras = array (
                                    'name'          => 'Atras',
                                    'content'       => 'Atras',
                                    'class'         => 'btn btn-outline btn-default'
                                );
                    
                    //FORMULARIO INGRESAR ENTIDAD
                    
                    $rut_entidad = array(
                                    'name'          => 'rut_entidad',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese rut de entidad',
                                    'type'          => 'text',
                                    'required'      => 'required'
                                  );
                    
                    $nombre_entidad = array(
                                    'name'          => 'nombre_entidad',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese nombre de entidad',
                                    'type'          => 'text',
                                    'required'      => 'required'
                                  );
                    
                    
                    //FIN FORM ENTIDAD
                    
                    
                ?>
                
                <?php if($this->session->userdata('opcion') != 'form1'){ ?>   
                    <!--Primer formulario que aparece -->
                    
                    <?php 
                    
                    $RutBuscar = array(
                                    'name'          => 'rut_buscar',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese rut de entidad a buscar',
                                    'type'          => 'text',
                                    'required'      => 'required'
                                  );
                    
                    $btn_buscar = array (
                                    'name'          => 'Buscar',
                                    'value'         => 'Buscar',
                                    'type'          => 'Submit',
                                    'class'         => 'btn btn-outline btn-primary'
                                );
                    ?>
                    
                    
                    
                    <?php echo form_open(base_url().'index.php/entidad_controller/buscar_entidad'); ?> 
                    <div class="form-group">
                        <?php echo form_input($RutBuscar); ?>
                    </div>
                    <div class="form-group" style="text-align: right">
                        <?php echo form_input($btn_buscar); ?>
                    </div>
                    <?php echo form_close(); ?>
                    
                    
                <?php }elseif($this->session->userdata('opcion') == 'form1'){ ?>
                    
                    <!--Formulario en caso de que exista la entidad-->
                <?php echo form_open(base_url().'index.php/boleta_controller/insert_boleta'); ?>
                    <input type="hidden" name="idEntidad" value="<?php echo $idEntidad?>"/>    
                <div class="form-group">
                    <?php echo form_input($rut); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($nombreEntidad); ?>
                </div>    
                <div class="form-group">
                    <?php echo form_input($num_boleta); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($monto_boleta); ?>
                </div>
                <div class="form-group">
                    <select name="id_moneda" class="form-control">
                    <?php foreach ($monedas as $moneda) { ?>
                        <option value="<?php echo $moneda->idMoneda ?>"><?php echo $moneda->nombre_moneda ?></option>
                    <?php }?>
                    </select>
                </div>     
                <div class="form-group">
                    <?php echo form_input($fecha_recepcion); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($fecha_emision); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($fecha_vencimiento); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($denominacion); ?>
                </div>
                <div class="form-group">
                    <select name="id_banco" class="form-control">
                    <?php foreach ($bancos as $banco) { ?>
                        <option value="<?php echo $banco->idBanco ?>"><?php echo $banco->nombre_banco ?></option>
                    <?php }?>
                    </select>
                </div>       
                <div class="form-group">
                    <select name="id_garantia" class="form-control">
                    <?php foreach ($garantias as $garantia) { ?>
                        <option value="<?php echo $garantia->idTipoGarantia ?>"><?php echo $garantia->descripcion ?></option>
                    <?php }?>
                    </select>
                </div>     
                <div class="form-group">
                    <select name="id_tipo" class="form-control">
                    <?php foreach ($tipos as $tipo) { ?>
                        <option value="<?php echo $tipo->idTipoBoleta ?>"><?php echo $tipo->descripcion_tipo_boleta ?></option>
                    <?php }?>
                    </select>
                </div>      
                <div class="form-group" align="right">
                    <a href="<?php echo base_url();?>?sec=nueva_boleta"><?php echo form_button($btn_atras);?></a>
                    <?php echo form_button($btn_insertar);?>
                </div>
                    
                   
                <?php echo form_close(); ?>
                   <?php  $this->session->unset_userdata('opcion');?>
                
                
                
                <?php } ?>
                    

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Ingreso de nueva entidad</h4>
                          </div>
                          <div class="modal-body">
                              <?php echo form_open(base_url().'index.php/entidad_controller/insert_entidad'); ?> 
                    
                                    <div class="form-group">
                                        <?php echo form_input($rut_entidad); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_input($nombre_entidad); ?>
                                    </div>
                          </div>
                          <div class="modal-footer">
                           <div class="form-group">
                               <?php echo form_input($btn_insertar); ?>
                               <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                               <?php echo form_close(); ?>
                               
                           </div>
                             
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    
                    
                    
                    
                    
                
                
               
                    
            </div>
        </div>
    </div>
</div>

<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    })
</script>