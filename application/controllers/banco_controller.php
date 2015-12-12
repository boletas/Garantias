<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banco_Controller extends MY_Mantenedor {
    public function __construct(){
        parent::__construct();
        $this->load->model('banco_model');
        $this->load->library('session');
        $this->check_login();
    }
    
    public function Index(){        
        $que = $this->input->post("crud");
        if(!$que){
            $data['bancos'] = $this->ObtieneBancos();
            $this->load->view('plantilla');
            $this->load->view('cabecera');
            $this->load->view('banco/banco',$data);
            $this->load->view('footer');
        }else{
            $que = $this->input->post("crud");
            if($que == "nuevo"){
                redirect(base_url()."index.php/plantilla_controller/?sec=nuevo_banco",'refresh');
            }

            if($que == "editar"){
                $idBanco = $this->input->post("cual");
                $this->DevuelveBanco($idBanco);
            }

            if($que == "eliminar"){
                $idBanco = $this->input->post("cual");
                $this->EliminaBanco($idBanco);
            }
        }
    }
    
    public function DevuelveBanco($idBanco){
        $data = $this->banco_model->DevuelveBanco($idBanco);
        foreach($data as $row){
            $idBanco = $row->idBanco;
            $nombre_banco = $row->nombre_banco;
        }
        $banco = array(
            'idBanco'   => $idBanco,
            'banco'     => $nombre_banco
        );
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('banco/edita_banco',$banco);
        $this->load->view('footer');
    }
    
    public function NuevoBanco(){
        $banco = $this->input->post("nombre_banco");
        
        $data = $this->banco_model->ExisteBanco($banco);
        if($data){
            $this->session->set_flashdata('error', 'Ya existe un banco con el nombre indicado');
            redirect(base_url()."index.php/plantilla_controller/?sec=nuevo_banco",'refresh');
        }else{
            $data = $this->banco_model->NuevoBanco($banco);
            if($data){
                $this->session->set_userdata('banco_ok', 'El banco fue guardado correctamente');
            }else{
                $this->session->set_flashdata('error', 'Ocurrió un problema al tratar de guardar el banco');
            }
            $this->Index();
        }
    }
    
    public function ModificaBanco(){
        $idBanco = $this->input->post("idBanco");
        $banco = $this->input->post("nombre_banco");
        $data = $this->banco_model->ModificaBanco($banco, $idBanco);
        if($data){
            $this->session->set_userdata('banco_ok', 'El banco fue actualizado correctamente');
        }else{
            $this->session->set_flashdata('error', 'Ocurrió un problema al tratar de modificar el banco');
        }
        $this->Index();
    }
    
    public function EliminaBanco($idBanco){
        $data = $this->banco_model->EliminaBanco($idBanco);
        if($data){
            $this->session->set_userdata('banco_ok','El registro fue eliminado correctamente');
            redirect(base_url()."index.php/plantilla_controller/?sec=banco",'refresh');
        }else{
            $this->session->set_userdata('banco_error','Ocurrió un problema al eliminar el registro');
            redirect(base_url()."index.php/plantilla_controller/?sec=banco",'refresh');
        }
    }
    
    public function ObtieneBancos(){
        $data = $this->banco_model->ObtieneBancos();
        $html = "";
        if(!empty($data)){
            if ($data){
                $c = 0;
                $html .= "<tbody>\n";
                foreach ($data as $row) {
                    $html .= "<tr><td width='150px'>".++$c."</td>";
                    $html .= "<td>".$row->nombre_banco."</td>";
                    $html .= "<td style='text-align: center;' width='150px'>";
                    $html .= "<button type='button' value='$row->idBanco' name='editar_banco' class='btn btn-default btn-circle' Onclick=\"Accion('editar',$row->idBanco)\"><i class='fa fa-pencil'></i></button>&nbsp;";
                    $html .= "<button type='button' value='$row->idBanco' name='nuevo_banco' id='nuevo_banco' class='btn btn-default btn-circle' Onclick=\"Accion('nuevo')\"><i class='fa fa-plus'></i></button>&nbsp;";
                    $html .= "</td>";
                    $html .= "</tr>\n";
                }
                $html .= "</tbody>";
            }
        }else{
            $html['mensaje'] = "Actualmente no existen bancos en la base de datos";
        }
        return $html;
    }
}
