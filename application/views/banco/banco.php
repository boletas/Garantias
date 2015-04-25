<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
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
        
        <?php 
            $form = array('name'    => 'form1');
            echo form_open(base_url()."index.php/banco_controller",$form); 
            
        ?>
        <button type="button" class="btn btn-outline btn-success btn-xs" name="nuevo_banco" id="nuevo_banco"  onclick="Accion('nuevo')">Nuevo Banco</button>
                    
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre Banco</th>
                    <th>accion</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nombre Banco</th>
                    <th colspan="2" style="text-align: center;">
                        &nbsp;
                    </th>
                </tr>
            </tfoot>
            <?php echo $bancos;?>
            <input type="hidden" id="crud" name="crud" value=""/>
            <input type="hidden" id="cual" name="cual" value=""/>
        </table>
        
        <?php echo form_close(); ?>
</div>
<script type="text/javascript">
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
    
    $(document).ready(function() {
    $('#example').DataTable();
} );
    
    function UnsetMensaje(){
        <?php $this->session->unset_userdata('banco_ok','banco_error')?>
    }
    setTimeout("UnsetMensaje()",5000)
</script>

