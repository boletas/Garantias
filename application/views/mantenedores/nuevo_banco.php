<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
    <div class="col-lg-6 col-lg-offset-3">
        <!--** MENSAJE **-->
        <?php 
        if($this->session->flashdata('guardado') || $this->session->flashdata('error')){
            if($this->session->flashdata('guardado')){ 
                $clase = "alert alert-info alert-dismissable";
                $alerta = $this->session->flashdata('guardado');
            }
            if($this->session->flashdata('error')){
                $clase = "alert alert-danger alert-dismissable";
                $alerta = $this->session->flashdata('error');
            }
        ?>
            <div class="<?php echo $clase; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $alerta; ?>
            </div>
        <?php } ?>
        <!--** FIN MENSAJES **-->
        <div class="panel panel-default">
            <div class="panel-heading">Nuevo Banco</div>
            <div class="panel-body">
                <?php
                $banco = array(
                    'name'          => 'nombre_banco',
                    'class'         => 'form-control',
                    'required'      => 'true',
                    'placeholder'   => 'Ingrese nombre banco'
                );
                
                $boton = array(
                    'name'          => 'Aceptar',
                    'content'       => 'Aceptar',
                    'type'          => 'Submit',
                    'class'         => 'btn btn-outline btn-primary'
                );
                echo form_open(base_url()."index.php/banco_controller/NuevoBanco"); ?>
                <div class="form-group">
                    <?php echo form_input($banco); ?>
                </div>
                <div class="form-group" style="text-align: right">
                    <?php echo form_button($boton); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
