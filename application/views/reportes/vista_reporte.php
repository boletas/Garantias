<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Vista Reporte</h1>
    </div>
    <div class="col-lg-12">
        <?php 
            $form = array('name'    => 'form1');
            echo form_open(base_url()."index.php/reportes_controller/",$form);
        ?>
        <table class="table table-bordered table-hover">
            <tr>
                <td class="active"><b>N°</b></td>
                <td class="active"><b>Rut</b></td>
                <td class="active"><b>Nombre</b></td>
                <td class="active"><b>Tipo</b></td>
                <td class="active"><b>Monto</b></td>
            </tr>
            <?php echo $html; ?>
            <tr>
                <td class="active" colspan="4" align="right"><b>Monto Total &nbsp;</b></td>
                <td class="active" align="right"><b>$ <?php echo $total; ?>.-</b></td>
            </tr>
        </table>
        <?php echo form_close(); ?>
        <form action="<?php echo base_url();?>index.php/pdf_controller/ReportePdf" method="post">
            <input type="hidden" name="html" value="<?php echo $html; ?>"/>
            <div align="right">
                <a href="<?php echo base_url();?>index.php/reportes_controller/index" class="btn btn-outline btn-default" name="volver" id="volver">Volver</a>
                <a href="<?php echo base_url();?>index.php/reportes_controller/ExcelReporte/<?=$datos['fecha']?>/<?=$datos['vence']?>/<?=$datos['periodo']?>/<?=$datos['tipo']?>/<?=$datos['busqueda']?>/<?=$datos['rut']?>" class="btn btn-outline btn-success" name="volver" id="volver">Excel <i class="fa fa-file-excel-o"></i></a>
                <a href="<?php echo base_url();?>index.php/pdf_controller/ReportePdf/<?=$datos['fecha']?>/<?=$datos['vence']?>/<?=$datos['periodo']?>/<?=$datos['tipo']?>/<?=$datos['busqueda']?>/<?=$datos['rut']?>" class="btn btn-outline btn-danger" name="Modificar" id="Modificar" target="_blank">PDF <i class="fa fa-file-pdf-o"></i></a>
            </div>
        </form>
    </div>
</div>