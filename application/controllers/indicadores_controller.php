<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indicadores_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('recursos');
    }
    
    public function index(){
        
    }
    
    public function IngresoIndicadores(){
        $indicadores = array('indicadores' => $this->recursos->Indicadores());
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('indicadores/indicadores',$indicadores);
        $this->load->view('footer');
    }
    
    public function GuardarIndicadores(){
        $uf = $this->input->post('uf');
        $dolar = $this->input->post('dolar');
        $euro = $this->input->post('euro');
        
        
        
    }
}