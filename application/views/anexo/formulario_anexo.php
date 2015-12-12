<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Formulario ingreso anexo</h1>
    </div>
    <div class="col-lg-8 col-lg-offset-2 text-center">
        <?php if($this->session->userdata('mensaje_anexo')){?>
        <div class="alert alert-warning alert-dismissable" id="mensaje">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->userdata('mensaje_anexo')?>
        </div>
            <?php $this->session->unset_userdata('mensaje_anexo')?>    
        <?php } ?>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Ingrese anexo</div>
            <div class="panel-body">
                <?php   
                    echo form_open(base_url().'index.php/anexo_controller/InsertarAnexo');
                        echo $boleta;
                    echo form_close(); 
                ?>
            </div>
        </div>
    </div>
    <?php if(!empty($anexo)){ ?>
    <div class="col-lg-6">
        <div class="bs-example">
            <div class="panel-group" id="accordion">
                <?php echo $anexo;?>
            </div>
        </div>
        <input type="hidden" name="base" id="base" value="<?php echo (base_url())?>"
    </div>
    <?php }?>
    
    <!-- Bootstrap modal -->
    <div class="modal fade" id="EditarModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Editar Anexo</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="m_id_anexo" id="m_id_anexo"/>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Monto Anexo</label>
                                <div class="col-md-9">
                                    <input name="m_monto_anexo" onkeyup="format(this)" onchange="format(this)" id="m_monto_anexo" placeholder="Ingrese monto anexo" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Fecha Anexo</label>
                                <div class="col-md-9">
                                    <div class="input-group date">
                                        <input type="text" name="m_fecha_anexo" id="m_fecha_anexo" class="form-control" onfocus="this.blur();" required placeholder="Fecha vencimiento anexo"/><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnSave" onclick="confirmar_2()" class="btn btn-primary">Actualizar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->    
</div>
<script type="text/javascript">
    $('.input-group.date').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "dd-mm-yyyy"
});

$(document).ready(function(){
    if ($("div#mensaje")) {
        setTimeout(function(){ 
            $("div#mensaje").hide("slow");
        }, 5000);
    }
});


function confirmar_2(){
    if(confirm('¿Está seguro que desea ingresar este anexo?')){
        if($('#m_monto_anexo').val() != ""){
            ActualizaAnexo();
            return true;
        }else{
            alert('Monto de anexo incorrecto');
            return false;
        }
    }else{
        return false;
    }
}

function confirmar(){
    if(confirm('¿Está seguro que desea ingresar este anexo?')){
        return true;
    }else{
        return false;
    }
}

function confirmarEliminar(){
    if(confirm('¿Está seguro que desea eliminar este anexo?')){
        return true;
    }else{
        return false;
    }
}

</script>

