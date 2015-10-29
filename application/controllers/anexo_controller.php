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
                $this->load->model('boleta_model');
		$this->load->library('recursos');
                

	}
        
        public function InsertarAnexo(){
            
            $idBoleta = $this->input->post('idBoleta');
            $fecha_vencimiento = $this->recursos->FormatoFecha1($this->input->post('fecha'));
            $monto = $this->recursos->Formato_monedas($this->input->post('monto'));
            
            $this->form_validation->set_rules('monto','monto de boleta','trim|required|callback_monto_check|xss_clean');
            
            if($this->form_validation->run() == FALSE){
                $this->session->set_userdata('mensaje_anexo','Monto ingresado es invalido');
                $this->SelectBoleta($idBoleta, 2);
            }else{
                $query = $this->anexo_model->InsertAnexo($idBoleta,$fecha_vencimiento,$monto, 1);
                
                if($query){
                    $this->session->set_userdata('mensaje_anexo','Anexo insertado correctamente..');
                    $this->SelectBoleta($idBoleta, 2);
                }else{
                    $this->session->set_userdata('mensaje_anexo','Error al insertar..');
                    $this->SelectBoleta($idBoleta, 2);
                } 
            }
            
        }
        
        function monto_check($monto){ //funcion para validacion del campo monto_boleta. FORM VALIDATION
            if(preg_match("/^[0-9.,]+$/",$monto)){
                return TRUE;
            }else{
                $this->form_validation->set_message('monto_check','El campo %s debe ser numerico');
                return false;
            }
        }

        
        public function SelectBoleta($idBoleta,$op){

           $data['boleta'] = $this->TraerBoleta($idBoleta,$op);
           $data['anexo'] = $this->TraerAnexo($idBoleta);
           $this->vista_anexo($data);   

	}
        
        
        //METODO NUEVOOOOOOOOOOO
        public function editar_anexo($id){
            
            $query = $this->anexo_model->AnexoId($id);
            
            $arr = array(
                'id_anexo'      => $query->idAnexoBoleta,
                'monto_anexo'   => $query->monto_final,
                'fecha_anexo'   => $query->fecha_final,
                'fecha_registro'=> $query->feha_registro
            );
            
            echo json_decode($arr);
            
        }
        
        public function TraerAnexo($idBoleta){
            
            $query = $this->anexo_model->TraerAnexo($idBoleta);
            $html = "";
            $cont = 0;
            $data = $this->boleta_model->BuscarBoleta($idBoleta);
        
            if($data){
                foreach($data as $row){
                    $tmoneda = $row->codigo;
                }
            }
            
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
                if($tmoneda=="USD"){$html .= "<td>".$tmoneda." ".number_format($row->monto_final,2,',','.')."</td>";}
                if($tmoneda=="CLP"){$html .= "<td>".$tmoneda." ".number_format($row->monto_final,0,',','.')."</td>";}
                if($tmoneda=="U.F."){$html .= "<td>".$tmoneda." ".number_format($row->monto_final,2,',','.')."</td>";}
                if($tmoneda=="EUR"){$html .= "<td>".$tmoneda." ".number_format($row->monto_final,2,',','.')."</td>";}
                $html .="</tr>";
                $html .="<tr>";
                $html .="<td class='active'>Fecha final</td>";
                $html .="<td>".$this->recursos->FormatoFecha($row->fecha_final)."</td>";
                $html .="</tr>";
                $html .= "<tr>";
                // ACAAAAAAAAAAAAAAAAAAAA
                $html .= '<td colspan="2"><a class="btn btn-primary" href="javascript:void()" title="editar" onclick="edit_anexo('."'".$row->idAnexoBoleta."'".')">Editar</a></td>';
                // ACAAAAAAAAAAAAAAAAAA
                $html .= "</tr>";
                $html .="</table>";
                
                $html .="</div>";//panel-body
                $html .="</div>";//colapse
                $html .="</div>";//panel panel-default
            }
            
            
                
            return $html;
            
        }

    public function TraerBoleta($idBoleta, $op){

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
                if($query->codigo=="USD"){$html .= "<input type='text' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".number_format($query2->monto_final,2,',','.')."'>";}
                if($query->codigo=="CLP"){$html .= "<input type='text' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".number_format($query2->monto_final,0,',','.')."'>";}
                if($query->codigo=="U.F."){$html .= "<input type='text' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".number_format($query2->monto_final,2,',','.')."'>";}
                if($query->codigo=="EUR"){$html .= "<input type='text' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".number_format($query2->monto_final,2,',','.')."'>";}
                
            }else{
                if($query->codigo=="USD"){$html .= "<input type='text' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".number_format($query->monto_boleta,2,',','.')."'>";}
                if($query->codigo=="CLP"){$html .= "<input type='text' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".number_format($query->monto_boleta,0,',','.')."'>";}
                if($query->codigo=="U.F."){$html .= "<input type='text' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".number_format($query->monto_boleta,2,',','.')."'>";}
                if($query->codigo=="EUR"){$html .= "<input type='text' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".number_format($query->monto_boleta,2,',','.')."'>";}
            
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
            if($op == 1){
                $html .= "<a href='".base_url()."index.php/boleta_controller/VistaModificaBoleta/$query->id_Boleta' class='btn btn-default'>Volver</a> ";
            }else{
            $html .= "<a href='".base_url()."index.php/boleta_controller/VistaBoleta/$query->id_Boleta' class='btn btn-default'>Volver</a> ";
            }
             if($query->idEstadoBoleta == 1){
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