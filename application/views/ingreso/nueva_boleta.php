<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Nueva Boleta</h1>
    </div>
    <div class="col-lg-10">
        <?php 
            if($this->session->flashdata('insert')){?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('insert')?> <?php if($this->session->flashdata('op')){?>¿Desea crear esta entidad?  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar</button><?php }?>
                </div>
        <?php } ?>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"> Ingreso rut de entidad</div>
            <div class="panel-body">
                
                    <!--** FIN MENSAJES**-->
               
                    <!--Primer formulario que aparece -->
                    
                    <?php 
                    
                    $RutBuscar = array(
                                    'name'          => 'rut_buscar',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese rut de entidad a buscar',
                                    'type'          => 'text',
                                    'id'            => 'rut',
                                    'required'      => 'required'
                                  );
                    
                    $btn_buscar = array (
                                    'name'          => 'Buscar',
                                    'value'         => 'Buscar',
                                    'type'          => 'Submit',
                                    'class'         => 'btn btn-outline btn-primary'
                                );
                    $btn_insertar = array (
                                    'name'          => 'Guardar',
                                    'value'         => 'Guardar',
                                    'content'       => 'Guardar',
                                    'type'          => 'Submit',
                                    'class'         => 'btn btn-outline btn-primary'
                                );
                    ?>
                    
                    <div class="col-lg-12">
                    <?php echo form_open(base_url().'index.php/entidad_controller/buscar_entidad'); ?> 
                    <div class="form-group">
                        <?php echo form_input($RutBuscar); ?>
                    </div>
                    <div class="form-group" style="text-align: right">
                        <?php echo form_input($btn_buscar); ?>
                    </div>
                    <?php echo form_close(); ?>
                    </div>
                    
                    
                     <?php
                     
                     //Datos ventana modal
                    
                    $rut_entidad = array(
                                    'name'          => 'rut_entidad',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Ingrese rut de entidad',
                                    'type'          => 'text',
                                    'id'            => 'rut_entidad',
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
                <!--Ventana modal-->
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
        $('#myInput').focus();
    });
    
    $('#rut').Rut({
        on_error: function(){ alert('Favor ingrese un rut válido');
            $('#rut').val(''); 
            document.getElementById('rut');
        }
    });
    
    $('#rut_entidad').Rut({
        on_error: function(){ alert('Favor ingrese un rut válido');
            $('#rut_entidad').val(''); 
            document.getElementById('rut_entidad');
        }
    });
</script>