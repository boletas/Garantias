<div class="row">
    <br/><br/><br/>
    <div class="col-lg-10 col-lg-offset-1">
        <blockquote>
            <p class="lead text-uppercase text-primary"><img src="<?php echo base_url()?>assets/img/favicon.jpg"/>&nbsp;&nbsp;Sistema de Control de Boletas en Garantia</p>
        </blockquote>
    </div>
    <div class="col-lg-12"><br/><br/><br/><br/></div>
    <?php if($this->session->userdata('fin_mes') == 1 && $ingreso == 1){ ?>
        <div class="col-lg-10 col-lg-offset-1">
            <div class="alert alert-info" role="alert" align="center">
                El ingreso de los indicadores mensuales se encuentran disponible. <button type="button" onclick="Indicadores()" class="btn btn-outline btn-primary btn-sm">Aquí</button>
            </div>
        </div>
    <?php } ?>
</div>
<script>
    function Indicadores(){
        window.location.assign("<?php echo base_url();?>index.php/indicadores_controller/IngresoIndicadores");
    }
</script>