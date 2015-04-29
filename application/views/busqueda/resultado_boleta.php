<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Busqueda Boleta</h1>
    </div>
    <div class="col-lg-12">
        <table id="result_boleta" class="table table-bordered table-hover" cellspacing="0">
            <thead>
                <tr>
                    <th>N° Boleta</th>
                    <th>Rut</th>
                    <!--<th>Nombre</th>-->
                    <th>Emisión</th>
                    <th>Monto</th>
                    <th>Vencimiento</th>
                    <th>Vence en</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>N° Boleta</th>
                    <th>Rut</th>
                    <!--<th>Nombre</th>-->
                    <th>Emisión</th>
                    <th>Monto</th>
                    <th>Vencimiento</th>
                    <th>Vence en</th>
                    <td></td>
                </tr>
            </tfoot>
            <?php echo $this->session->userdata('html'); ?>
        </table>
    </div>
</div>

<script>
$(function () { $("[data-toggle='tooltip']").tooltip(); });

$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#result_boleta tfoot th').each( function () {
        var title = $('#result_boleta thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" style="width: 130px;" class="form-control"/>' );
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