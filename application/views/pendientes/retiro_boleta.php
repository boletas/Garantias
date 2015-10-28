<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Retiro Boleta</h1>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
        <?php 
            $form = array('name' => 'form1');
            echo form_open(base_url()."index.php/pendientes_controller/GuardarRetiro",$form);
        ?>
        <div class="panel panel-default">
            <div class="panel-heading"> Datos Retiro</div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="rut" name="rut" required value="" placeholder="Rut">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group date">
                        <input type="text" class="form-control" name="fecha_retiro" id="fecha_retiro" onfocus="this.blur();" placeholder="Fecha retiro" required/><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">                    
                        <input type="text" class="form-control" id="nombre" name="nombre" required value="" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="apellido" name="apellido" required value="" placeholder="Apellido">
                    </div>
                </div>
                <div class="col-lg-2 col-lg-offset-8" align="right">
                    <button name="volver" id="volver" class="btn btn-outline btn-default" onclick="Volver()">Volver</button>
                </div>
                <div class="col-lg-2" align="right">
                    <button name="guardar" id="guardar" class="btn btn-outline btn-primary" onclick="return Guardar()">Guardar</button>
                </div>
            </div>
            <input type="hidden" name="idBoleta" id="idBoleta" value="<?php echo $html; ?>"/>
            <input type="hidden" name="base" id="base" value="<?php echo base_url()?>"/>
        </div>
        <?php echo form_close(); ?>
    </div>
<script>
function Volver(){
    window.history.back();
    return false;
}

function Guardar(){
    if(confirm("Está seguro de guardar los cambios.? La boleta cambiará su estado a entregada")){
        return true;
    }else{
        return false;
    }
}

$('#rut').Rut({
    on_error: function(){ alert('Favor ingrese un rut válido');
        document.getElementById('rut').value = "";
        document.getElementById('rut').focus();
    },
    on_success: function(){
        document.getElementById('rut');
        ObtieneRetiro();
    }
});


$('#fecha_retiro').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "dd-mm-yyyy"
});
</script>