<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Retiro Boleta</h1>
    </div>
    <div class="col-lg-6">
        <?php 
            if($this->session->flashdata('error')){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error')?>
            </div>
                    
        <?php } ?>
        <?php 
        
        $rut_buscar = array(
                    'name'          => 'rut_buscar',
                    'class'         => 'form-control',
                    'placeholder'   => 'Rut de entidad',
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
    <div class="col-lg-12">
        
        <!--RESULTADO POR NUMERO DE RUT Y BOLETA-->
        
        <?php if(!empty($this->session->userdata('boleta_xrut_xnum'))){ ?>
        <div class="dataTable_wrapper">
            <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Numero boleta</th>
                        <th>Monto boleta</th>
                        <th>Fecha recepcion</th>
                        <th>Fecha emision</th>
                        <th>Fecha vencimiento</th>
                        <th>Banco</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Numero boleta</th>
                        <th>Monto boleta</th>
                        <th>Fecha recepcion</th>
                        <th>Fecha emision</th>
                        <th>Fecha vencimiento</th>
                        <th>Banco</th>
                        <th>Descripcion</th>
                    </tr>
                </tfoot>
                <?php echo $this->session->userdata('boleta_xrut_xnum');  ?>
                <?php  $this->session->unset_userdata('boleta_xrut_xnum');?>
            </table>
        </div>
        
        <!--RESULTADO POR NUMERO DE RUT-->
        
        <?php }elseif (!empty($this->session->userdata('boleta_xrut'))){ ?>
            <div class="dataTable_wrapper">
            <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Numero boleta</th>
                        <th>Monto boleta</th>
                        <th>Fecha recepcion</th>
                        <th>Fecha emision</th>
                        <th>Fecha vencimiento</th>
                        <th>Banco</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Numero boleta</th>
                        <th>Monto boleta</th>
                        <th>Fecha recepcion</th>
                        <th>Fecha emision</th>
                        <th>Fecha vencimiento</th>
                        <th>Banco</th>
                        <th>Descripcion</th>
                    </tr>
                </tfoot>
                <?php echo $this->session->userdata('boleta_xrut');  ?>
                <?php  $this->session->unset_userdata('boleta_xrut');?>
            </table>
        </div>
        
        <!--RESULTADO BUSQUEDA POR NUMERO DE BOLETA-->
        
        <?php }elseif (!empty($this->session->userdata('boleta_xnum'))){ ?>
            <div class="dataTable_wrapper">
            <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Numero boleta</th>
                        <th>Monto boleta</th>
                        <th>Fecha recepcion</th>
                        <th>Fecha emision</th>
                        <th>Fecha vencimiento</th>
                        <th>Banco</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Numero boleta</th>
                        <th>Monto boleta</th>
                        <th>Fecha recepcion</th>
                        <th>Fecha emision</th>
                        <th>Fecha vencimiento</th>
                        <th>Banco</th>
                        <th>Descripcion</th>
                    </tr>
                </tfoot>
                <?php echo $this->session->userdata('boleta_xnum');  ?>
                <?php  $this->session->unset_userdata('boleta_xnum');?>
            </table>   
        </div>
        <?php } ?>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>