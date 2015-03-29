<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Plantilla_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }
    
    public function index() {
        $seccion = filter_input(INPUT_GET, "sec");
        
        $this->load->view('plantilla');
        
        if($this->session->userdata('logueado') != TRUE) $this->load->view('login');
        else if($this->session->userdata('logueado') == TRUE) {
            
            $this->load->view('cabecera');
            
            if(empty($seccion))$seccion = 'Inicio';
            switch ($seccion) {
                case "Inicio":
                    $this->load->view('inicio');
                    break;
                case "nueva_boleta":
                    $this->load->view('nueva_boleta');
                    break;
                case "busqueda_boleta":
                    $this->load->view('busqueda_boleta');
                    break;
                case "perfil_usuario":
                    $this->load->view('usuario/perfil_usuario');
                    break;
                case "configuracion_usuario":
                    $this->load->view('usuario/configuracion');
                    break;
            }
        }
        
        $this->load->view('footer');//carga de footer cierra body y html
    }
}
