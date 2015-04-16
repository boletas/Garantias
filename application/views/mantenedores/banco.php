<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th><button type="button" class="btn btn-outline btn-primary btn-xs">Nuevo Banco</button></th>
            </tr>
            <?php
                $cont = 0;
                foreach ($bancos as $banco){ ?>
            <tr>
                <td><?php echo ++$cont;?></td>
                <td><?php echo $banco->nombre_banco?></td>
                <td>
                    <button type="button" value="<?php $banco->idBanco ?>" class="btn btn-outline btn-primary btn-xs">Editar</button>
                    <button type="button" value="<?php $banco->idBanco ?>" class="btn btn-outline btn-danger btn-xs">Eliminar</button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<script>
    function (){
    
    }
</script>