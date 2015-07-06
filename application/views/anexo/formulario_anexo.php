<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Formulario ingreso anexo</h1>
    </div>
    
    <?php
    
    $razon_social = array(
            
            'class'         => 'form-control',
            'type'          => 'text',
            'disabled'      => 'true',
            'value'         => $razon
          );
    $monto_boleta = array(
            'name'          => 'monto',
            'class'         => 'form-control',
            'type'          => 'text',
            'value'         => $monto
          );
    
    $fecha = array(
            'name'          => 'fecha',
            'class'         => 'form-control',
            'type'          => 'text',
            'value'         => $fecha_vencimiento
          );
    
    $idUsuario = array(
            'name'          => 'idBoleta',
            'value'         => $id
        );
    
    $btn_insertar = array (
        'name'          => 'Guardar',
        'value'         => 'Guardar',
        'content'       => 'Guardar',
        'type'          => 'Submit',
        'class'         => 'btn btn-outline btn-primary'
    );
    
    ?>
    
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Ingrese anexo</div>
            <div class="panel-body">
                <?php echo form_open(base_url().'index.php/anexo_controller/insertar_anexo'); ?>
                <label for="exampleInputEmail1">Razon social</label>
                <div class="form-group">
                    <?php echo form_input($razon_social);?>
                </div>
                <label for="exampleInputEmail1">Monto boleta</label>
                <div class="form-group">
                    <?php echo form_input($monto_boleta);?>
                </div>
                <label for="exampleInputEmail1">Fecha vencimiento</label>
                <div class="form-group">
                    <?php echo form_input($fecha);?>
                </div>
                <div class="form-group" hidden>
                    <?php echo form_input($idUsuario); ?>
                </div>
                <div class="form-group" style="text-align: right">
                        <?php echo form_input($btn_insertar); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>