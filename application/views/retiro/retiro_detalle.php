<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detalles Boleta <small>N°<?php echo $numero_boleta; ?></small></h1>
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
                <td>N° Boleta</td>
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
                <td <?=($clase ? $clase : "")?>><?php echo $vence; ?></td>
            </tr>
            <tr class="active">
                <td>Tipo Garantía</td>
                <td colspan="3">Denominación de Estudio</td>
                <td>Banco</td>
            </tr>
            <tr>
                <td><?php echo $tipo_garantia; ?></td>
                <td colspan="3"><?php echo $denominacion; ?></td>
                <td><?php echo $nombre_banco; ?></td>
            </tr>
            <tr class="active">
                <td colspan="2">Tipo Boleta</td>
                <td colspan="2">Estado Boleta</td>
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
            <?php 
            if($this->session->userdata("xrut") && !$this->session->userdata("xnum")){ ?>
                <!--<form action="<?php echo base_url()?>index.php/retiro_controller/BuscarRetiro" method="post">-->
                    <button type="submit" class="btn btn-outline btn-default">Atras</button>
                    <!--<a class="btn btn-outline btn-danger" href="<?php echo base_url()?>index.php/pdf_controller/BoletaPdf/<?php echo $id_Boleta?>" onclick="return Pregunta();" id="PDF" target="_blank">PDF <i class="fa fa-file-pdf-o"></i></a>-->
                    <a class="btn btn-outline btn-danger" href="<?php echo base_url()?>index.php/pdf_controller/EstadoBoleta/<?php echo $id_Boleta."/3"; ?>" onclick="return Pregunta();" id="PDF" target="_blank">PDF <i class="fa fa-file-pdf-o"></i></a>
                    <input type="hidden" value="<?php echo $rut; ?>" name="rut_buscar">
                <!--</form>-->
            <?php 
            }elseif($this->session->userdata("xnum") && !$this->session->userdata("xrut")){ ?>
                <!--<form action="<?php echo base_url()?>index.php/retiro_controller/BuscarRetiro" method="post">-->
                    <button type="submit" class="btn btn-outline btn-default">Atras</button>
                    <!--<a class="btn btn-outline btn-danger" href="<?php echo base_url()?>index.php/pdf_controller/BoletaPdf/<?php echo $id_Boleta?>" onclick="return Pregunta();" id="PDF" target="_blank">PDF <i class="fa fa-file-pdf-o"></i></a>-->
                    <a class="btn btn-outline btn-danger" href="<?php echo base_url()?>index.php/pdf_controller/EstadoBoleta/<?php echo $id_Boleta."/3"; ?>" onclick="return Pregunta();" id="PDF" target="_blank">PDF <i class="fa fa-file-pdf-o"></i></a>
                    <input type="hidden" value="<?php echo $numero_boleta; ?>" name="num_buscar">
                <!--</form>-->
            <?php 
            }elseif($this->session->userdata("xrut") && $this->session->userdata("xnum")){ ?>
                <!--<form action="<?php echo base_url()?>index.php/retiro_controller/BuscarRetiro" method="post">-->
                    <button type="submit" class="btn btn-outline btn-default">Atras</button>
                    <!--<a class="btn btn-outline btn-danger" href="<?php echo base_url()?>index.php/pdf_controller/BoletaPdf/<?php echo $id_Boleta?>" onclick="return Pregunta();" id="PDF" target="_blank">PDF <i class="fa fa-file-pdf-o"></i></a>-->
                    <a class="btn btn-outline btn-danger" href="<?php echo base_url()?>index.php/pdf_controller/EstadoBoleta/<?php echo $id_Boleta."/3"; ?>" onclick="return Pregunta();" id="PDF" target="_blank">PDF <i class="fa fa-file-pdf-o"></i></a>
                    <input type="hidden" value="<?php echo $rut; ?>" name="rut_buscar">
                    <input type="hidden" value="<?php echo $numero_boleta; ?>" name="num_buscar">
                <!--</form>-->
            <?php } ?>
<!--                <input type="hidden" name="id_boleta" value="<?php echo $id_Boleta; ?>"/>
                <input type="hidden" name="id_estado_boleta" value="3"/>-->
            </form>
        </div>
    </div>
</div>
<script>
    function Pregunta(){
        if(confirm("El estado de la Boleta será modificado a pendiente, ¿Está seguro de continuar?")){
            return true;
        }else{
            return false;
        }
    }
</script>