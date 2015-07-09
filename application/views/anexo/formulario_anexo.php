<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Formulario ingreso anexo</h1>
    </div>
        <?php 
            if($this->session->keep_flashdata('mensaje')){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->keep_flashdata('mensaje')?>
            </div>
                    
        <?php } ?>
    
    
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Ingrese anexo</div>
            <div class="panel-body">
                <?php echo form_open(base_url().'index.php/anexo_controller/InsertarAnexo'); ?>
                        <?php echo $boleta?>
                <?php echo form_close(); ?>
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
</script>

