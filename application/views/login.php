<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>...:::Boletas Garantia:::...</title>
        <link rel="stylesheet" href="<?php base_url();?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php base_url();?>assets/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php base_url();?>assets/css/login.css">
        <link rel="stylesheet" href="<?php base_url();?>assets/css/animate-custom.css">
        
    </head>
    <body>
        <div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                    <div class="login-box clearfix animated flipInY">
                        <div class="page-icon animated bounceInDown">
                            <img class="img-responsive" src="<?php base_url();?>assets/img/login-key-icon.png" alt="Key icon" />
                        </div>
                        <hr />
                        <div class="login-form">
                            
                            <!--** MENSAJE DE ERROR USUARIO INCORRECTO **-->
                            <?php
                                if($this->session->flashdata('usuario_incorrecto')){
                            ?>
                            <div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <h4>Error!</h4>
                                <?=$this->session->flashdata('usuario_incorrecto')?>
                            </div>
                            
                            <?php }?>
                            <!--** FIN MENSAJES DE ERROR **-->
                            
                            <form action="<?php base_url();?>login/inicio_sesion" method="post">
                                <input type="text" placeholder="Nombre de usuario" value="<?php echo set_value('usuario')?>" name="usuario" class="input-field" required/> 
                                <input type="password"  placeholder="password" name="password" class="input-field" required/> 
                                <button type="submit" class="btn btn-login">Inicio sesion</button> 
                            </form>	
                            <div class="login-links"> 
                                <a href="forgot-password.html">
                                    Olvidé mi contraseña
                                </a>
                                <br />
                            </div>      		
                        </div> 			        	
                    </div>
                </div>
            </div>
        </div> <!-- ** FIN CONTAINER ** -->
    </body>
    
    
        <script src="<?php base_url();?>assets/js/custom.modernizr.js"></script>
        <script src="<?php base_url();?>assets/js/custom.js"></script>
        <script src="<?php base_url();?>assets/js/placeholder-shim.min.js"></script>
        <script src="<?php base_url();?>assets/js/jquery-1.11.2.min.js"></script>
        <script src="<?php base_url();?>assets/js/bootstrap.min.js"></script>
</html>