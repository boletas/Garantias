<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Busqueda Boleta</h1>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
    <table id="result_boleta" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>N° Boleta</th>
                <th>Monto Boleta</th>
                <th>Fecha Recepción</th>
                <th>Fecha Emisión</th>
                <th>Fecha Vencimiento</th>
                <th>Denominación</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Numero Boleta</th>
                <th>Monto Boleta</th>
                <th>Fecha Recepción</th>
                <th>Fecha Emisión</th>
                <th>Fecha Vencimiento</th>
                <th>Denominación</th>
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
    $('#result_boleta tfoot th').each( function () {
        var title = $('#result_boleta thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" style="width: 150px;" class="form-control"/>' );
    } );
 
    // DataTable
    var table = $('#result_boleta').DataTable();
 
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