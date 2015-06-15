<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
     <div class="col-lg-12">
        <!--** MENSAJE **-->
        <?php 
        if($this->session->userdata('banco_ok') || $this->session->userdata('banco_error')){
            if($this->session->userdata('banco_ok')){ 
                $clase = "alert alert-info alert-dismissable";
                $alerta = $this->session->userdata('banco_ok');
            }
            if($this->session->userdata('banco_error')){
                $clase = "alert alert-danger alert-dismissable";
                $alerta = $this->session->userdata('banco_error');
            }
        ?>
            <div class="<?php echo $clase; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $alerta; ?>
            </div>
        <?php } ?>
        <!--** FIN MENSAJES **-->
     </div>
<!--     <div class="col-lg-12" align="right">
        <button type="button" class="btn btn-outline btn-success btn-xs" align="right" name="nuevo_banco" id="nuevo_banco"  onclick="Accion('nuevo')">Nuevo Banco</button>
     </div>-->
     <div class="col-lg-12">  
        <?php 
            $form = array('name'    => 'form1');
            echo form_open(base_url()."index.php/banco_controller",$form); 
            
        ?>
        <table id="bancos" class="table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre Banco</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nombre Banco</th>
                    <th style="text-align: center;"></th>
                </tr>
            </tfoot>
            <?php echo $bancos;?>
            <input type="hidden" id="crud" name="crud" value=""/>
            <input type="hidden" id="cual" name="cual" value=""/>
        </table>
        <?php echo form_close(); ?>
     </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function() {
        $('#bancos tfoot th').each( function () {
            var title = $('#result_entidad thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" style="width: 150px;" class="form-control"/>' );
        } );
        var table = $('#bancos').DataTable();
        table.columns().every( function () {
            var that = this;

            $('input', this.footer() ).on('keyup change', function () {
                that
                    .search( this.value )
                    .draw();
            } );
        } );
    } );
    
    function Accion(que,idBanco){
        if(que == 'nuevo'){
            document.getElementById('crud').value = que;
        }
        if(que == 'editar'){
            document.getElementById('crud').value = que;
            document.getElementById('cual').value = idBanco;
        }
        if(que == 'eliminar'){
            if (confirm('¿Estas seguro eliminar este registro?')){ 
                document.getElementById('crud').value = que;
                document.getElementById('cual').value = idBanco;
            }else{
                return false;
            }
        }
        document.form1.submit();
    }
    
    function UnsetMensaje(){
        <?php $this->session->unset_userdata('banco_ok','banco_error')?>
    }
    setTimeout("UnsetMensaje()",5000)
</script>

