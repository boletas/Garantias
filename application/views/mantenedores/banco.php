<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"> Opción Banco</div>
            <div class="panel-body">
                <?php 
                    $form = array('name'    => 'form1');
                    
                    echo form_open(base_url()."index.php/banco_controller",$form) ?>
                    <div class="form-group">
                        <select class="form-control" id="select_id" onchange="MuestraSelect(this.value)">
                            <option value="0"> -- Seleccione -- </option>
                            <option value="1" <?php echo($this->session->userdata("select") == 1 ? "selected" : "")?>>Listar Bancos</option>
                            <option value="2" <?php echo($this->session->userdata("select") == 2 ? "selected" : "")?>>Agregar Banco</option>
                            <option value="3" <?php echo($this->session->userdata("select") == 3 ? "selected" : "")?>>Modificar Banco</option>
                            <option value="4" <?php echo($this->session->userdata("select") == 4 ? "selected" : "")?>>Eliminar Banco</option>
                        </select>
                    </div>
                    <div id="lista_banco" style="display:<?php echo($this->session->userdata("select") == 1 ? "block" : "none") ?>">
                        <div class="form-group">
                            <select class="form-control"> 
                            <?php foreach ($bancos as $banco){ ?>
                                <option value="<?php echo $banco->idBanco?>"><?php echo $banco->nombre_banco?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                    <div id="agrega_banco" style="display:<?php echo($this->session->userdata("select") == 2 ? "block" : "none") ?>">
                        <div class="form-group">
                            <input class="form-control" type="text" value="<?php echo $this->session->userdata("nombre_banco")?>" name="nombre_banco"/>
                        </div>
                        <input type="hidden" name="enviar" value="nuevo_banco"/>
                            <?php 
                            if($this->session->userdata("encontrado") == "si") {?>
                                <div class="form-group">
                                    <div class="alert alert-warning">
                                        Se encontraron registros similares... Esta seguro de seguir de todas formas..?
                                    </div>
                                    <input type="hidden" id="confirmado" name="confirmado" value="si"/>
                                </div>
                                <div class="form-group" align="right">
                                    <button class="btn btn-outline btn-danger" onclick="Cancela('cancelo');">Cancelar</button>
                                    <button class="btn btn-outline btn-primary" onclick="Cancela('acepto');">Aceptar</button> 
                                </div>
                            <?php
                            }elseif($this->session->userdata("insertado")== "si"){ ?>
                                <div class="form-group">
                                    <div class="alert alert-warning">
                                        Los datos Fueron Ingresados Correctamente
                                    </div>
                                </div>
                                <div class="form-group" align="right">
                                    <button class="btn btn-outline btn-danger" id="cancela" onclick="Aceptar(this.value);">Aceptar</button>
                                </div>
                            <?php 
                            $estado = array(
                                'select'        => '',
                                'encontrado'    => '',
                                'nombre_banco'  => '',
                                'insertado'     => ''
                            );
                            $this->session->unset_userdata($estado);
                            }else{ ?>
                                <div class="form-group" align="right">
                                    <input type="Submit" value="Guardar Banco" class="btn btn-outline btn-primary">
                                </div>
                            <?php } ?>
                    </div>
                    <div id="modifica_banco" style="display: none">
                        <div class="form-group">
                            modifica
                        </div>
                    </div>
                    <div id="elimina_banco" style="display: none">
                        <div class="form-group">
                            elimina
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    </div>
</div>
<script>
    function Cancela(accion){
        if(accion == 'cancelo'){
            document.getElementById('confirmado').value = "no";
            document.form1.submit();
        }
        if(accion == 'acepto'){
            document.getElementById('confirmado').value = "si";
            document.form1.submit();
        }
    }
    function Aceptar(){
        if(document.getElementById('aceptar')){
            window.location.reload();
        }
    }
    function MuestraSelect() { 
        seleccion = document.getElementById("select_id").value;
        if(seleccion == 1){
            document.getElementById('lista_banco').style.display = 'block';
            document.getElementById('agrega_banco').style.display = 'none';
            document.getElementById('modifica_banco').style.display = 'none';
            document.getElementById('elimina_banco').style.display = 'none';
        }
        if(seleccion == 2){
            document.getElementById('lista_banco').style.display = 'none';
            document.getElementById('agrega_banco').style.display = 'block';
            document.getElementById('modifica_banco').style.display = 'none';
            document.getElementById('elimina_banco').style.display = 'none';
        }
        if(seleccion == 3){
            document.getElementById('lista_banco').style.display = 'none';
            document.getElementById('agrega_banco').style.display = 'none';
            document.getElementById('modifica_banco').style.display = 'block';
            document.getElementById('elimina_banco').style.display = 'none';
        }
        if(seleccion == 4){
            document.getElementById('lista_banco').style.display = 'none';
            document.getElementById('agrega_banco').style.display = 'none';
            document.getElementById('modifica_banco').style.display = 'none';
            document.getElementById('elimina_banco').style.display = 'block';
        }
    }
</script>

        
