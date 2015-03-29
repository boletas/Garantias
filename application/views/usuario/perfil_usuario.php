<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Perfil Usuario</h1>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> Datos personales</div>
            <div class="panel-body">
                <?php
                    $nombre = array(
                                    'name'          => 'nombre',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Nombre',
                                    'value'         => $this->session->userdata('usuario')
                                  );
                    $apellido_paterno = array(
                                    'name'          => 'ap_paterno',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Apellido Paterno',
                                    'value'         => $this->session->userdata('ap_paterno')
                                  );
                    $apellido_materno = array(
                                    'name'          => 'ap_materno',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Apellido Materno',
                                    'value'         => $this->session->userdata('ap_materno')
                                  );

                    echo form_open();
                 ?>
                <div class="form-group">
                    <?php echo form_input($nombre); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($apellido_paterno); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($apellido_materno);?>
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
                                    'value'         => $this->session->userdata('nombre_usuario')
                                );
                    $tipo_usuario = array(
                                    'name'          => 'tipo_usuario',
                                    'class'         => 'form-control',
                                    'disabled'      => 'true',
                                    'value'         => $this->session->userdata('perfil')
                                  );
                    echo form_open();
                 ?>
                <div class="form-group">
                    <?php echo form_input($nombre_usuario); ?>
                </div>
                <div class="form-group">
                    <?php echo form_input($tipo_usuario); ?>
                </div>
                    <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
