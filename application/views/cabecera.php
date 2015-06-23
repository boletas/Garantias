<div id="wrapper">
    <!--  -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url();?>?sec=Inicio">Boletas de Garantia</a>
        </div>
        <!-- comienzo menu horizontal -->
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
<!--                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>-->
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?php echo base_url();?>?sec=perfil_usuario"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
                    </li>
                    <li><a href="<?php echo base_url();?>?sec=configuracion_usuario"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url();?>index.php/logout_controller/Cerrar_Sesion"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- fin menu horizontal -->
        
        <!-- comienzo menu lateral -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="<?php echo base_url() ?>?sec=Inicio"><i class="fa fa-home fa-fw"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>?sec=nueva_boleta"><i class="fa fa-list-alt fa-fw"></i> Nueva Boleta</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>index.php/boleta_controller/TodasBoletas"><i class="fa fa-search fa-fw"></i> Busqueda Boleta</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-database fa-fw"></i> Mantenedores<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url();?>?sec=banco"><i class="fa fa-bank fa-fw"></i> Banco</a>
                            </li>
<!--                            <li>
                                <a href="<?php //echo base_url();?>?sec=tipo_empresa"><i class="fa fa-briefcase fa-fw"></i> Tipo Empresa</a>
                            </li>-->
                            <li>
                                <a href="<?php echo base_url();?>index.php/entidad_controller/entidades"><i class="fa fa-file-text fa-fw"></i> Entidades</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="<?php echo base_url();?>index.php/reportes_controller/buscador"><i class="fa fa-file-text fa-fw"></i> Reportes</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>?sec=retiro_boleta"><i class="fa fa-clipboard fa-fw"></i> Retiro boleta</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- fin menu lateral -->
    </nav>
    <!-- fin menu horizontal y vertical -->

    <div id="page-wrapper">
        <br/>
            
