<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <!--** MENSAJE **-->
        <?php 
        if($this->session->userdata('banco_ok') || $this->session->keep_flashdata('banco_error')){
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
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre Banco</th>
                    <th colspan="2" style="text-align: center;"><button type="button" class="btn btn-outline btn-primary btn-xs" name="nuevo_banco" id="nuevo_banco"  onclick="Accion('nuevo')">Nuevo Banco</button></th>
                </tr>
            </thead>
            <?php
                $cont = 0;
                foreach ($bancos as $banco){ ?>
            <tbody>
                <tr>
                    <td><?php echo ++$cont;?></td>
                    <td><?php echo $banco->nombre_banco?></td>
                    <td style="text-align: center;">
                        <button type="button" value="<?php echo $banco->idBanco ?>" name="editar_banco" id="editar_banco" class="btn btn-outline btn-primary btn-xs" onclick="Accion('editar',<?php echo $banco->idBanco ?>)">Editar</button>
                    </td>
                    <td style="text-align: center;">
                        <button type="button" value="<?php echo $banco->idBanco ?>" name="eliminar_banco" id="eliminar_banco" class="btn btn-outline btn-danger btn-xs" onclick="Accion('eliminar',<?php echo $banco->idBanco ?>)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
            <input type="hidden" id="crud" name="crud" value=""/>
            <input type="hidden" id="cual" name="cual" value=""/>
        </table>
        
        <?php echo form_close(); ?>
    </div>
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
    
    function UnsetMensaje(){
        <?php $this->session->unset_userdata('banco_ok','banco_error')?>
    }
    setTimeout("UnsetMensaje()",5000)
</script>