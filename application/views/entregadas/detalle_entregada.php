<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detalle Boleta Entregada</h1>
    </div>
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <td class="active">N° Boleta</td>
                <td colspan="3"><?php echo $numero_boleta; ?></td>
            </tr>
            <tr>
                <td class="active">Fecha Entrega </td>
                <td colspan="3"><?php echo $fecha_retiro; ?></td>
            </tr>
            <tr>
                <td class="active">Rut</td>
                <td colspan="3"><?php echo $rut_retiro; ?></td>
            </tr>
            <tr>
                <td class="active">Nombre</td>
                <td colspan=""><?php echo $nombre_retiro;?></td>
                <td class="active">Apellido</td>
                <td colspan=""><?php echo $ap_retiro;?></td>
            </tr>
        </table>
        <div class="col-lg-12">
            <div align="right">
                <button name="volver" id="volver" class="btn btn-outline btn-default" onclick="Volver()">Volver</button>
            </div>
        </div>
    </div>
<script>
function Volver(){
    window.history.back();
    return false;
}
</script>