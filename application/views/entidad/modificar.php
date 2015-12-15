<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Entidades</h1>
    </div> 
     <div class="col-lg-8 col-lg-offset-2 text-center">
     <?php if($this->session->userdata('error_entidad')){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->userdata('error_entidad')?>

            </div>
                <?php $this->session->unset_userdata('error_entidad')?>    
        <?php } ?>

        <div class="panel panel-default">
        <div class="panel-heading">Modificación Entidad</div>
            <div class="panel-body">
                <?php if(!empty($modificar)){ ?>
                    <form method="post" action="<?php echo base_url();?>index.php/entidad_controller/actualizar">
                        <?php echo $modificar;  ?>
                    </form>  
                <?php } ?>
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
    
    