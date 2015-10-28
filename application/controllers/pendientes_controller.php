<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendientes_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('recursos');
        $this->load->model('pendientes_model');
        $this->load->model('anexo_model');
    }
    
    public function index(){
        
    }
    
    public function Pendientes($html = ""){
        $resultado['html'] = $html;
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('pendientes/pendientes',$resultado);
        $this->load->view('footer');
    }
    
    public function Retiro($html = ""){
        $resultado['html'] = $html;
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('pendientes/retiro_boleta',$resultado);
        $this->load->view('footer');
    }
    
    public function ListaPendientes(){
        $data = $this->pendientes_model->ListaPendientes();
        if($data){
            $hoy = date("Y-m-d");            
            $html = "";
            $html .= "<tbody>";
            foreach($data as $row){
                $monto_boleta = "";
                $anexo = "";
                $fecha_vencimiento = "";
                $clase = "";
                $vence = "";
                $anexo = $this->TraeAnexo($row->id_Boleta); //Obtiene datos anexo para cargar la tabla.!!!!
                $fecha_vencimiento = ($anexo ? $anexo['fecha_final'] : $row->fecha_vencimiento);
                $monto_boleta = ($anexo ? $anexo['monto_final'] : $row->monto_boleta);

                $v = $this->recursos->VenceEn($fecha_vencimiento);
                
                $html .= "<tr".$v['clase']."><td>".$row->numero_boleta."</td>";
                $html .= "<td>".$this->recursos->DevuelveRut($row->rut)."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_emision)."</td>";
                $html .= "<td>(".$row->codigo.") ".$monto_boleta."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($fecha_vencimiento)."</td>";
                $html .= "<td>".$v['vence']."</td>";
                $html .= "<td align='center'>";
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Retiro(".$row->id_Boleta.")'><i class='fa fa-check-square-o'></i></button>&nbsp;";
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='PDF(".$row->id_Boleta.")'><i class='fa fa-file-pdf-o'></i></button>&nbsp;";
                $html .= "</td></tr>";
            }
            $html .= "</tbody>";
        }else{
            $html['mensaje'] = "Actualmente no existen boletas con el estado \"pendientes\"";
        }
        $this->Pendientes($html);
    }
    
    public function GuardarRetiro(){
        $idBoleta = $this->input->post("idBoleta");
        $rut = $this->recursos->FormatoRut($this->input->post("rut"));
        $nombre = $this->input->post("nombre");
        $apellido = $this->input->post("apellido");
        $data = $this->pendientes_model->GuardarRetiro($idBoleta,$rut,$nombre,$apellido);
        if($data){
            $mensaje = array('ok'   => 'El estado de la boleta fue cambiado correctamente.');
            $this->session->set_userdata($mensaje);
        }else{
            $mensaje = array('error'   => 'Ocurrio un problema al tratar de cambiar el estado de la boleta.');
            $this->session->set_userdata($mensaje);
        }
        $this->ListaPendientes();
    }
    
    public function TraeAnexo($idBoleta){ // obtiene datos de anexo segun id de boleta
        $data = $this->anexo_model->TraerAnexo($idBoleta);
        if($data){
            $resultado = array();
            foreach($data as $row){
                $resultado['monto_final'] = $row->monto_final;
                $resultado['fecha_final'] = $row->fecha_final;
            }
            return $resultado;
        }else{
            return false;
        }
    }
}