<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Vista Reporte</h1>
    </div>
    <div class="col-lg-12">
        <div align="right">
            <a href="<?php echo base_url();?>index.php/reportes_controller/Buscador" class="btn btn-outline btn-default" name="volver" id="volver">Volver</a>
            <a href="<?php echo base_url();?>index.php/reportes_controller/ExcelReporte/<?=$datos['fecha']?>/<?=$datos['fecha1']?>/<?=$datos['vence']?>/<?=$datos['periodo']?>/<?=$datos['rut']?>/<?=$datos['tipo']?>/<?=$datos['busqueda']?>/<?=$datos['estado']?>" class="btn btn-outline btn-success" name="volver" id="volver">Excel <i class="fa fa-file-excel-o"></i></a>
        </div>
        <br/>
        <?php 
            $form = array('name'    => 'form1');
            echo form_open(base_url()."index.php/reportes_controller/",$form);
        ?>
        <table class="table table-bordered table-hover">
            <tr>
                <td class="active"><b>N°</b></td>
                <td class="active"><b>Rut</b></td>
                <td class="active"><b>Emisón</b></td>
                <td class="active"><b>Vencimiento</b></td>
                <td class="active"><b>Tipo</b></td>
                <td class="active" colspan="2" align="center"><b>Montos</b></td>
                <td class="active"><b>Monto (CLP)</b></td>
            </tr>
            <?php echo $html; ?>
            <tr>
                <td class="active" colspan="7" align="right"><b>Monto Total &nbsp;</b></td>
                <td class="active" align="right"><b>$ <?php echo $total; ?>.-</b></td>
            </tr>
        </table>
        <?php echo form_close(); ?>
        <div align="right">
            <a href="<?php echo base_url();?>index.php/reportes_controller/Buscador" class="btn btn-outline btn-default" name="volver" id="volver">Volver</a>
            <a href="<?php echo base_url();?>index.php/reportes_controller/ExcelReporte/<?=$datos['fecha']?>/<?=$datos['fecha1']?>/<?=$datos['vence']?>/<?=$datos['periodo']?>/<?=$datos['rut']?>/<?=$datos['tipo']?>/<?=$datos['busqueda']?>/<?=$datos['estado']?>" class="btn btn-outline btn-success" name="volver" id="volver">Excel <i class="fa fa-file-excel-o"></i></a>
            <br/>
            &nbsp;
            <br/>
        </div>
    </div>