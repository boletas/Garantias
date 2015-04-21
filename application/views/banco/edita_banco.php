<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <?php
            $idbanco = $this->session->userdata('idBanco');
            $nombre_banco = $this->session->userdata('banco');
            ?>
            <div class="panel-heading">Modificación Banco</div>
            <div class="panel-body">
                <?php
                $banco = array(
                    'name'          => 'nombre_banco',
                    'class'         => 'form-control',
                    'required'      => 'true',
                    'placeholder'   => 'Ingrese nombre banco',
                    'value'         => $nombre_banco
                );
                $atras = array(
                    'name'          => 'Atras',
                    'content'       => 'Atras',
                    'class'         => 'btn btn-outline btn-default'
                );
                $aceptar = array(
                    'name'          => 'Aceptar',
                    'content'       => 'Aceptar',
                    'type'          => 'Submit',
                    'class'         => 'btn btn-outline btn-primary'
                );
                echo form_open(base_url()."index.php/banco_controller/EditaBanco");?>
                <div class="form-group">
                    <?php echo form_input($banco);?>
                </div>
                <div class="form-group" style="text-align: right">
                    <a href="<?php echo base_url()?>?sec=banco"><?php echo form_button($atras); ?></a>
                    <?php echo form_button($aceptar);?>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>