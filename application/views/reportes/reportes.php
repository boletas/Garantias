<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Reportes</h1>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"> Seleccione Tipo de Busqueda</div>
            <div class="panel-body">
                <?php
                $form = array('name'    => 'form1');
                echo form_open(base_url()."index.php/reportes_controller/GeneraReportes",$form);
                ?>
                    <div class="form-group" align="center">
                        <label class="radio-inline">
                            <input type="radio" name="vence" id="vence" value="vencidas" onchange="check(this.value)">Vencidas
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="vence" id="vence" value="por_vencer" onchange="check(this.value)">Por Vencer
                        </label>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="tipo_busqueda" id="tipo_busqueda" onchange="cambio()" style="display: none;">
                            <option>--- Seleccione ---</option>
                            <option value="1">Todas</option>
                            <option value="2">Rut</option>
                            <option value="3">Tipo Boleta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="rut" id="rut" placeholder="Ingrese rut entidad" style="display: none;"/>
                    </div>
                    <div class="form-group">
                        <?php echo $tipo_boleta; ?>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="periodo" id="periodo" onchange="cambio()" style="display: none">
                            <option>-- Seleccione --</option>
                            <option value="1">Todas</option>
                            <option value="10">10 Días</option>
                            <option value="20">20 Días</option>
                            <option value="30">30 Días</option>
                            <option value="60">60 Días</option>
                            <option value="90">90 Días</option>
                        </select>
                    </div>
                    <div class="form-group" style="text-align: right; display: none;" id="buscar">
                        <button name="Buscar" id="Buscar" class="btn btn-outline btn-primary" onclick="buscar()">Buscar</button>
                        <input type="hidden" id="que" name="que"/>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    function buscar(){
        var valor = document.getElementById('tipo_busqueda').value;
        document.getElementById('que').value = valor;
        document.form1.submit();
    }
    
    
    function check(check){
        if(check == "vencidas"){
            document.getElementById('tipo_busqueda').style.display = 'block';
        }else if(check == "por_vencer"){
            document.getElementById('tipo_busqueda').style.display = 'block';
        }else{
            document.getElementById('tipo_busqueda').style.display = 'none';
        }
    }
    
    
    function cambio(){
        var tipo = document.getElementById('tipo_busqueda').value;
        var periodo = document.getElementById('periodo').value;
        if(tipo > 0){
            document.getElementById('periodo').style.display = 'block';
            if(tipo == 2){
                document.getElementById('rut').style.display = 'block';
                document.getElementById('tipo').style.display = 'none';
            }else if(tipo == 3){
                document.getElementById('tipo').style.display = 'block';
                document.getElementById('rut').style.display = 'none';
            }else{
                document.getElementById('rut').style.display = 'none';
                document.getElementById('tipo').style.display = 'none';
            }
            if(periodo > 0){
                document.getElementById('buscar').style.display = 'block';
            }else{
                document.getElementById('buscar').style.display = 'none';
            }
        }else{
            document.getElementById('buscar').style.display = 'none';
            document.getElementById('periodo').style.display = 'none';
            document.getElementById('rut').style.display = 'none'; 
            document.getElementById('tipo').style.display = 'none'; 
        }
    }
    
$('#sandbox-container .input-group.date').datepicker({
    clearBtn: true,
    language: "es",
    orientation: "top left",
    todayBtn: "linked",
    format: "dd-mm-yyyy"
});
</script>