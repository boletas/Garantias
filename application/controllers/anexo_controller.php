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
            
            $query = $this->anexo_model->InsertAnexo($idBoleta,$fecha_vencimiento,$monto, 1);
            
            if($query){
                $this->session->set_userdata('mensaje_anexo','Anexo insertado correctamente..');
                $this->SelectBoleta($idBoleta);
            }else{
                $this->session->set_userdata('mensaje_anexo','Error al insertar..');
                $this->SelectBoleta($idBoleta);
            }
            
            
        }

        
        public function SelectBoleta($idBoleta){

           $data['boleta'] = $this->TraerBoleta($idBoleta);
           $data['anexo'] = $this->TraerAnexo($idBoleta);
           $this->vista_anexo($data);   

	}
        
        
        public function TraerAnexo($idBoleta){
            
            $query = $this->anexo_model->TraerAnexo($idBoleta);
            $html = "";
            $cont = 0;
            
            
            foreach ($query as $row) {
                
                $cont = $cont+1;
                
                
                $html .="<div class='panel panel-default'>";

                $html .="<div class='panel-heading'>";
                $html .="<h4 class='panel-title'>";
                $html .="<a data-toggle='collapse' data-parent='#accordion' href='#".$cont."'>Anexo ".$cont."</a>";
                $html .="</h4>";
                $html .="</div>"; //panel-heading

                $html .="<div id='".$cont."' class='panel-collapse collapse'>";
                $html .="<div class='panel-body'>";

                $html .="<table class='table table-bordered table-hover'>";

                $html .="<tr>";
                $html .="<td class='active'>Fecha ingreso</td>";
                $html .="<td>".$this->recursos->FormatoFecha($row->fecha_registro)."</td>";
                $html .="</tr>";
                $html .="<tr>";
                $html .="<td class='active'>Monto anexo</td>";
                $html .="<td>".$row->monto_final."</td>";
                $html .="</tr>";
                $html .="<tr>";
                $html .="<td class='active'>Fecha final</td>";
                $html .="<td>".$this->recursos->FormatoFecha($row->fecha_final)."</td>";
                $html .="</tr>";

                $html .="</table>";
                
                $html .="</div>";//panel-body
                $html .="</div>";//colapse
                $html .="</div>";//panel panel-default
            }
            
            
                
            return $html;
            
        }

    public function TraerBoleta($idBoleta){

             $query = $this->anexo_model->TraerBoleta($idBoleta);
             $query2 = $this->anexo_model->TraerMontoAnexo($idBoleta);
            
           
            
            $html = "";
            $html .="<label>Razon social</label>";
            $html .="<div class='form-group'>";    
            $html .="<input type='text' class='form-control' disabled='true' value='".$query->nombre."'>";        
            $html .="</div>";

            $html .="<label>Numero boleta</label>";
            $html .="<div class='form-group'>";    
            $html .="<input type='text' class='form-control' disabled='true' value='".$query->numero_boleta."'>";        
            $html .="</div>";

            $html .="<label>Monto final boleta</label>";
            $html .="<div class='form-group input-group'>";
            $html .="<div class='input-group-addon'>".$query->codigo."</div>";
            if ($query2) {
                $html .="<input type='text' onkeypress='return ValidNum(this);' class='form-control' style='width: 200px;' name='monto' value='".$query2->monto_final."'>";             
            }else{
                $html .="<input type='text' onkeypress='return ValidNum(this);' class='form-control' style='width: 200px;' name='monto' value='".$query->monto_boleta."'>";             
            
            }
            $html .="</div>";
            $html .="<label>Fecha vencimiento</label>";
            $html .="<div id='sandbox-container' style='width: 200px;'>";
            $html .="<div class='input-group date'>";  
            if ($query2) {
                  $html .="<input type='text' onfocus='this.blur();''  class='form-control' name='fecha'  value='".$this->recursos->FormatoFecha($query2->fecha_final)."'><span class='input-group-addon'><i class='glyphicon glyphicon-th'></i></span>";
              }else{
                  $html .="<input type='text' onfocus='this.blur();''  class='form-control' name='fecha'  value='".$this->recursos->FormatoFecha($query->fecha_vencimiento)."'><span class='input-group-addon'><i class='glyphicon glyphicon-th'></i></span>";             
              }  
            
            $html .="</div>";
            $html .="</div>";

            $html .= "<input type='hidden' name='idBoleta' value='".$query->id_Boleta."'>";

            $html .= "<div class='form-group' style='text-align: right'>";
            $html .= "<a href='".base_url()."index.php/boleta_controller/VistaBoleta/$query->id_Boleta' class='btn btn-default'>Volver</a> ";
             
             if($query->idEstadoBoleta != 2){
                 $html .= "<input type='submit' onclick='return confirmar()' value='Guardar' class='btn btn-outline btn-primary'>";
             }

            $html .= "</div>";




         return $html;   
    }


    public function vista_anexo($data){

            $this->load->view('plantilla');
            $this->load->view('cabecera');
            $this->load->view('anexo/formulario_anexo', $data);
            $this->load->view('footer');

    }
}