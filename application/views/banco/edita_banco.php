<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <!--** MENSAJE **-->
            <?php if($this->session->set_flashdata('banco_ok')){ ?>
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->set_flashdata('error'); ?>
                </div>
            <?php } ?>
            
            <!--** FIN MENSAJES **-->
            <div class="panel-heading">Modificación Banco</div>
            <div class="panel-body">
                <?php
                $idBanco = array(
                    'idBanco'       => $idBanco
                );
                
                $banco = array(
                    'name'          => 'nombre_banco',
                    'class'         => 'form-control',
                    'required'      => 'true',
                    'placeholder'   => 'Ingrese nombre banco',
                    'value'         => $banco
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
                    'class'         => 'btn btn-outline btn-primary',
                    'onClick'       => 'return confirmar()'
                );
                echo form_open(base_url()."index.php/banco_controller/ModificaBanco");?>
                <div class="form-group">
                    <?php echo form_hidden($idBanco);?>
                    <?php echo form_input($banco);?>
                </div>
                <div class="form-group" style="text-align: right">
                    <a href="<?php echo base_url();?>index.php/banco_controller"><?php echo form_button($atras); ?></a>
                    <?php echo form_button($aceptar);?>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
<script>
function confirmar(){
    if(confirm('¿Está seguro de guardar los cambios?')){
        return true;
    }else{
        return false;
    }
}
</script>