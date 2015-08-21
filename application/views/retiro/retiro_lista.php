<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Retiro Boleta</h1>
    </div>
    <div class="col-lg-12">
        <?php 
            if($this->session->flashdata('error')){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error')?>
            </div>
        <?php } ?>
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
                        <th>Banco</th>
                        <th>Descripción</th>
                        <th></th>
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
    on_error: function(){ alert('Favor ingrese un rut válido'); 
        document.getElementById('rut');
    }
});
</script>
