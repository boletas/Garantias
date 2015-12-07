<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Anexo_controller extends MY_Mantenedor{
    
    function __construct(){
        parent::__construct();
        $this->load->model('anexo_model');
        $this->load->model('boleta_model');
        $this->load->library('recursos');
        $this->check_login();
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
        
    public function ObtieneDatosAnexo(){
        $id_anexo = $this->input->post('id_anexo');
        
        $query = $this->anexo_model->AnexoId($id_anexo);
        $arr = array(
                        'id_anexo'      => $query->idAnexoBoleta,
                        'monto_anexo'   => $query->monto_final,
                        'fecha_anexo'   => $this->recursos->FormatoFecha($query->fecha_final)
                    );

        echo json_encode($arr);

    }
        
    public function TraerAnexo($idBoleta){

        $query = $this->anexo_model->TraerAnexo($idBoleta);
        $html = "";
        $cont = 0;
        $data = $this->boleta_model->BuscarBoleta($idBoleta);

        if($data){
            foreach($data as $row){
                $tmoneda = $row->codigo;
                $estado = $row->idEstadoBoleta;
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
            $html .= "<td>".$this->recursos->formateo_moneda($tmoneda,$row->monto_final)."</td>";
            $html .="</tr>";
            $html .="<tr>";
            $html .="<td class='active'>Fecha final</td>";
            $html .="<td>".$this->recursos->FormatoFecha($row->fecha_final)."</td>";
            $html .="</tr>";
            if($estado == 1){
                $html .= "<tr>";
                    $html .= '<td><button type="button" class="btn btn-outline btn-primary" title="editar" data-toggle="modal" data-target="#EditarModal" onclick="ObtieneDatosAnexo('.$row->idAnexoBoleta.')">Editar</button></td>';
                    $html .= '<form action="'. base_url().'/index.php/anexo_controller/deleteanexo" method="post">';
                    $html .= '<input type="hidden" name="id" value="'.$row->idAnexoBoleta.'" />';
                    $html .= '<input type="hidden" name="idboleta" value="'.$idBoleta.'" />';
                    $html .= '<td><input type="submit" onclick="return confirmarEliminar()" value="Eliminar" class="btn btn-outline btn-danger"/></td>';
                    $html .= '</form>';
                $html .= "</tr>";
            }
            
            $html .="</table>";
            $html .="</div>";//panel-body
            $html .="</div>";//colapse
            $html .="</div>";//panel panel-default
        }
        
        return $html;
    }
    
    
    public function deleteanexo(){
        $id = $this->input->post("id");
        $id_boleta = $this->input->post("idboleta");
        
        $query = $this->anexo_model->eliminar_anexo($id);
        
        if($query){
            $this->session->set_userdata('mensaje_anexo','Anexo eliminado correctamente..');
            $this->SelectBoleta($id_boleta, 2);
        }else{
            $this->session->set_userdata('mensaje_anexo','Error al eliminar anexo..');
            $this->SelectBoleta($id_boleta, 2);
        }
        
        
    }

    public function TraerBoleta($idBoleta, $op){

        $query = $this->anexo_model->TraerBoleta($idBoleta);
        $query2 = $this->anexo_model->TraerMontoAnexo($idBoleta);

        $html = "";
        $html .="<label>Razón social</label>";
        $html .="<div class='form-group'>";    
        $html .="<input type='text' class='form-control' disabled='true' value='".$query->nombre."'>";        
        $html .="</div>";

        $html .="<label>Número documento</label>";
        $html .="<div class='form-group'>";    
        $html .="<input type='text' class='form-control' disabled='true' value='".$query->numero_boleta."'>";        
        $html .="</div>";

        $html .="<label>Monto final documento</label>";
        $html .="<div class='form-group input-group'>";
        $html .="<div class='input-group-addon'>".$query->codigo."</div>";
        
        if ($query2) {
            $html .= "<input type='text' required='true' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".$this->recursos->formateo_moneda_dos($query->codigo,$query2->monto_final)."'>";
        }else{
            $html .= "<input type='text' required='true' onkeyup='format(this)' onchange='format(this)'  class='form-control' style='width: 200px;' name='monto' value='".$this->recursos->formateo_moneda_dos($query->codigo,$query->monto_boleta)."'>";
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

        $html .= "<input type='hidden' name='idBoleta' id='idBoleta' value='".$query->id_Boleta."'>";

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
    
    public function ActualizaAnexo(){
        $id_boleta = $this->input->post('id_boleta');
        $id_anexo = $this->input->post('id_anexo');
        $monto = $this->recursos->Formato_monedas($this->input->post('monto'));
        $fecha = $this->recursos->FormatoFecha1($this->input->post('fecha'));
        
        $query = $this->anexo_model->ActualizaAnexo($id_anexo,$monto,$fecha);
        if($query){
            $res =  true;
        }else{
            $res = false;
        }
        
        $respuesta = array('res' => $res);
        
        echo json_encode($respuesta);
    }


    public function vista_anexo($data){

        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('anexo/formulario_anexo', $data);
        $this->load->view('footer');

    }
}