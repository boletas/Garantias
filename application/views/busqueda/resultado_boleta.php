<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Busqueda Boleta</h1>
    </div>
    <div class="col-lg-12">
        <!--** MENSAJE **-->
        <?php 
            $mensaje = "";
            if($this->session->userdata('boleta_ok')){ 
                $clase = "alert-info";
                $mensaje = $this->session->userdata('boleta_ok');
            }elseif($this->session->userdata('boleta_error')){ 
                $clase = "alert-danger";
                $mensaje = $this->session->userdata('boleta_error');
            }
            
            if($mensaje != ""){
        ?>
            <div id="mensaje" class="alert <?php echo $clase?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $mensaje ?>
            </div>
            <?php } ?>
        <!--** FIN MENSAJES **-->
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
                <?php echo $html; ?>
            </table>
            <input type="hidden" name="que" id="que" /> 
            <input type="hidden" name="id_boleta" id="id_boleta" /> 
            <?php echo form_close(); ?>
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

$(document).ready(function(){
    if ($("div#mensaje")) {
    setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
}});

function UnsetMensaje(){
    <?php $this->session->unset_userdata('boleta_ok','boleta_error')?>
}
setTimeout("UnsetMensaje()",500);
</script>