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
        <table id="tabla_retiro" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>N° Boleta</th>
                    <th>Rut</th>
                    <th>Emisión</th>
                    <th>Vencimiento</th>
                    <th>Tipo</th>
                    <th>Vence en</th>
                    <th>Monto</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Numero boleta</th>
                    <th>Rut</th>
                    <th>Emisión</th>
                    <th>Vencimiento</th>
                    <th>Tipo</th>
                    <th>Vence en</th>
                    <th>Monto</th>
                    <td></td>
                </tr>
            </tfoot>
            <?php echo $retiro;  ?>
        </table>
        <?php } ?>
        </div>
<script>
//$(document).ready(function() {
//    $('#example').DataTable();
//} );

$(document).ready(function() {
    $('#tabla_retiro tfoot th').each( function () {
        var title = $('#tabla_retiro thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" style="width: 120px;" class="form-control"/>' );
    } );
    var table = $('#tabla_retiro').DataTable();
    table.columns().every( function () {
        var that = this;
 
        $('input', this.footer() ).on('keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
} );

$('#rut').Rut({
    on_error: function(){ alert('Favor ingrese un rut válido'); 
        document.getElementById('rut');
    }
});
</script>
