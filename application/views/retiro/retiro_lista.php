<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Retiro Boleta</h1>
    </div>
    <div class="col-lg-6">
        <?php 
            if($this->session->flashdata('error')){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error')?>
            </div>
                    
        <?php } ?>
        <?php 
        
        $rut_buscar = array(
                    'name'          => 'rut_buscar',
                    'class'         => 'form-control',
                    'placeholder'   => 'Rut de entidad',
                    'id'            => 'rut',
                    'type'          => 'text'
                  );
                    
        $numero_buscar = array(
                        'name'          => 'num_buscar',
                        'class'         => 'form-control',
                        'placeholder'   => 'Numero de boleta',
                        'type'          => 'text'
                      );
        
        $btn_buscar = array (
                    'name'          => 'Buscar',
                    'value'         => 'Buscar',
                    'type'          => 'Submit',
                    'class'         => 'btn btn-outline btn-primary'
                    );
        
        ?>    
        
        
         <?php 
                    $form = array('name'    => 'form1', 'class' => 'form-inline');
                    echo form_open(base_url().'index.php/retiro_controller/BuscarRetiro', $form);
         ?> 
            <div class="form-group">
                <?php echo form_input($rut_buscar); ?>
            </div>
            <div class="form-group">
                <?php echo form_input($numero_buscar); ?>
            </div>
            <div class="form-group">
                <?php echo form_input($btn_buscar); ?>
            </div>
        <?php echo form_close(); ?>
        
    </div>
    <div class="col-lg-12">&nbsp;</div>
    <div class="col-lg-12">
        
        <!--RESULTADO POR NUMERO DE RUT Y BOLETA-->
        
        <?php if(!empty($retiro)){ ?>
        <div class="dataTable_wrapper">
            <table id="example" class="table table-bordered table-responsive table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Numero boleta</th>
                        <th>Rut</th>
                        <th>Monto</th>
                        <th>Recepción</th>
                        <th>Vencimiento</th>
                        <th>Banco boleta</th>
                        <th>Descripcion</th>
                        <th>Ver detalle</th>
                    </tr>
                </thead>
                <?php echo $retiro;  ?>
            </table>
        <?php } ?>
        </div>   
        </div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

$('#rut').Rut({
    on_error: function(){ alert('Favor ingrese un rut valido'); 
        document.getElementById('rut');
    }
});
</script>
