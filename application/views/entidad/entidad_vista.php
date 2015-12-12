<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Entidades</h1>
    </div>
        <!--** MENSAJE **-->
        <?php 
        if($this->session->userdata('ok') || $this->session->userdata('error')){
            if($this->session->userdata('ok')){ 
                $clase = "alert alert-info alert-dismissable";
                $alerta = $this->session->userdata('ok');
            }
            if($this->session->userdata('error')){
                $clase = "alert alert-danger alert-dismissable";
                $alerta = $this->session->userdata('error_entidad');
            }
        ?>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <div id="mensaje" class="<?php echo $clase; ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $alerta; ?>
                </div>
            </div>
        <?php } ?>
        <!--** FIN MENSAJES **-->
    <?php if(isset($mensaje)){ ?>
        <div class="col-lg-8 col-lg-offset-2">
            <div class="alert alert-info">
                <?php echo $mensaje ; ?>
            </div>
        </div>
        <?php }else{?>
        <div class="col-lg-12">
            <!--RESULTADO POR NUMERO DE RUT Y BOLETA-->
            <?php if(!empty($entidad)){ ?>
                <table id="result_entidad" class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Rut Entidad</th>
                            <th>Nombre entidad</th>
                            <td></td>
                        </tr>
                    </tfoot>
                    <?php echo $entidad;  ?>
                </table>
            <?php } ?>  
        </div>
    <?php } ?>
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

$(document).ready(function(){
    if ($("div#mensaje")) {
    setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
}});

function UnsetMensaje(){
    <?php $this->session->unset_userdata('ok');?>
    <?php $this->session->unset_userdata('error');?>
}
setTimeout("UnsetMensaje()",100);
</script>