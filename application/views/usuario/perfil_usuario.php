<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Perfil Usuario</h1>
    </div>
    <div class="col-lg-8 col-lg-offset-2 text-center">
    <?php 
        if($this->session->flashdata('actualiza')){?>
        <div class="alert alert-info" id="mensaje">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('actualiza')?>
        </div>
    <?php } ?>
        <!--** FIN MENSAJES DE ERROR **-->
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> Datos personales</div>
            <div class="panel-body">
                <?php
                    $idUsuario = array(
                                    'name'          => 'idUsuario',
                                    'value'         => $this->session->userdata('idUsuario')
                                );
                    $nombre = array(
                                    'name'          => 'nombre',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Nombre',
                                    'value'         => $this->session->userdata('usuario'),
                                    'required'      => 'true'
                                  );
                    $apellido_paterno = array(
                                    'name'          => 'ap_paterno',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Apellido Paterno',
                                    'value'         => $this->session->userdata('ap_paterno'),
                                    'required'      => 'true'
                                  );
                    $apellido_materno = array(
                                    'name'          => 'ap_materno',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Apellido Materno',
                                    'value'         => $this->session->userdata('ap_materno'),
                                    'required'      => 'true'
                                  );
                    $btn_actualizar = array (
                                    'name'          => 'Actualizar',
                                    'content'       => 'Actualizar',
                                    'type'          => 'Submit',
                                    'class'         => 'btn btn-outline btn-primary'
                                );

                    echo form_open(base_url().'index.php/actualiza_perfil_controller/Actualiza_Usuario');
                 ?>
                <div class="form-group" hidden>
                    <?php echo form_input($idUsuario); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($nombre); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($apellido_paterno); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($apellido_materno);?>
                </div>
                <div class="form-group" align="right">
                    <?php echo form_button($btn_actualizar);?>
                </div>
                    <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> Datos de Sesión</div>
            <div class="panel-body">
                <?php
                    $nombre_usuario = array(
                                    'name'          => 'nombre_usuario',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Nombre Usuario',
                                    'disabled'      => 'true',
                                    'value'         => $this->session->userdata('nombre_usuario')
                                );
                    $tipo_usuario = array(
                                    'name'          => 'tipo_usuario',
                                    'class'         => 'form-control',
                                    'disabled'      => 'true',
                                    'value'         => $this->session->userdata('perfil')
                                  );
                 ?>
                <div class="form-group">
                    <?php echo form_input($nombre_usuario); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($tipo_usuario); ?>
                </div>
                <!--div align="right">
                    <a href=<?php echo base_url()?>index.php/plantilla_controller/?sec=configuracion_usuario>
                        <button type="button" class="btn btn-outline btn-default btn-xs">Modificar Datos de Sesión</button>
                    </a>
                </div-->
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        if ($("div#mensaje")) {
        setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
    }});
</script>