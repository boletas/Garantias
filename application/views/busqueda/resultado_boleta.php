<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Busqueda Boleta</h1>
    </div>
    <div class="col-lg-12">
        <div class="dataTable_wrapper">
            <table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Numero Boleta</th>
                        <th>Monto Boleta</th>
                        <th>Fecha Recepción</th>
                        <th>Fecha Emisión</th>
                        <th>Fecha Vencimiento</th>
                        <th>Denominacion</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Numero Boleta</th>
                        <th>Monto Boleta</th>
                        <th>Fecha Recepción</th>
                        <th>Fecha Emisión</th>
                        <th>Fecha Vencimiento</th>
                        <th>Denominacion</th>
                    </tr>
                </tfoot>
                <?php echo $this->session->userdata('html');; ?>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" class="form-control" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
    
} );
</script>