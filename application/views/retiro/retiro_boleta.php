<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Retiro Boleta</h1>
    </div>
    <div class="col-lg-10">
        <?php 
                    if($this->session->flashdata('error')){?>
        <div id="mensaje" class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error')?>
                    </div>

        <?php } ?>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"> Tipo de Busqueda</div>
            <div class="panel-body" align="center">
                <?php 

                $rut_buscar = array(
                            'name'          => 'rut_buscar',
                            'class'         => 'form-control',
                            'placeholder'   => 'Rut de entidad',
                            'id'            => 'rut',
                            'type'          => 'text'
                          );

                $numero_buscar = array(
                                'name'          => 'num_buscar',
                                'class'         => 'form-control',
                                'placeholder'   => 'Numero de boleta',
                                'type'          => 'text'
                              );

                $btn_buscar = array (
                            'name'          => 'Buscar',
                            'value'         => 'Buscar',
                            'type'          => 'Submit',
                            'class'         => 'btn btn-outline btn-primary'
                            );

                ?>    


                 <?php 
                    $form = array('name'    => 'form1', 'class' => 'form-inline');
                    echo form_open(base_url().'index.php/retiro_controller/BuscarRetiro', $form);
                 ?> 
                    <div class="form-group">
                        <?php echo form_input($rut_buscar); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input($numero_buscar); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input($btn_buscar); ?>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    $('#rut').Rut({
        on_error: function(){ alert('Favor ingrese un rut válido'); 
            document.getElementById('rut');
        }
    });
    
    $(document).ready(function(){
    if ($("div#mensaje")) {
    setTimeout(function(){ $("div#mensaje").hide("slow"); }, 4000);
}});
</script>