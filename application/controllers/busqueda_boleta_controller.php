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
            $hoy = date("Y-m-d");
            $html = "";
            $html .= "<tbody>";
            foreach($data as $row){
                
                $vence = "";
                if($row->fecha_vencimiento < $hoy){
                    $calculo = $this->recursos->dias_transcurridos($row->fecha_vencimiento,$hoy);
                    if($calculo > 365){
                        $calculo = $calculo/365;
                        $vence = "Hace ".round($calculo)." años";
                    }else{
                        $vence = "Hace ".$calculo." días";
                    }
                }else{
                    $calculo = $this->recursos->dias_transcurridos($row->fecha_vencimiento,$hoy);
                    if($calculo > 365){
                        $calculo = $calculo/365;
                        $vence = "En ".round($calculo)." años";
                    }else{
                        $vence = "en ".$calculo." días";
                    }
                }
                
                $html .= "<td>".$row->numero_boleta."</td>";
                $html .= "<td>".$this->recursos->DevuelveRut($row->rut)."</td>";
                $html .= "<td>".date("d-m-Y", strtotime($row->fecha_emision))."</td>";
                $html .= "<td>(".$row->codigo.") ".$row->monto_boleta."</td>";
                $html .= "<td>".date("d-m-Y", strtotime($row->fecha_vencimiento))."</td>";
                $html .= "<td>".$vence."</td>";
                $html .= "<td align='center'>";
                $html .= "<button type='button' class='btn btn-default btn-circle'><i class='fa fa-eye'></i></button>&nbsp;";
                $html .= "<button type='button' class='btn btn-default btn-circle'><i class='fa fa-pencil'></i></button>&nbsp;";
                $html .= "<button type='button' class='btn btn-default btn-circle'><i class='fa fa-file-pdf-o'></i></button>";
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