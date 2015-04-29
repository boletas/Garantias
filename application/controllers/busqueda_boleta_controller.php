<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Busqueda_Boleta_Controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('busqueda_boleta_model');
        $this->load->library('session');
        $this->load->library('recursos');
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
                $html .= "<td>".$row->rut."</td>";
                //$html .= "<td>".$row->nombre."</td>";
                //$html .= "<td>".date("d-m-Y", strtotime($row->fecha_recepcion))."</td>";
                $html .= "<td>".$row->fecha_emision."</td>";
                $html .= "<td>".$row->monto_boleta."</td>";
                $html .= "<td>".$row->fecha_vencimiento."</td>";
                $html .= "<td>calculo</td>";
                $html .= "<td align='center'>";
                $html .= "<button type='button' class='btn btn-success btn-circle'><i class='fa fa-eye'></i></button>&nbsp;";
                $html .= "<button type='button' class='btn btn-primary btn-circle'><i class='fa fa-eye'></i></button>&nbsp;";
                $html .= "<button type='button' class='btn btn-default btn-circle'><i class='fa fa-eye'></i></button>";
                $html .= "</td></tr>";
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