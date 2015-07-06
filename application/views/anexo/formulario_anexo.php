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
    
    <div class="col-lg-6">
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
    <div class="col-lg-6">
    <div class="bs-example">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Anexo 1</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>HTML stands for HyperText Markup Language. HTML is the main markup language for describing the structure of Web pages. <a href="http://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Anexo 2</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Bootstrap is a powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">anexo 3</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="http://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>
    </div>
    </div>

        
    </div>
</div>


