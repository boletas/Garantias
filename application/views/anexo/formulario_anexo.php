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
                <?php   echo form_open(base_url().'index.php/anexo_controller/InsertarAnexo');
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
    </div>
    <?php }?>
</div>
<script type="text/javascript">
    $('#sandbox-container .input-group.date').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "dd-mm-yyyy"
});

$(document).ready(function(){
    if ($("div#mensaje")) {
    setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
}});

$(document).ready(function(){
    $('#monto_boleta').numeric();
});

function confirmar(){
    if(confirm('¿Está seguro que desea ingresar este anexo?')){
        return true;
    }else{
        return false;
    }
}
</script>

