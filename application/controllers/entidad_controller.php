<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entidad_controller extends MY_Mantenedor{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('entidad_model');
        $this->load->library('recursos');
        
    }
    
    public function insert_entidad(){
        
        $rut_entidad = $this->recursos->FormatoRut($this->input->post('rut_entidad'));
        $rut = $rut_entidad;
        $nombre_entidad = $this->input->post('nombre_entidad');
        
        $rut_entidad = $this->entidad_model->EntidadExiste($rut);
        
        
        if($rut_entidad){
            $this->session->set_flashdata('insert','¡¡Esta entidad ya existe!!');
             
            redirect(base_url()."?sec=nueva_boleta",'refresh');
        }else{
            
            $insertok = $this->entidad_model->insert_entidad($rut,$nombre_entidad);
            
            if ($insertok) {
                
                $data = $this->entidad_model->GetEntidad($rut);
                $this->session->set_userdata('idEntidad',$data->idEntidad);
                
                redirect(base_url()."?sec=ingreso_form",'refresh');
            }else{
                $this->session->set_flashdata('insert','Error al guardar entidad');
                redirect(base_url()."?sec=nueva_boleta",'refresh');
            }
        }
        
    }
    
    public function entidades(){
        $query= $this->entidad_model->Entidades();
        if($query){
                $html = "";
                $html .= "<tbody>";
                foreach ($query as $row) {
                    $html .= "<tr>";
                    $html .= "<td>".$this->recursos->DevuelveRut($row->rut)."</td>";
                    $html .= "<td>".$row->nombre."</td>";
                    $html .= "<td><a class='btn btn-default btn-circle' href='".base_url()."index.php/entidad_controller/modificar_entidad/".$row->idEntidad."'><i class='fa fa-pencil'></i></a></td>";
                    $html .= "</tr>";
                }
                $html .= "</tbody>";
                $data['entidad'] = $html;
                $this->vista_entidad($data);
           }
    }
    
    public function modificar_entidad($id){
        $query = $this->entidad_model->TraerEntidad($id);
        $html = "";
        foreach ($query as $entidad) {
            $html = "<tr>";
            $html .= "<td><b>Rut</b></td>";
            $html .= "<td><input class='form-control' type='text' name='rut' id='rut' value='".$entidad->rut."'></td>";
            $html .= "</tr>";
            $html .= "<tr>";
            $html .= "<td><b>Razon social</b></td>";
            $html .= "<td><input class='form-control' type='text' name='nombre_entidad' value='".$entidad->nombre."'></td>";
            $html .= "</tr>";
            $html .= "<tr>";
            $html .= "<td>&nbsp;</td>";
            $html .= "<input type='hidden' name='idEntidad' value='".$entidad->idEntidad."'>";
            $html .= "<td><a class='btn btn-default btn-outline' href='".base_url()."index.php/entidad_controller/entidades'>Volver</a><button class='btn btn-primary btn-outline ' type='submit'>Actualizar</button></td>";
            $html .= "</tr>";
            
        }
        $data['modificar'] = $html;
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('entidad/modificar', $data);
        $this->load->view('footer');
        
    }
    
    public function actualizar(){
        
        $rut = explode('-', $this->input->post("rut"));
        $entidad = $this->input->post("nombre_entidad");
        $id = $this->input->post("idEntidad");
        
        $query = $this->entidad_model->actualizar_entidad($rut[0], $entidad, $id);
        
        if ($query) {
                $this->session->set_flashdata('error','¡Entidad actualizada!');
                redirect(base_url()."index.php/entidad_controller/entidades",'refresh');
            }else{
                $this->session->set_flashdata('error','Error al actualizar');
                redirect(base_url()."index.php/entidad_controller/entidades",'refresh');
            }
        
    }

    

    //Muestra la lista de todas las entidades
    public function vista_entidad($data){
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('entidad/entidad_vista', $data);
        $this->load->view('footer');
    }

    public function buscar_entidad(){
        $rut = explode('-', $this->input->post('rut_buscar'));
        
        $rut_entidad = $this->entidad_model->EntidadExiste($rut[0]);
        
        if($rut_entidad){
            
            $this->session->set_userdata('idEntidad',$rut_entidad->idEntidad);
            redirect(base_url()."?sec=ingreso_form",'refresh');
        }else{
            
            $this->session->set_flashdata('insert','No existe entidad con el rut ingresado.');
            $this->session->set_flashdata('op','si');
            redirect(base_url()."?sec=nueva_boleta",'refresh');
            
        }
    }
}