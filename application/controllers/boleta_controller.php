<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Boleta_controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('boleta_model');
        
    }
    
    public function insert_boleta(){
        
        $idEntidad = $this->input->post('idEntidad');
        $num_boleta = $this->input->post('num_boleta');
        $monto_boleta = $this->input->post('monto_boleta');
        $idMoneda = $this->input->post('id_moneda');
        $fecha_recepcion = $this->input->post('fecha_recepcion');
        $fecha_emision = $this->input->post('fecha_emision');
        $fecha_vencimiento = $this->input->post('fecha_vencimiento');
        $denominacion = $this->input->post('denominacion');
        $idBanco = $this->input->post('id_banco');
        $idGarantia = $this->input->post('id_garantia');
        $idTipo = $this->input->post('id_tipo');
        $idEstado = 1;
        
        $insertok = $this->boleta_model->insert_boleta(
                    $num_boleta,
                    $monto_boleta,
                    $fecha_recepcion,
                    $fecha_emision,
                    $fecha_vencimiento,
                    $denominacion,
                    $idEntidad,
                    $idBanco,
                    $idMoneda,
                    $idGarantia,
                    $idTipo,
                    $idEstado);
        
        if($insertok){
            $this->session->set_flashdata('insert','Boleta ingresada correctamente.');
            redirect(base_url()."?sec=nueva_boleta",'refresh');
        }else{
            $this->session->set_flashdata('insert','Error al ingresar boleta.');
            redirect(base_url()."?sec=nueva_boleta",'refresh');
        }
        
        
        
    }
    
    
    
}