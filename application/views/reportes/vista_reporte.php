<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Vista Reporte</h1>
    </div>
    <div class="col-lg-12">
        <?php 
            $form = array('name'    => 'form1');
            echo form_open(base_url()."index.php/reportes_controller/",$form);
        ?>
        <table class="table table-bordered">
            <tr>
                <td class="active"><b>N°</b></td>
                <td class="active"><b>Rut</b></td>
                <td class="active"><b>Nombre</b></td>
                <td class="active"><b>Tipo</b></td>
                <td class="active"><b>Monto</b></td>
            </tr>
            <?php echo $html; ?>
            <tr>
                <td class="active" colspan="4" align="right"><b>Monto Total &nbsp;$</b></td>
                <td class="active" align="right"><b><?php echo $total; ?></b></td>
            </tr>
        </table>
    </div>
</div>