<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indicadores_Controller extends MY_Mantenedor {
    public function __construct(){
        parent::__construct();
        $this->load->library('recursos');
        $this->load->model('indicadores_model');
    }
    
    public function index(){
        
    }
    
    public function IngresoIndicadores(){ 
        $valores = $this->indicadores_model->UltimoMonto();
        $indicadores = array(
                        'ingreso'       => (!empty($valores) ? $this->ValidaIngreso() : 1),
                        'valores'       => $valores,
                        'indicadores'   => $this->recursos->Indicadores());
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
    
//    public function ValidaIngreso(){
//        $ultimo_ingreso = 0;
//        $anio = date('Y');
//        $mes = date('m');
//        foreach($this->indicadores_model->UltimoMonto() as $row){
//            $ultimo_ingreso = explode("-", $row->fecha_costo);//separo fecha para comparar mes y año
//        }        
//        if($ultimo_ingreso[0] == $anio && $ultimo_ingreso[1] == $mes){
//            return 0;
//        }else{
//            return 1;
//        }
//    }
}