
<link rel="stylesheet" href="<?=base_url();?>assets/login/login.css">
<link rel="stylesheet" href="<?=base_url();?>assets/login/animate-custom.css">
<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <div class="login-box clearfix animated flipInY">
                <div class="page-icon animated bounceInDown">
                    <img class="img-responsive" src="<?=base_url();?>assets/img/login-key-icon.png" alt="Key icon" />
                </div>
                <hr />
                <div class="login-form">
                    <!--** MENSAJE DE ERROR USUARIO INCORRECTO **-->
                    <?php 
                    if($this->session->flashdata('usuario_incorrecto')){?>
                    <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Error!</h4>
                        <?php echo $this->session->flashdata('usuario_incorrecto')?>
                    </div>
                    <?php } ?>
                    <!--** FIN MENSAJES DE ERROR **-->
                    <?php 
                    echo form_open(base_url().'index.php/login_controller/Inicio_Sesion');
                    $user = array(
                        'name'          => 'usuario',
                        'placeholder'   => 'Nombre de usuario',
                        'type'          => 'text',
                        'class'         => 'input-field',
                        'required'      => 'true',
                        'value'         => set_value('usuario')
                    );
                    $pass = array(
                        'name'          => 'password',
                        'placeholder'   => 'Contraseña',
                        'class'         => 'input-field',
                        'type'          => 'password',
                        'required'      => 'true'

                    );
                    $submit = array(
                        'class'         => 'btn btn-login',
                        'value'         => 'Inicio sesion',
                    );
                    
                    echo form_input($user);
                    echo form_input($pass);
                    echo form_submit($submit);
                    echo form_close(); 
                    ?>

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
<script src="<?=base_url();?>assets/js/custom.modernizr.js"></script>
<script src="<?=base_url();?>assets/js/custom.js"></script>
<script src="<?=base_url();?>assets/js/placeholder-shim.min.js"></script>