<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Plantilla_Controller extends MY_Mantenedor {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('recursos');
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
                    $indicadores = array('indicadores' => $this->recursos->Indicadores());
                    $this->load->view('inicio', $indicadores);
                    break;
                case "nueva_boleta":
                        $this->load->view('ingreso/nueva_boleta');
                    break;
                case "ingreso_form":
                    
                        $data['entidad'] = $this->TraerEntidad($this->session->userdata('idEntidad'));
                        $data['bancos'] = $this->ObtieneBancos();
                        $data['monedas'] = $this->ObtieneMoneda();
                        $data['garantias'] = $this->ObtieneTipoGarantia();
                        $data['tipos'] = $this->ObtieneTipoBoletas();
                        
                        $this->load->view('ingreso/ingreso_form', $data);
                    break;
                case "busqueda_boleta":
                    $this->load->view('busqueda/busqueda_boleta');
                    break;
                case "perfil_usuario":
                    $this->load->view('usuario/perfil_usuario');
                    break;
                case "configuracion_usuario":
                    $this->load->view('usuario/configuracion');
                    break;
                case "banco":
                    $data['bancos'] = $this->ObtieneStringBancos();
                    $this->load->view('banco/banco', $data);
                    break;
                case "nuevo_banco":
                    $this->load->view('banco/nuevo_banco');
                    break;
                case "edita_banco":
                    $this->load->view('banco/edita_banco');
                    break;
                case "tipo_empresa":
                    $this->load->view('empresa/tipo_empresa');
                    break;
                case "reportes":
                    $this->load->view('reportes/reportes');
                    break;
                
                case "retiro_boleta":
                    
                    $this->load->view('retiro/retiro_boleta');
                    break;
                    
                case "resultado_boleta":
                    $this->load->view('busqueda/resultado_boleta');
                    break;
            }
        }
        $this->load->view('footer');//carga de footer cierra body y html
    }
}
