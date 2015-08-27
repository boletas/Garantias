<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retiro_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('retiro_model');
        $this->load->library('recursos');
    }
    
    public function BuscarRetiro(){
        $rut = $this->recursos->FormatoRut($this->input->post('rut_buscar'));
        $num = $this->input->post('num_buscar');
        
   
        $this->session->unset_userdata("xrut");
        $this->session->unset_userdata("xnum");
        
        
        if (empty($rut) && empty($num)){
            
            $this->session->set_flashdata('error', 'No puede enviar datos vacios');
            redirect(base_url()."?sec=retiro_boleta",'refresh');
            
        }elseif (!empty($rut) && !empty($num)) {
            
            
            $this->session->set_userdata("xrut",$rut);
            $this->session->set_userdata("xnum",$num);
            $query = $this->retiro_model->BuscarRutNum($rut,$num);
           
            if($query){
                
                $this->vista_retiro($this->llenar_tabla_retiro($query));
                
           }else{
               $this->session->set_flashdata('error', 'No existen boletas con rut, numero especificado o no se encuentra en custodia');
               redirect(base_url()."?sec=retiro_boleta",'refresh');
           }
            
        }elseif (empty($rut) && !empty($num)) {
            
            $this->session->set_userdata("xnum",$num);
            $query = $this->retiro_model->BuscarXNum($num);
           
            if($query){
                
                $this->vista_retiro($this->llenar_tabla_retiro($query));
                
           }else{
               $this->session->set_flashdata('error', 'No existen boletas con numero especificado o no se encuentra en custodia');
               redirect(base_url()."?sec=retiro_boleta",'refresh');
           }
            
            
            
        }elseif (!empty($rut) && empty($num)) {
            
            $this->session->set_userdata("xrut",$rut);
            $query = $this->retiro_model->BuscarXRut($rut);
           
           if($query){
               
                $this->vista_retiro($this->llenar_tabla_retiro($query));
                
           }else{
               $this->session->set_flashdata('error', 'No existen boletas con rut especificado o no se encuentra en custodia');
               redirect(base_url()."?sec=retiro_boleta",'refresh');
           }
        }
    }
    
    public function vista_retiro($data){
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('retiro/retiro_lista', $data);
        $this->load->view('footer');
        
    }
    
    
    public function llenar_tabla_retiro($query){
        $html = "";
                $c = 0;
                $html .= "<tbody>\n";
                foreach ($query as $row) {
                    $html .= "<tr>";
                    $html .= "<td>".$row->numero_boleta."</td>";
                    $html .= "<td>".$this->recursos->DevuelveRut($row->rut)."</td>";
                    $html .= "<td>(".$row->codigo.") ".$row->monto_boleta."</td>";
                    $html .= "<td>".$row->fecha_recepcion."</td>";
                    $html .= "<td>".$row->fecha_vencimiento."</td>";
                    $html .= "<td>".$row->nombre_banco."</td>";
                    $html .= "<td>".$row->descripcion."</td>";
                    $html .= "<td align='center'><a class='btn btn-default btn-circle' href='".base_url()."index.php/retiro_controller/vista_detalle/".$row->id_Boleta."'><i class='fa fa-eye'></i></a></td>";
                    $html .= "</tr>\n";
                }
                $html .= "</tbody>";
                $data['retiro'] = $html;
                
                return $data;
    }
    
    public function vista_detalle($id){
        
       $row = $this->retiro_model->BuscarBoleta($id);
       $hoy = date("Y-m-d");
       $clase = "";
       $vence = "";
       if ($row) {
           
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
           
           
            $id_boleta = $row->id_Boleta;
            $numero_boleta = $row->numero_boleta;
            $monto_boleta = "(".$row->codigo.") ".$row->monto_boleta;
            $fecha_recepcion = $this->recursos->FormatoFecha($row->fecha_recepcion);
            $fecha_emision = $this->recursos->FormatoFecha($row->fecha_emision);
            $fecha_vencimiento = $this->recursos->FormatoFecha($row->fecha_vencimiento);
            $denominacion = $row->denominacion;
            $rut = $this->recursos->DevuelveRut($row->rut);
            $nombre = $row->nombre;
            $nombre_banco = $row->nombre_banco;
            $tipo_garantia = $row->tipo_garantia;
            $descripcion_tipo_boleta = $row->descripcion_tipo_boleta;
            $estado_boleta = $row->estado_boleta;
            $tipo_boleta = $row->descripcion_tipo_boleta;
           
           $data = array(
                'id_Boleta'                 => $id_boleta,
                'numero_boleta'             => $numero_boleta,
                'monto_boleta'              => $monto_boleta,
                'fecha_recepcion'           => $fecha_recepcion,
                'fecha_emision'             => $fecha_emision,
                'fecha_vencimiento'         => $fecha_vencimiento,
                'denominacion'              => $denominacion,
                'rut'                       => $rut,
                'nombre'                    => $nombre,
                'nombre_banco'              => $nombre_banco,
                'tipo_garantia'             => $tipo_garantia,
                'descripcion_tipo_boleta'   => $descripcion_tipo_boleta,
                'estado_boleta'             => $estado_boleta,
                'vence'                     => $vence,
                'tipo_boleta'               => $tipo_boleta,
                'clase'                     => $clase
           );
           
            $this->load->view('plantilla');
            $this->load->view('cabecera');
            $this->load->view('retiro/retiro_detalle', $data);
            $this->load->view('footer');
           
       } 
    }
}