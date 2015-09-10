<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ingreso Indicadores Mensuales</h1>
    </div>
    <div class="col-lg-8 col-lg-offset-2 text-center">
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
    <?php
    if($ingreso == 0){
        $euro = $valores['e_euro'];
        $dolar = $valores['e_dolar'];
        $uf = $valores['e_uf'];
        $estado = " disabled ";
    }else{
        $estado = "";
        $euro = "";
        $dolar = "";
        $uf = "";
    }
    ?>
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"> Ingreso Indicadores</div>
            <div class="panel-body">
                <?php
                $form = array('name'    => 'form1');
                echo form_open(base_url()."index.php/indicadores_controller/GuardarIndicadores",$form);
                ?>
                <div class="form-group">
                    <input type="text" <?php echo $estado; ?> class="form-control" id="uf" name="uf" required onkeypress="ValidNum2(this)" value="<?php echo $uf; ?>" placeholder="Valor U.F. ej: 123.123,09">
                </div>
                <div class="form-group">
                    <input type="text" <?php echo $estado; ?> class="form-control" id="dolar" name="dolar" onkeypress="ValidNum2(this)" value="<?php echo $dolar; ?>" required placeholder="Valor Dolar ej: 123.123,09">
                </div>
                <div class="form-group"> 
                    <input type="text" <?php echo $estado; ?> class="form-control" id="euro" name="euro" onkeypress="ValidNum2(this)"  value="<?php echo $euro; ?>" required placeholder="Valor Euro ej: 123.123,09">
                </div>
                <?php if($ingreso != 0){ ?>
                <div class="form-group" align="right">
                    <input type="submit"  onclick="return pregunta()" class="btn btn-outline btn-primary" name="enviar" id="enviar" value="Guardar"/>
                </div>
                <?php
                }else{ ?>
                <div class="alert alert-info alert-dismissable" role="alert">
                    Los indicadores correspondientes al mes N° <?php echo date('m'); ?>, ya fueron ingresados.
                </div>
                <?php 
                }
                echo form_close(); 
                ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            El ingreso de los indicadores solo estará disponible en los dias finales de cada mes.
        </div>
    </div>
<script>
    
function pregunta(){
    if(confirm("Está seguro de guardar estos indicadores.?")){
        return true;
    }else{
        return false;
    }
}

$(document).ready(function(){
    if ($("div#mensaje")) {
    setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
}});

function UnsetMensaje(){
<?php $this->session->unset_userdata('ok')?>
<?php $this->session->unset_userdata('error')?>
}
setTimeout("UnsetMensaje()",500);

</script>