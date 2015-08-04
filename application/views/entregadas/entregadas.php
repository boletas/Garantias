<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Boletas Entregadas</h1>
    </div>
        <?php if(isset($html["mensaje"])){ ?>
        <div class="col-lg-8 col-lg-offset-2">
            <div class="alert alert-info">
                <?php echo $html["mensaje"]; ?>
            </div>
        </div>
        <?php }else{?>
        <div class="col-lg-12">
            <table id="result_boleta" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>N° Boleta</th>
                        <th>Rut</th>
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
                        <th>Emisión</th>
                        <th>Monto</th>
                        <th>Vencimiento</th>
                        <th>Vence en</th>
                        <td></td>
                    </tr>
                </tfoot>
                <?php echo $html; ?>
            </table>
        </div>
        <?php } ?>
<script>
function Entregada(idBoleta){
    window.location.assign("<?php echo base_url();?>index.php/entregadas_controller/DetalleEntregada/"+idBoleta);
}

$(document).ready(function() {
    $('#result_boleta tfoot th').each( function () {
        var title = $('#result_boleta thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" style="width: 120px;" class="form-control"/>');
    } );
    var table = $('#result_boleta').DataTable();
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