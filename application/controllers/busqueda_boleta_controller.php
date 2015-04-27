<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Busqueda_Boleta_Controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('busqueda_boleta_model');
        $this->load->library('session');
    }
 
    public function index(){
        $que = $this->input->post("que");
        if($que == 1){
            $this->TodasBoletas();
        }
    }
    
    public function TodasBoletas(){
        $data = $this->busqueda_boleta_model->TodasBoletas();
        if($data){
            $html = "";
            $html .= "<tbody>";
            foreach($data as $row){
                $html .= "<td>".$row->numero_boleta."</td>";
                $html .= "<td>".$row->monto_boleta."</td>";
                $html .= "<td>".$row->fecha_recepcion."</td>";
                $html .= "<td>".$row->fecha_emision."</td>";
                $html .= "<td>".$row->fecha_vencimiento."</td>";
                $html .= "<td>".$row->denominacion."</td></tr>";
            }
            $html .= "</tbody>";
            $this->session->set_userdata('html',$html);
            redirect(base_url()."?sec=resultado_boleta",'refresh');
        }else{
            return false;
        }
    }
}

?>