<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Configuración de Cuenta</h1>
    </div>
    <div class="col-lg-8 col-lg-offset-2 text-center">
    <?php 
        if($this->session->flashdata('actualiza')){?>
        <div class="alert alert-info" id="mensaje">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('actualiza')?>
        </div>
    <?php } ?>
        <!--** FIN MENSAJES**-->
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"> Datos de Sesión</div>
            <div class="panel-body">
                <?php 
                    $idUsuario = array(
                                    'name'          => 'idPerfil',
                                    'value'         => $this->session->userdata('idUsuario')
                                );
                    $nombre_usuario = array(
                                    'name'          => 'nombre_usuario',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Nombre Usuario',
                                    'value'         => $this->session->userdata('nombre_usuario'),
                                    'required'      => 'true'
                                  );
                    $pass_usuario_antigua = array(
                                    'name'          => 'pass_usuario_antigua',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Password Anterior',
                                    'type'          => 'password',
                                    'required'      => 'true'
                                  );
                    $pass_usuario_uno = array(
                                    'name'          => 'pass_usuario_uno',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Password Nueva',
                                    'type'          => 'password',
                                    'required'      => 'true'
                                  );
                    $pass_usuario_dos = array(
                                    'name'          => 'pass_usuario_dos',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Repita Password Nueva',
                                    'type'          => 'password',
                                    'required'      => 'true'
                                  );
                    $btn_actualizar = array (
                                    'name'          => 'Actualizar',
                                    'content'       => 'Actualizar',
                                    'type'          => 'Submit',
                                    'class'         => 'btn btn-outline btn-primary'
                                );
                    echo form_open(base_url().'index.php/actualiza_perfil_controller/Actualiza_Login');
                ?>
                <div class="form-group" hidden>
                    <?php echo form_input($idUsuario); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($nombre_usuario); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($pass_usuario_antigua); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($pass_usuario_uno); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($pass_usuario_dos); ?>
                </div>
                <div class="form-group" align="right">
                    <?php echo form_button($btn_actualizar);?>
                </div>
                    <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        if ($("div#mensaje")) {
        setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
    }});
</script>
