<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Entidades</h1>
    </div>
    <div class="col-lg-6">
        <?php 
            if($this->session->userdata('error')){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->userdata('error')?>
            </div>
                    
        <?php } $this->session->unset_userdata('error');   ?>
    </div>
    <div class="col-lg-12">
        <!--RESULTADO POR NUMERO DE RUT Y BOLETA-->
        <?php if(!empty($entidad)){ ?>
            <table id="result_entidad" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>Rut Entidad</th>
                        <th>Nombre entidad</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Rut Entidad</th>
                        <th>Nombre entidad</th>
                        <th>Modificar</th>
                    </tr>
                </tfoot>
                <?php echo $entidad;  ?>
            </table>
        <?php } ?>  
        </div>
<script>
$(document).ready(function() {
    $('#result_entidad tfoot th').each( function () {
        var title = $('#result_entidad thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" style="width: 250px;" class="form-control"/>' );
    } );
    var table = $('#result_entidad').DataTable();
    table.columns().every( function () {
        var that = this;
 
        $('input', this.footer() ).on('keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
} );
</script>