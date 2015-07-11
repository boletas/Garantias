<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Boletas Pendientes</h1>
    </div>
    <div class="col-lg-12">
        <!--** MENSAJE **-->
        <?php 
            $mensaje = "";
            if($this->session->userdata('ok')){ 
                $clase = "alert-info";
                $mensaje = $this->session->userdata('ok');
            }elseif($this->session->userdata('error')){ 
                $clase = "alert-danger";
                $mensaje = $this->session->userdata('error');
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
            <?php echo form_close(); ?>
    </div>
</div>
<script>
function Retiro(idBoleta){
    var base = "<?php echo base_url();?>";
    window.location.assign(base+"index.php/pendientes_controller/Retiro/"+idBoleta);
}

function PDF(idBoleta){
    var base = "<?php echo base_url();?>";
    window.open(base+"index.php/pdf_controller/BoletaPdf/"+idBoleta,'_blank');
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

function UnsetMensaje(){
    <?php $this->session->unset_userdata('ok','error')?>
}
setTimeout("UnsetMensaje()",500);

$(document).ready(function(){
    if ($("div#mensaje")) {
    setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
}});
</script>