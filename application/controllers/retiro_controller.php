<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retiro_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('retiro_model');
    }
    
    public function BuscarRetiro(){
        
        $rut = $this->input->post('rut_buscar');
        $num = $this->input->post('num_buscar');
        
        if (empty($rut) && empty($num)){
            
            $this->session->set_flashdata('error', 'No puede enviar datos vacios');
            redirect(base_url()."?sec=retiro_boleta",'refresh');
            
        }elseif (!empty($rut) && !empty($num)) {
            
            
            
           $query = $this->retiro_model->BuscarRutNum($rut,$num);
           
           if($query){
               $html = "";
                $c = 0;
                $html .= "<tbody>\n";
                foreach ($query as $row) {
                    $html .= "<tr><td>".++$c."</td>";
                    $html .= "<td>".$row->rut."</td>";
                    $html .= "<td>".$row->nombre."</td>";
                    $html .= "<td>".$row->numero_boleta."</td>";
                    $html .= "<td>".$row->monto_boleta."</td>";
                    $html .= "<td>".$row->fecha_recepcion."</td>";
                    $html .= "<td>".$row->fecha_emision."</td>";
                    $html .= "<td>".$row->fecha_vencimiento."</td>";
                    $html .= "<td>".$row->nombre_banco."</td>";
                    $html .= "<td>".$row->descripcion."</td>";
                    $html .= "</tr>\n";
                }
                $html .= "</tbody>";
                $data['retiro'] = $html;
                $this->vista_retiro($data);
                
           }else{
               $this->session->set_flashdata('error', 'No existen boletas con rut y numero especificado');
               redirect(base_url()."?sec=retiro_boleta",'refresh');
           }
            
        }elseif (empty($rut) && !empty($num)) {
            
            
            $query = $this->retiro_model->BuscarXNum($num);
           
           if($query){
               $html = "";
                $c = 0;
                $html .= "<tbody>\n";
                foreach ($query as $row) {
                    $html .= "<tr><td>".++$c."</td>";
                    $html .= "<td>".$row->rut."</td>";
                    $html .= "<td>".$row->nombre."</td>";
                    $html .= "<td>".$row->numero_boleta."</td>";
                    $html .= "<td>".$row->monto_boleta."</td>";
                    $html .= "<td>".$row->fecha_recepcion."</td>";
                    $html .= "<td>".$row->fecha_emision."</td>";
                    $html .= "<td>".$row->fecha_vencimiento."</td>";
                    $html .= "<td>".$row->nombre_banco."</td>";
                    $html .= "<td>".$row->descripcion."</td>";
                    $html .= "</tr>\n";
                }
                $html .= "</tbody>";
                
                $data['retiro'] = $html;
                $this->vista_retiro($data);
                
           }else{
               $this->session->set_flashdata('error', 'No existen boletas con numero especificado');
               redirect(base_url()."?sec=retiro_boleta",'refresh');
           }
            
            
            
        }elseif (!empty($rut) && empty($num)) {
            
            $query = $this->retiro_model->BuscarXRut($rut);
           
           if($query){
               $html = "";
                $c = 0;
                $html .= "<tbody>\n";
                foreach ($query as $row) {
                    $html .= "<tr><td>".++$c."</td>";
                    $html .= "<td>".$row->rut."</td>";
                    $html .= "<td>".$row->nombre."</td>";
                    $html .= "<td>".$row->numero_boleta."</td>";
                    $html .= "<td>".$row->monto_boleta."</td>";
                    $html .= "<td>".$row->fecha_recepcion."</td>";
                    $html .= "<td>".$row->fecha_emision."</td>";
                    $html .= "<td>".$row->fecha_vencimiento."</td>";
                    $html .= "<td>".$row->nombre_banco."</td>";
                    $html .= "<td>".$row->descripcion."</td>";
                    $html .= "</tr>\n";
                }
                $html .= "</tbody>";
                
                $data['retiro'] = $html;
                $this->vista_retiro($data);
                
           }else{
               $this->session->set_flashdata('error', 'No existen boletas con rut especificado');
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
}