<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Busqueda Boleta</h1>
    </div>
    <div class="col-lg-12">
        <?php 
            $form = array('name'    => 'form1');
            echo form_open(base_url()."index.php/boleta_controller/ResultadoBoletas",$form);
        ?>
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
                <?php echo $html;?>
            </table>
        <input type="hidden" name="que" id="que" /> 
        <input type="hidden" name="id_boleta" id="id_boleta" /> 
        <?php echo form_close(); ?>
        <br/><br/><br/>
    </div>
</div>
<script>
function Accion(accion,id){
    document.getElementById('que').value = accion;
    document.getElementById('id_boleta').value = id;
    document.form1.submit();
}

$(document).ready(function() {
    $('#result_boleta tfoot th').each( function () {
        var title = $('#result_boleta thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" style="width: 120px;" class="form-control"/>' );
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