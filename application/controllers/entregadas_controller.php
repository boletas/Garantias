<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entregadas_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('recursos');
        $this->load->model('entregadas_model');
    }
    
    public function index(){
        
    }
    
    public function Entregadas($html = ""){
        $resultado['html'] = $html;
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('entregadas/entregadas',$resultado);
        $this->load->view('footer');
    }
        
    public function ListaEntregadas(){
        $data = $this->entregadas_model->ListaEntregadas();
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
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Entregada(".$row->id_Boleta.")'><i class='fa fa-eye'></i></button>&nbsp;";
                $html .= "</td></tr>";
            }
            $html .= "</tbody>";
            $this->Entregadas($html);
        }else{
            return false;
        }
    }
    
    public function DetalleEntregada($idBoleta){
        $html = "";
        $data = $this->entregadas_model->DetalleEntregada($idBoleta);
        foreach($data as $row){
            $html["idBoleta"] = $row->id_Boleta;
            $html["numero_boleta"] = $row->numero_boleta;
            $html["rut_retiro"] = $this->recursos->DevuelveRut($row->rut_retiro);
            $html["nombre_retiro"] = $row->nombre_retiro;
            $html["ap_retiro"] = $row->ap_retiro;
            $html["fecha_retiro"] = $this->recursos->FormatoFecha($row->fecha_retiro);
        }
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('entregadas/detalle_entregada',$html);
        $this->load->view('footer');
    }
}