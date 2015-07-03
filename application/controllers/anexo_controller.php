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




	public function AgregarAnexo($idBoleta, $Nombre, $MontoBoleta, $FechaBoleta){

		$id_boleta = $idBoleta;
		$monto_boleta = $MontoBoleta;
		$fecha_boleta = $FechaBoleta; //Fecha vencimiento
		$nombre = $Nombre;

		$data = array(
			'id' => $id_boleta,
			'razon' => $nombre,
			'fecha_vencimiento' => $fecha_boleta,
			'monto' => $monto_boleta 
			);
		

		






		$this->load->view('plantilla');
        $this->load->view('cabecera');
		$this->load->view('anexo/formulario_anexo', $data);
		$this->load->view('footer');

	}	
}