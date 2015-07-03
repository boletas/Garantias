<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Entidades</h1>
    </div> 
    <div class="col-lg-12">&nbsp;</div>
    <div class="col-lg-8">
        
        <!--RESULTADO POR NUMERO DE RUT Y BOLETA-->
        
        <?php if(!empty($modificar)){ ?>
        <form method="post" action="<?php echo base_url();?>index.php/entidad_controller/actualizar">
            <table class="table table-borderd">
                
                <?php echo $modificar;  ?>
                
            </table>
        <?php } ?>
        </form>   
    </div>
    
    <script>
    $('#rut').Rut({
    on_error: function(){ alert('Favor ingrese un rut valido'); 
    document.getElementById('rut');
    }
    });
</script>
    
    