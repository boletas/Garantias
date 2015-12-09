<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Búsqueda Documento</h1>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"> Seleccione Tipo de Búsqueda</div>
            <div class="panel-body">
                <?php
                $form = array('name'    => 'form1');
                echo form_open(base_url()."index.php/boleta_controller",$form);
                ?>
                    <div class="form-group">
                        <select class="form-control" id="tipo_busqueda" onchange="cambio()">
                            <option>--- Seleccione ---</option>
                            <option value="1">Todas</option>
                            <option value="2">N° Documento</option>
                            <option value="3">Fecha Recepción</option>
                            <option value="4">Fecha Emisión</option>
                            <option value="5">Fecha Vencimiento</option>
                            <option value="6">Entidad</option>
                        </select>
                    </div>
                    <div class="form-group" id="boleta" style="display: none">
                        <input class="form-control" placeholder="Ingrese N° Boleta" type="text" name="n_boleta" id="n_boleta"/>
                    </div>
                    <div class="form-group" id="recepcion" style="display: none">
                        <input class="form-control" placeholder="Ingrese Fecha Recepción" type="text" value="" name="fecha_re" id="fecha_re"/>
                    </div>
                    <div class="form-group" id="emision" style="display: none">
                        <input class="form-control" placeholder="Ingrese Fecha Emisión" type="text" value="" name="fecha_emi" id="fecha_emi"/>
                    </div>
                    <div class="form-group" id="vencimiento" style="display: none">
                        <input class="form-control" placeholder="Ingrese Fecha Vencimiento" type="text" value="" name="fecha_venci" id="fecha_venci"/>
                    </div>
                    <div class="form-group" id="enti" style="display: none">
                        <input class="form-control" placeholder="Ingrese Rut Entidad" type="text" value="" name="entidad" id="entidad"/>
                    </div>
                    <div class="form-group" style="text-align: right">
                        <button name="Buscar" id="Buscar" class="btn btn-outline btn-primary" onclick="buscar()">Buscar</button>
                        <input type="hidden" id="que" name="que"/>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<script>
    function buscar(){
        var valor = document.getElementById('tipo_busqueda').value;
        document.getElementById('que').value = valor;
        document.form1.submit();
    }
    
    function cambio(){
        var valor = document.getElementById('tipo_busqueda').value;
        if(valor == 1){
            document.getElementById('boleta').style.display = 'none';
            document.getElementById('recepcion').style.display = 'none';
            document.getElementById('emision').style.display = 'none';
            document.getElementById('vencimiento').style.display = 'none';
            document.getElementById('enti').style.display = 'none';
        }
        if(valor == 2){
            document.getElementById('boleta').style.display = 'block';
            document.getElementById('recepcion').style.display = 'none';
            document.getElementById('emision').style.display = 'none';
            document.getElementById('vencimiento').style.display = 'none';
            document.getElementById('enti').style.display = 'none';
        }
        if(valor == 3){
            document.getElementById('recepcion').style.display = 'block';
            document.getElementById('boleta').style.display = 'none';
            document.getElementById('emision').style.display = 'none';
            document.getElementById('vencimiento').style.display = 'none';
            document.getElementById('enti').style.display = 'none';
        }
        if(valor == 4){
            document.getElementById('emision').style.display = 'block';
            document.getElementById('recepcion').style.display = 'none';
            document.getElementById('boleta').style.display = 'none';
            document.getElementById('vencimiento').style.display = 'none';
            document.getElementById('enti').style.display = 'none';
        }
        if(valor == 5){
            document.getElementById('vencimiento').style.display = 'block';
            document.getElementById('emision').style.display = 'none';
            document.getElementById('recepcion').style.display = 'none';
            document.getElementById('boleta').style.display = 'none';
            document.getElementById('enti').style.display = 'none';
        }
        if(valor == 6){
            document.getElementById('enti').style.display = 'block';
            document.getElementById('vencimiento').style.display = 'none';
            document.getElementById('emision').style.display = 'none';
            document.getElementById('recepcion').style.display = 'none';
            document.getElementById('boleta').style.display = 'none';
        }
    }
</script>