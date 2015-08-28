<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indicadores_Controller extends MY_Mantenedor {
    public function __construct(){
        parent::__construct();
        $this->load->model('indicadores_model');
        $this->load->library('recursos');
    }
    
    public function index(){
        
    }
    
    public function IngresoIndicadores(){
        $valores = array();
        $indi = $this->indicadores_model->UltimoMonto();
        
        foreach($indi as $row){
            $valores['idCosto'] = $row->idCosto;
            $valores['fecha_costo'] = $row->fecha_costo;
            $valores['e_uf'] = $this->recursos->FormatoMoneda($row->e_uf);
            $valores['e_dolar'] = $this->recursos->FormatoMoneda($row->e_dolar);
            $valores['e_euro'] = $this->recursos->FormatoMoneda($row->e_euro);
        }
        
        $indicadores = array(
                        'ingreso'       => (!empty($indi) ? $this->ValidaIngreso() : 1),
                        'valores'       => $valores);
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('indicadores/indicadores',$indicadores);
        $this->load->view('footer');
    }
    
    public function GuardarIndicadores(){
        $uf = $this->recursos->FormatoMonedaMySQL($this->input->post('uf'));
        $dolar = $this->recursos->FormatoMonedaMySQL($this->input->post('dolar'));
        $euro = $this->recursos->FormatoMonedaMySQL($this->input->post('euro'));
        
        $data = $this->indicadores_model->GuardarIndicadores($uf,$dolar,$euro);
        if($data){
            $mensaje = array('ok' => 'Los indicadores fueron ingresados correctamente.');
            $this->session->set_userdata($mensaje);
        }else{
            $mensaje = array('error' => 'Ocurrio un problema al tratar de ingresar los indicadores.');
            $this->session->set_userdata($mensaje);
        }
        $this->IngresoIndicadores();
    }
}