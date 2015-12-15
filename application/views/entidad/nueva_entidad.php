<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Entidades</h1>
    </div> 
     <div class="col-lg-8 col-lg-offset-2 text-center">
     <?php if($this->session->userdata('error')){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->userdata('error')?>

            </div>
                <?php $this->session->unset_userdata('error')?>    
        <?php } ?>

        <div class="panel panel-default">
        <div class="panel-heading">Nueva Entidad</div>
            <div class="panel-body">
                <form method="post" action="<?php echo base_url();?>index.php/entidad_controller/NuevaEntidad">
                    <div class="form-group">
                        <input class="form-control" required="true" type="text" name="rut_entidad" id="rut" placeholder="Rut Entidad">
                    </div>
                    <div class="form-group">
                        <input class="form-control" required="true" type="text" name="nombre_entidad" id="entidad" placeholder="Nombre Entidad">
                    </div>
                    <div class="form-group" style="text-align: right">
                        <a class="btn btn-default btn-outline" href="<?php echo base_url() ?>index.php/entidad_controller/entidades">Volver</a>
                        <button class="btn btn-primary btn-outline" type="submit" onclick="return confirmar()">Guardar</button>
                    </div>
                </form>
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
$('#rut').Rut({
    on_error: function(){ alert('Favor ingrese un rut válido');
        $('#rut').val(''); 
        document.getElementById('rut');
    }
});
    
function UnsetMensaje(){
    <?php $this->session->unset_userdata('error_entidad')?>
}
setTimeout("UnsetMensaje()",500);
</script>
    
    