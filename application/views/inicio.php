<div class="row">
    <br/><br/><br/>
    <?php if($indicadores){ ?>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $indicadores->indicador->uf;?></div>
                        </div>
                    </div>
                </div>
                <a href="http://www.bcentral.cl/index.asp" target="_blank">
                    <div class="panel-footer">
                        <span class="pull-left">UF</span>
                        <span class="pull-right"><i class="fa  fa-info-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $indicadores->indicador->utm;?></div>
                        </div>
                    </div>
                </div>
                <a href="http://www.bcentral.cl/index.asp" target="_blank">
                    <div class="panel-footer">
                        <span class="pull-left">UTM</span>
                        <span class="pull-right"><i class="fa fa-info-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $indicadores->moneda->dolar;?></div>
                        </div>
                    </div>
                </div>
                <a href="http://www.bcentral.cl/index.asp" target="_blank">
                    <div class="panel-footer">
                        <span class="pull-left">Dólar Observado</span>
                        <span class="pull-right"><i class="fa fa-info-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $indicadores->moneda->euro;?></div>
                        </div>
                    </div>
                </div>
                <a href="http://www.bcentral.cl/index.asp" target="_blank">
                    <div class="panel-footer">
                        <span class="pull-left">Euro</span>
                        <span class="pull-right"><i class="fa  fa-info-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    <?php }else{ ?>
        <div class="col-lg-8 col-lg-offset-2">
            <div class="alert alert-warning" role="alert">
                No se lograron obtener los indicadores, al parecer existen problemas con su conexión a Internet.
            </div>
        </div>
    <?php } ?>
    <?php if($this->session->userdata('fin_mes') == 1){ ?>
        <div class="col-lg-6 col-lg-offset-3">
            <div class="alert alert-info" role="alert">
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