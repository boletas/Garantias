<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Nueva Boleta</h1>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"> Ingreso boleta en garantia</div>
            <div class="panel-body">
                <?php 
                    if($this->session->flashdata('insert')){?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('insert')?>
                    </div>
                <?php } ?>
                    <!--** FIN MENSAJES**-->
                
                <?php 
                    
                    
                    if($this->session->userdata('opcion') == 1){
                    $idEntidad;
                    $RutEntidad;
                    $nombre;
                    
                        foreach ($entidad as $value):
                            $idEntidad = $entidad->idEntidad;
                            $RutEntidad = $entidad->rut;
                            $nombre = $entidad->nombre;
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
                                    'content'       => 'Guardar',
                                    'type'          => 'Submit',
                                    'class'         => 'btn btn-outline btn-primary'
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
                
                <?php if($this->session->userdata('opcion') != 1){ ?>   
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
                    <div class="form-group">
                        <?php echo form_input($btn_buscar); ?>
                    </div>
                    <?php echo form_close(); ?>
                    
                    
                <?php }elseif($this->session->userdata('opcion') == 1){ ?>
                    
                    <!--Formulario en caso de que exista la entidad-->
                
                <div class="form-group">
                    <?php echo form_input($rut); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($nombre); ?>
                </div>    
                <div class="form-group">
                    <?php echo form_input($num_boleta); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($monto_boleta); ?>
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
                    <?php echo form_dropdown('bancos', $bancos); ?>
                </div>  
                <div class="form-group">
                    <?php echo form_dropdown('monedas', $monedas); ?>
                </div>      
                <div class="form-group">
                    <?php echo form_dropdown('garantias', $garantias); ?>
                </div>     
                <div class="form-group">
                    <?php echo form_dropdown('tipos', $tipos); ?>
                </div>      
                <div class="form-group" align="right">
                    <?php echo form_button($btn_insertar);?>
                </div>
                   
                <?php echo form_close(); ?>
                <?php } ?>
                <!--
                
                
                <?php form_open(base_url().'index.php/entidad_controller/insert_entidad'); ?> 
                    
                    <div class="form-group">
                        <?php echo form_input($rut_entidad); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input($nombre_entidad); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input($btn_insertar); ?>
                    </div>
                    
                    <?php echo form_close(); ?>
                
                -->    
                    
            </div>
        </div>
    </div>
</div>
