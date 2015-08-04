<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendientes_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('recursos');
        $this->load->model('pendientes_model');
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
                $clase = "";
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
                        if($calculo < 10){
                            $clase = " class = 'danger' ";
                        }else{
                            $clase = "";
                        }
                        
                        if($calculo == 0){
                            $vence = "Hoy";
                        }else{
                            $vence = "en ".$calculo." días";
                        }
                    }
                }
                $html .= "<tr".$clase."><td>".$row->numero_boleta."</td>";
                $html .= "<td>".$this->recursos->DevuelveRut($row->rut)."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_emision)."</td>";
                $html .= "<td>(".$row->codigo.") ".$row->monto_boleta."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_vencimiento)."</td>";
                $html .= "<td>".$vence."</td>";
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
}