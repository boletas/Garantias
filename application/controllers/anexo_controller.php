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

	}




	public function AgregarAnexo($idBoleta){

		$query = $this->anexo_model->TraerBoleta($idBoleta);

		$data = array(
			'id' => $query->id_Boleta,
			'razon' => $query->nombre,
			'fecha_vencimiento' => $query->fecha_vencimiento,
			'monto' => $query->monto_boleta 
			);

		$this->load->view('plantilla');
        $this->load->view('cabecera');
		$this->load->view('anexo/formulario_anexo', $data);
		$this->load->view('footer');

	}	
}