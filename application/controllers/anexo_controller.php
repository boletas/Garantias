<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

/**
* 
*/
class Anexo_controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('anexo_model');
		$this->load->library('recursos');

	}
        
        public function InsertarAnexo(){
            
            $idBoleta = $this->input->post('idBoleta');
            $fecha_vencimiento = $this->recursos->FormatoFecha1($this->input->post('fecha'));
            $monto = $this->input->post('monto');
            
            $query = $this->anexo_model->InsertAnexo($idBoleta,$fecha_vencimiento,$monto);
            
            if($query){
                
                $this->session->flashdata('mensaje','Anexo insertado correctamente..');
            }else{
                $this->session->flashdata('mensaje','Error al insertar..');
            }
            
            
        }

        
        public function SelectAnexo($idBoleta){

           $data = $this->TraerBoleta($idBoleta);

           $this->vista_anexo($data);   

	   }	

    public function TraerBoleta($idBoleta){

         $query = $this->anexo_model->TraerBoleta($idBoleta);

            $data = array(
                    'id' => $query->id_Boleta,
                    'razon' => $query->nombre,
                    'fecha_vencimiento' => $this->recursos->FormatoFecha($query->fecha_vencimiento),
                    'monto' => $query->monto_boleta,
                    'numero_boleta'      => $query->numero_boleta
                    );

         return $data;   
    }


    public function vista_anexo($data){

            $this->load->view('plantilla');
            $this->load->view('cabecera');
            $this->load->view('anexo/formulario_anexo', $data);
            $this->load->view('footer');

    }
}