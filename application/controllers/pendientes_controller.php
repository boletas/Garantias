<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendientes_Controller extends MY_Mantenedor{
    public function __construct(){
        parent::__construct();
        $this->load->library('recursos');
        $this->load->model('pendientes_model');
        $this->load->model('anexo_model');
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
                $html .= "<td>".$this->recursos->FormatoFecha($fecha_vencimiento)."</td>";
                $html .= "<td>".$row->descripcion_tipo_boleta."</td>";
                $html .= "<td>".$v['vence']."</td>";
                $html .= "<td>(".$row->codigo.") ".$monto_boleta."</td>";
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
        $fecha_retiro = $this->recursos->FormatoFecha1($this->input->post("fecha_retiro"));
        $data = $this->pendientes_model->GuardarRetiro($idBoleta,$rut,$nombre,$apellido,$fecha_retiro);
        if($data){
            $mensaje = array('ok'   => 'El estado de la boleta fue cambiado correctamente.');
            $this->session->set_userdata($mensaje);
        }else{
            $mensaje = array('error'   => 'Ocurrio un problema al tratar de cambiar el estado de la boleta.');
            $this->session->set_userdata($mensaje);
        }
        $this->ListaPendientes();
    }
    
    //llamada desde AJAX
    public function PersonaRetiro(){
        $rut = $this->recursos->FormatoRut($this->input->post('rut'));
        $data = $this->pendientes_model->PersonaRetiro($rut);
        if($data){
            foreach($data as $row){
                $nombre = $row->nombre_retiro;
                $apellido = $row->ap_retiro;
            }
        }else{
            $nombre = "";
            $apellido = "";
        }
        $respuesta = array( 'nombre'    => $nombre,
                            'apellido'  => $apellido
                            );
        echo json_encode($respuesta);
    }
}