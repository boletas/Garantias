<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indicadores_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('recursos');
        $this->load->model('indicadores_model');
    }
    
    public function index(){
        
    }
    
    public function IngresoIndicadores(){
        if($this->ValidaIngreso()){
            $indicadores = array(
                            'ingreso'       => 1,
                            'indicadores'   => $this->recursos->Indicadores());
        }else{
            $indicadores = array(
                            'ingreso'       => 0,
                            'indicadores'   => $this->recursos->Indicadores());
        }
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('indicadores/indicadores',$indicadores);
        $this->load->view('footer');
    }
    
    public function GuardarIndicadores(){
        $uf = $this->input->post('uf');
        $dolar = $this->input->post('dolar');
        $euro = $this->input->post('euro');
        
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
    
    public function ValidaIngreso(){//-5 dias o +5 dias desde fin de mes (rango ingreso indicadores)
        //$ultimo_ingreso = $this->recursos->FormatoFecha1($this->recursos->UltimoDiaMes());
        foreach($this->indicadores_model->UltimoMonto() as $row){
            $ultimo_ingreso = $row->fecha_costo;
        }
        $fecha_ant = $this->recursos->sumaFechas("-5 day");
        $fecha_pos = $this->recursos->sumaFechas("5 day");
        
        if(($ultimo_ingreso >= $fecha_ant) || ($ultimo_ingreso <= $fecha_pos)){
            return true;
        }else{
            return false;
        }
    }
}