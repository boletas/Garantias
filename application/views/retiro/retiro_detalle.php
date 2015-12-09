<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detalle documento <small>N°<?php echo $numero_boleta; ?></small></h1>
        <!--Aca el IF para mostrar el boton-->
        <?php if($html != FALSE){ ?>
        <div class="text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Ver Anexos</button>
        </div>
        <br/>
        <?php } ?>
    </div>
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <td class="active">Rut</td>
                <td colspan="4"><?php echo $rut; ?></td>
            </tr>
            <tr>
                <td class="active">Razón Social</td>
                <td colspan="4"><?php echo $nombre; ?></td>
            </tr>
            <tr class="active">
                <td>N° Documento</td>
                <td>Fecha Recepción</td>
                <td>Fecha Emisión</td>
                <td>Fecha Vecimiento</td>
                <td>Vence</td>
            </tr>
            <tr>
                <td><?php echo $numero_boleta; ?></td>
                <td><?php echo $fecha_recepcion; ?></td>
                <td><?php echo $fecha_emision; ?></td>
                <td><?php echo $fecha_vencimiento; ?></td>
                <td <?php echo ($clase ? $clase : ""); ?>><?php echo $vence; ?></td>
            </tr>
            <tr class="active">
                <td>Tipo Garantía</td>
                <td colspan="3">Denominación de Estudio</td>
                <td>Banco</td>
            </tr>
            <tr>
                <td><?php echo $tipo_garantia; ?></td>
                <td colspan="3" width="300px"><?php echo $denominacion; ?></td>
                <td><?php echo $nombre_banco; ?></td>
            </tr>
            <tr class="active">
                <td colspan="2">Tipo Documento</td>
                <td colspan="2">Estado Documento</td>
                <td>Costo Total</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $tipo_boleta; ?></td>
                <td colspan="2"><?php echo $estado_boleta; ?></td>
                <td><b><?php echo $monto_boleta; ?></b></td>
            </tr>
        </table>
        <div align="right">
            <form action="<?php echo base_url()?>index.php/retiro_controller/BuscarRetiro" method="post">
                <button type="submit" class="btn btn-outline btn-default">Atras</button>
                <a class="btn btn-outline btn-danger" onclick="return Pregunta();" id="PDF" target="_blank">PDF <i class="fa fa-file-pdf-o"></i></a>
                <input type="hidden" value="<?php echo $this->session->userdata('xrut'); ?>" name="rut_buscar">
                <input type="hidden" value="<?php echo $this->session->userdata('xnum'); ?>" name="num_buscar">
            </form>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Listado de Anexos</h4>
                </div>
                <div class="modal-body">
                    <?php if($html != FALSE){ ?>
                    <?php echo $html; ?>
                    <?php } ?>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->



<script>
    function Pregunta(){
        if(confirm("El estado del documento será modificado a pendiente, ¿Está seguro de continuar?")){
            window.open('<?php echo base_url(); ?>index.php/pdf_controller/EstadoBoleta/<?php echo $id_Boleta; ?>/3', '_blank');
            location.href = "<?php echo base_url();?>index.php/plantilla_controller/?sec=retiro_boleta";
            return true;
        }else{
            return false;
        }
    }
</script>