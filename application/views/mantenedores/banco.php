<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mantenedor Banco</h1>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th><button type="button" class="btn btn-outline btn-primary btn-xs" onclick="Accion('nuevo')">Nuevo Banco</button></th>
            </tr>
            <?php
                $cont = 0;
                foreach ($bancos as $banco){ ?>
            <tr>
                <td><?php echo ++$cont;?></td>
                <td><?php echo $banco->nombre_banco?></td>
                <td>
                    <button type="button" value="<?php $banco->idBanco ?>" class="btn btn-outline btn-primary btn-xs" onclick="Accion('editar')">Editar</button>
                    <button type="button" value="<?php $banco->idBanco ?>" class="btn btn-outline btn-danger btn-xs" onclick="Accion('eliminar')">Eliminar</button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<script>
    function Accion(que){
        if(que == 'nuevo'){
           alert("nuevo banco");
        }
        if(que == "editar"){
           alert("Editar"); 
        }
        if(que == "eliminar"){
            alert("Eliminar");
        }
    }
</script>