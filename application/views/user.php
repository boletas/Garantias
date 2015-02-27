<html>
    <head>
        <title>title</title>
    </head>
    <body>
        
        <?=$this->session->userdata('usuario')?>
        <a href="<?=base_url();?>index.php/login_controller/cerrar_sesion">cerrar sesion</a>

    </body>
</html>
