<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Boleta_controller extends MY_Mantenedor{
    
    function __construct() {
        parent::__construct();
        $this->load->model('boleta_model');
        $this->load->library('recursos');
        $this->load->library('session');
        $this->load->model('anexo_model');
    }

    public function ResultadoBoletas(){//obtiene los valores del resultado de boletas
        if($this->input->post("que") != ""){
            $que = $this->input->post("que");
            $id_boleta = $this->input->post("id_boleta");

            if($que == 1){//detalle boleta
                $this->VistaBoleta($id_boleta);
                $cual = array('cual'  =>  $que);
                $this->session->set_userdata($cual);
            }
            if($que == 2){//editar boleta
                $this->VistaModificaBoleta($id_boleta);
            }
           
        }
    }
    
    public function Volver(){//funcion al boton volver
        $this->TodasBoletas();
    }
    
    public function insert_boleta(){

        $this->session->unset_userdata('rut_entidad_form');

        $idEntidad = $this->input->post('idEntidad');
        $num_boleta = $this->input->post('num_boleta');
        $idMoneda = $this->input->post('id_moneda');
        $monto_boleta = $this->recursos->Formato_monedas($this->input->post('monto_boleta'));        
        $fecha_recepcion = $this->recursos->FormatoFecha1($this->input->post('fecha_recepcion'));
        $fecha_emision = $this->recursos->FormatoFecha1($this->input->post('fecha_emision'));
        $fecha_vencimiento = $this->recursos->FormatoFecha1($this->input->post('fecha_vencimiento'));
        $denominacion = $this->input->post('denominacion');
        $idBanco = $this->input->post('id_banco');
        $idGarantia = $this->input->post('id_garantia');
        $idTipo = $this->input->post('id_tipo');
        $idEstado = 1;
        
        $this->form_validation->set_rules('num_boleta', 'numero de boleta','trim|required|min_length[1]|xss_clean');
        $this->form_validation->set_rules('monto_boleta','monto de boleta','trim|required|callback_monto_check|xss_clean');
        $this->form_validation->set_rules('denominacion','denominacion estudio','trim|required|min_length[1]|xss_clean');
        
        $this->form_validation->set_message('required','El campo %s es obligatorio');
        $this->form_validation->set_message('numeric','El campo %s debe ser numerico');
        
        
        if($this->form_validation->run() == FALSE){
            $data['entidad'] = $this->TraerEntidad($this->session->userdata('idEntidad'));
            $data['bancos'] = $this->ObtieneBancos();
            $data['monedas'] = $this->ObtieneMoneda();
            $data['garantias'] = $this->ObtieneTipoGarantia();
            $data['tipos'] = $this->ObtieneTipoBoletas();

            $this->load->view('plantilla');
            $this->load->view('cabecera');
            $this->load->view('ingreso/ingreso_form', $data);
            $this->load->view('footer');
        }else{
            $insertok = $this->boleta_model->insert_boleta(
                    $num_boleta,
                    $monto_boleta,
                    $fecha_recepcion,
                    $fecha_emision,
                    $fecha_vencimiento,
                    $denominacion,
                    $idEntidad,
                    $idBanco,
                    $idMoneda,
                    $idGarantia,
                    $idTipo,
                    $idEstado);
            if($insertok){
                $this->session->set_flashdata('insert','Boleta ingresada correctamente.');
                redirect(base_url()."?sec=nueva_boleta",'refresh');
            }else{
                $this->session->set_flashdata('insert','Error al ingresar boleta.');
                redirect(base_url()."?sec=nueva_boleta",'refresh');
                
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
    
    public function VistaBoleta($id_boleta){//obtiene el detalle de la boleta y lo presenta en una vista
        $resultado = $this->BuscarBoleta($id_boleta);
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('busqueda/vista_boleta', $resultado);
        $this->load->view('footer');
    }
    
    public function VistaModificaBoleta($id_boleta){//obtiene los valores de la boleta y los muestra para la editar
        $resultado = $this->BuscarBoletaModifica($id_boleta);
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('busqueda/modifica_boleta', $resultado);
        $this->load->view('footer');
    }
    
    
    public function VistaAnexos($id_boleta){
        $resultado['anexos'] = $this->BuscarAnexos($id_boleta);
        $data = $this->boleta_model->BuscarBoleta($id_boleta);
        
        if($data){
            foreach($data as $row){
                $resultado['numero_boleta'] = $row->numero_boleta;
                $resultado['tipo_moneda'] = $row->codigo;        
            }
        }
        
        $this->load->view('plantilla');
        $this->load->view('anexo/lista_anexos', $resultado);
        $this->load->view('footer');
        
        
    }

    public function BuscarAnexos($id_boleta){
        $query = $this->anexo_model->TraerAnexo($id_boleta);
        $html = "";
        $cont = 0; 
        $tmoneda = "";
        $data = $this->boleta_model->BuscarBoleta($id_boleta);
        
        if($data){
            foreach($data as $row){
                $tmoneda = $row->codigo;
            }
        }
        
        if($query){
            foreach ($query as $row) {
            $cont++;
            $html .="<div class='col-lg-6'>";
                $html .="<div class='panel'>";
                    $html .="<div class='panel-heading'>";
                            $html .="<h4 class='panel-title'>";
                            $html .="Anexo N° ".$cont."";
                            $html .="</h4>";
                    $html .="</div>";
                        $html .="<div class='panel-body'>";
                            $html .="<table class='table table-bordered table-hover'>";
                                $html .= "<tr>";
                                    $html .= "<td class='active'>Fecha ingreso Anexo</td>";
                                    $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_registro)."</td>";
                                $html .= "</tr>";
                                $html .= "<tr>";
                                    $html .= "<td class='active'>Monto anexo</td>";
                                    $html .= "<td>".$this->recursos->formateo_moneda($tmoneda,$row->monto_final)."</td>";
                                $html .= "</tr>";
                                $html .= "<tr>";
                                    $html .= "<td class='active'>Fecha anexo</td>";
                                    $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_final)."</td>";
                                $html .= "</tr>";
                            $html .= "</table>";
                        $html .= "</div>"; //panel-body
                $html .="</div>"; //panel
            $html .="</div>"; //col-lg-6
            }
        }
        
        return $html;
    }

    public function TodasBoletas(){//muestra la lista completa de las boletas en una tabla dinamica
        $data = $this->boleta_model->TodasBoletas();
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
                $html .= "<td>".$this->recursos->formateo_moneda($row->codigo,$monto_boleta)."</td>";
                $html .= "<td align='center'>";
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Accion(1,".$row->id_Boleta.")'><i class='fa fa-eye'></i></button>&nbsp;";
                $html .= "<button type='button' ".($row->idEstadoBoleta == 2 ? " disabled " : "")." class='btn btn-default btn-circle' onclick='Accion(2,".$row->id_Boleta.")'><i class='fa fa-pencil'></i></button>&nbsp;";
                $html .= "<a class='btn btn-default btn-circle' ".(!$anexo ? "disabled" : "")." target='_blanc' href='".base_url()."index.php/boleta_controller/VistaAnexos/$row->id_Boleta'><i>A</i></a>&nbsp;";
                $html .= "</td></tr>";
            }
            $html .= "</tbody>";
            $resultado['html'] = $html;
        }else{
            $resultado['mensaje'] = "Actualmente no existen boletas en la base de datos";
        }
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('busqueda/resultado_boleta', $resultado);
        $this->load->view('footer');
    }
    
    public function BuscarBoleta($id_boleta){//busca la boleta segun el id entregado
        $data = $this->boleta_model->BuscarBoleta($id_boleta);
        if($data){
            $hoy = date("Y-m-d");  
            foreach($data as $row){
                $clase = "";
                $vence = "";
                
                $v = $this->recursos->VenceEn($row->fecha_vencimiento);
                
                $id_boleta = $row->id_Boleta;
                $numero_boleta = $row->numero_boleta;
                $monto_boleta = $this->recursos->formateo_moneda($row->codigo,$row->monto_boleta);
                $fecha_recepcion = $this->recursos->FormatoFecha($row->fecha_recepcion);
                $fecha_emision = $this->recursos->FormatoFecha($row->fecha_emision);
                $fecha_vencimiento = $this->recursos->FormatoFecha($row->fecha_vencimiento);
                $denominacion = $row->denominacion;
                $rut = $this->recursos->DevuelveRut($row->rut);
                $nombre = $row->nombre;
                $nombre_banco = $row->nombre_banco;
                $tipo_garantia = $row->tipo_garantia;
                $descripcion_tipo_boleta = $row->descripcion_tipo_boleta;
                $estado_boleta = $row->estado_boleta;
                $tipo_boleta = $row->descripcion_tipo_boleta;
                $id_estado_boleta = $row->idEstadoBoleta;
            }
            
            $resultado = array(
                'id_Boleta'                 => $id_boleta,
                'numero_boleta'             => $numero_boleta,
                'monto_boleta'              => $monto_boleta,
                'fecha_recepcion'           => $fecha_recepcion,
                'fecha_emision'             => $fecha_emision,
                'fecha_vencimiento'         => $fecha_vencimiento,
                'denominacion'              => $denominacion,
                'rut'                       => $rut,
                'nombre'                    => $nombre,
                'nombre_banco'              => $nombre_banco,
                'tipo_garantia'             => $tipo_garantia,
                'descripcion_tipo_boleta'   => $descripcion_tipo_boleta,
                'estado_boleta'             => $estado_boleta,
                'vence'                     => $v['vence'],
                'tipo_boleta'               => $tipo_boleta,
                'clase'                     => $v['clase'],
                'idEstadoBoleta'            => $id_estado_boleta
                );
            
            return $resultado;  
        }else{
            return false;
        }
    }
    
    public function BuscarBoletaModifica($id_boleta){//busca la boleta y prepara el metodo para editar
        $data = $this->boleta_model->BuscarBoleta($id_boleta);
        if($data){
            $hoy = date("Y-m-d");  
            foreach($data as $row){
                $clase = "";
                $vence = "";
                
                $v = $this->recursos->VenceEn($row->fecha_vencimiento);

                $id_boleta = $row->id_Boleta;
                $numero_boleta = $row->numero_boleta;
                $monto_boleta = $row->monto_boleta;
                $tipo_moneda = "";
                
                $codigo = "<select name='codigo' id='codigo' class='form-control' style='width: 100px'>";
                foreach($this->ObtieneMoneda() as $row1){
                    if($row1->idMoneda == $row->idMoneda){
                        $codigo .= "<option value='".$row1->idMoneda."' selected>".$row1->codigo."</option>";
                        $tipo_moneda = $row1->codigo;
                    }else{
                        $codigo .= "<option value='".$row1->idMoneda."'>".$row1->codigo."</option>";
                        $tipo_moneda = $row1->codigo;
                    }
                }
                $codigo .= "</select>";
                $monto_boleta = $row->monto_boleta;
                
                
                $fecha_recepcion = $this->recursos->FormatoFecha($row->fecha_recepcion);
                $fecha_emision = $this->recursos->FormatoFecha($row->fecha_emision);
                $fecha_vencimiento = $this->recursos->FormatoFecha($row->fecha_vencimiento);
                $denominacion = $row->denominacion;
                
                $rut = '<select name="rut" id="rut" class="form-control" onchange="CambiaRazon(this.value);">';
                foreach($this->TodasEntidades() as $row1){
                    if($row1->idEntidad == $row->idEntidad){
                        $rut .= '<option value='.$row1->idEntidad.' selected>'.$this->recursos->DevuelveRut($row1->rut).'</option>';
                    }else{
                        $rut .= '<option value='.$row1->idEntidad.'>'.$this->recursos->DevuelveRut($row1->rut).'</option>';
                    }
                }
                $rut .= '</select>';
                
                $nombre = $row->nombre;
                $nombre_banco = "<select name='banco' id='banco' class='form-control'>";
                foreach($this->ObtieneBancos() as $row1){
                    if($row1->idBanco == $row->idBanco){
                        $nombre_banco .= "<option value='".$row1->idBanco."' selected>".$row1->nombre_banco."</option>";
                    }else{
                        $nombre_banco .= "<option value='".$row1->idBanco."'>".$row1->nombre_banco."</option>";
                    }
                }
                $nombre_banco .= "</select>";
                
                $tipo_garantia = "<select name='tipo_garantia'  id='tipo_garantia' class='form-control'>";
                foreach($this->ObtieneTipoGarantia() as $row1){
                    if($row1->idTipoGarantia == $row->idTipoGarantia){
                        $tipo_garantia .= "<option value='".$row1->idTipoGarantia."' selected>".$row1->descripcion."</option>";
                    }else{
                        $tipo_garantia .= "<option value='".$row1->idTipoGarantia."'>".$row1->descripcion."</option>";
                    }
                }
                $tipo_garantia .= "</select>";
                
                $descripcion_tipo_boleta = $row->descripcion_tipo_boleta;
                $id_estado_boleta = 0;
                $estado_boleta = "<select name='estado_boleta' '  id='estado_boleta' class='form-control'>";
                foreach($this->ObtieneEstadoBoletas() as $row1){

                    if($row1->idEstadoBoleta == $row->idEstadoBoleta){
                        $estado_boleta .= "<option value='".$row1->idEstadoBoleta."' selected>".$row1->descripcion."</option>";
                        $id_estado_boleta = $row1->idEstadoBoleta;
                    }else{
                        $estado_boleta .= "<option value='".$row1->idEstadoBoleta."'>".$row1->descripcion."</option>";
                    }

                    
                }
                $estado_boleta .= "</select>";
                
                $tipo_boleta = "<select name='tipo_boleta'  id='tipo_boleta' class='form-control'>";
                foreach($this->ObtieneTipoBoletas() as $row1){
                    if($row1->idTipoBoleta == $row->idTipoBoleta){
                        $tipo_boleta .= "<option value='".$row1->idTipoBoleta."' selected>".$row1->descripcion_tipo_boleta."</option>";
                    }else{
                        $tipo_boleta .= "<option value='".$row1->idTipoBoleta."'>".$row1->descripcion_tipo_boleta."</option>";
                    }
                }
                $tipo_boleta .= "</select>";
            }
            
            $resultado = array(
                    'id_Boleta'                 => $id_boleta,
                    'idEstadoBoleta'            => $id_estado_boleta,
                    'numero_boleta'             => $numero_boleta,
                    'monto_boleta'              => $this->recursos->formateo_moneda_dos($tipo_moneda,$monto_boleta),
                    'codigo'                    => $codigo,
                    'fecha_recepcion'           => $fecha_recepcion,
                    'fecha_emision'             => $fecha_emision,
                    'fecha_vencimiento'         => $fecha_vencimiento,
                    'denominacion'              => $denominacion,
                    'rut'                       => $rut,
                    'nombre'                    => $nombre,
                    'nombre_banco'              => $nombre_banco,
                    'tipo_garantia'             => $tipo_garantia,
                    'descripcion_tipo_boleta'   => $descripcion_tipo_boleta,
                    'estado_boleta'             => $estado_boleta,
                    'tipo_boleta'               => $tipo_boleta,
                    'vence'                     => $v['vence'],
                    'clase'                     => $v['clase']
                );
            return $resultado;  
        }else{
            return false;
        }
    }
    
    public function ModificaBoleta(){//metodo para la edicion de la boleta
        $id_boleta = $this->input->post('id_boleta');
        $idEntidad = $this->input->post('rut');
        $numero_boleta = trim($this->input->post('numero_boleta'));
        $estado_boleta = $this->input->post('estado_boleta');
        $recepcion = $this->recursos->FormatoFecha1($this->input->post('recepcion'));
        $emision = $this->recursos->FormatoFecha1($this->input->post('emision'));
        $vencimiento = $this->recursos->FormatoFecha1($this->input->post('vencimiento'));
        $tipo_garantia = $this->input->post('tipo_garantia');
        $denominacion = trim($this->input->post('denominacion'));
        $banco = $this->input->post('banco');
        $codigo = $this->input->post('codigo');
        $monto = $this->recursos->Formato_monedas($this->input->post('monto'));
        $tipo_boleta = $this->input->post('tipo_boleta');
        
        $datos_boleta = array(
                'id_boleta'         => $id_boleta,
                'idEntidad'         => $idEntidad,
                'numero_boleta'     => $numero_boleta,
                'estado_boleta'     => $estado_boleta,
                'recepcion'         => $recepcion,
                'emision'           => $emision,
                'vencimiento'       => $vencimiento,
                'tipo_garantia'     => $tipo_garantia,
                'denominacion'      => $denominacion,
                'banco'             => $banco,
                'codigo'            => $codigo,
                'monto'             => $monto,
                'tipo_boleta'       => $tipo_boleta
                );
        $data = $this->boleta_model->ModificaBoleta($datos_boleta);
        if($data){
            $mensaje = array('boleta_ok'   => 'La boleta fue modificada exitosamente.');
            $this->session->set_userdata($mensaje);
            $this->TodasBoletas();
        }else{
            $mensaje = array('boleta_error'   => 'Ocurrió un error al tratar de modificar la boleta.');
            $this->session->set_userdata($mensaje);
            $this->TodasBoletas();
        }
    }
    
    public function TodasEntidades(){
        $data = $this->boleta_model->TodasEntidades();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
        
    //llamada desde AJAX
    public function EntidadxId(){
        $idEntidad = $this->input->post('idEntidad');
        $data = $this->boleta_model->EntidadxId($idEntidad);
        if($data){
            foreach($data as $row){
                $html = $row->nombre;
            }
        }
        $respuesta = array('html' => $html);
        echo json_encode($respuesta);
    }
}