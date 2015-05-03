<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Boleta_controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('boleta_model');
        $this->load->library('recursos');
        
    }
    
    public function index(){
        $que = $this->input->post("que");
        if($que == 1){
            $this->TodasBoletas();
        }
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
    
    public function ResultadoBoletas(){
        $que = $this->input->post("que");
        $id_boleta = $this->input->post("id_boleta");
        
        if($que == 1){//detalle boleta
            $this->VistaBoleta($id_boleta);
        }
        if($que == 2){//editar boleta
            $this->VistaModificaBoleta($id_boleta);
        }
        if($que == 3){//pdf boleta
            
        }
    }
    
    public function VistaBoleta($id_boleta){
        $resultado = $this->BuscarBoleta($id_boleta);
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('busqueda/vista_boleta', $resultado);
        $this->load->view('footer');
    }
    
    public function VistaModificaBoleta($id_boleta){
        $resultado = $this->BuscarBoletaModifica($id_boleta);
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('busqueda/modifica_boleta', $resultado);
        $this->load->view('footer');
    }
    
    public function TodasBoletas(){
        $data = $this->boleta_model->TodasBoletas();
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
                        $vence = "en ".$calculo." días";
                    }
                }
                $html .= "<tr".$clase."><td>".$row->numero_boleta."</td>";
                $html .= "<td>".$this->recursos->DevuelveRut($row->rut)."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_emision)."</td>";
                $html .= "<td>(".$row->codigo.") ".$row->monto_boleta."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_vencimiento)."</td>";
                $html .= "<td>".$vence."</td>";
                $html .= "<td align='center'>";
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Accion(1,".$row->id_Boleta.")'><i class='fa fa-eye'></i></button>&nbsp;";
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Accion(2,".$row->id_Boleta.")'><i class='fa fa-pencil'></i></button>&nbsp;";
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Accion(3,".$row->id_Boleta.")'><i class='fa fa-file-pdf-o'></i></button>";
                $html .= "</td></tr>";
            }
            $html .= "</tbody>";
            
            $resultado = array('html' => $html);
            
            $this->load->view('plantilla');
            $this->load->view('cabecera');
            $this->load->view('busqueda/resultado_boleta', $resultado);
            $this->load->view('footer');
        }else{
            return false;
        }
    }
    
    public function BuscarBoleta($id_boleta){
        $data = $this->boleta_model->BuscarBoleta($id_boleta);
        if($data){
            $hoy = date("Y-m-d");  
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
                        $vence = "en ".$calculo." días";
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
            }
            
            $resultado = array(
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
                'clase'                     => $clase
                );
            
            return $resultado;  
        }else{
            return false;
        }
    }
    
    public function BuscarBoletaModifica($id_boleta){
        $data = $this->boleta_model->BuscarBoleta($id_boleta);
        if($data){
            $hoy = date("Y-m-d");  
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
                        $vence = "en ".$calculo." días";
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
            }
            
            $resultado = array(
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
                'clase'                     => $clase
                );
            
            return $resultado;  
        }else{
            return false;
        }
    }
}