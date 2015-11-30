<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entregadas_Controller extends MY_Mantenedor{
    public function __construct(){
        parent::__construct();
        $this->load->library('recursos');
        $this->load->model('entregadas_model');
        $this->load->model('anexo_model');
        $this->check_login();
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
                
                $anexo = $this->TraeAnexo($row->id_Boleta); //Obtiene datos anexo para cargar la tabla.!!!!
                $fecha_vencimiento = ($anexo ? $anexo['fecha_final'] : $row->fecha_vencimiento);
                $monto_boleta = ($anexo ? $anexo['monto_final'] : $row->monto_boleta);
                
                $v = $this->recursos->VenceEn($fecha_vencimiento);
                
                $html .= "<tr".$v['clase']."><td>".$row->numero_boleta."</td>";
                $html .= "<td>".$this->recursos->DevuelveRut($row->rut)."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_emision)."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($fecha_vencimiento)."</td>";
                $html .= "<td>".$row->descripcion_tipo_boleta."</td>";
                $html .= "<td>".$v['vence']."</td>";
                $html .= "<td>".$this->recursos->formateo_moneda($row->codigo,$monto_boleta)."</td>";
                $html .= "<td align='center'>";
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Entregada(".$row->id_Boleta.")'><i class='fa fa-eye'></i></button>&nbsp;";
                $html .= "</td></tr>";
            }
            $html .= "</tbody>";
            $this->Entregadas($html);
        }else{
            $html["mensaje"] = "Actualmente no existen documentos con el estado \"Entregado\".";
            $this->Entregadas($html);
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