<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Banco</h1>
    </div>
</div>

<?php
//echo $this->session->userdata('banco');
foreach ($this->session->userdata('banco') as $row) {
    echo $row->banco;
}


?>