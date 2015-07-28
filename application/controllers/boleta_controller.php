<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Boleta_controller extends MY_Mantenedor{
    
    function __construct() {
        parent::__construct();
        $this->load->model('boleta_model');
        $this->load->library('recursos');
        $this->load->library('session');
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
    
    public function Volver(){//da la funcion al boton volver
        $this->TodasBoletas();
    }
    
    public function insert_boleta(){

        $this->session->unset_userdata('rut_entidad_form');

        $idEntidad = $this->input->post('idEntidad');
        $num_boleta = $this->input->post('num_boleta');
        $monto_boleta = $this->input->post('monto_boleta');
        $idMoneda = $this->input->post('id_moneda');
        $fecha_recepcion = $this->recursos->FormatoFecha1($this->input->post('fecha_recepcion'));
        $fecha_emision = $this->recursos->FormatoFecha1($this->input->post('fecha_emision'));
        $fecha_vencimiento = $this->recursos->FormatoFecha1($this->input->post('fecha_vencimiento'));
        $denominacion = $this->input->post('denominacion');
        $idBanco = $this->input->post('id_banco');
        $idGarantia = $this->input->post('id_garantia');
        $idTipo = $this->input->post('id_tipo');
        $idEstado = 1;
        
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
    
    public function TodasBoletas(){//muestra la lista completa de las boletas en una tabla dinamica
        $data = $this->boleta_model->TodasBoletas();
        if($data){
            $hoy = date("Y-m-d");            
            $html = "";
            $html .= "<tbody>";
            foreach($data as $row){
                $clase = "";
                $vence = "";
                if($row->fecha_vencimiento < $hoy){
                    $calculo = $this->recursos->dias_transcurridos($row->fecha_vencimiento,$hoy);
                    if($calculo > 365){
                        $calculo = $calculo/365;
                        $vence = "Hace ".round($calculo)." años";
                    }else{
                        $vence = "Hace ".$calculo." días";
                    }
                }else{
                    $calculo = $this->recursos->dias_transcurridos($row->fecha_vencimiento,$hoy);
                    if($calculo > 365){
                        $calculo = $calculo/365;
                        $vence = "En ".round($calculo)." años";
                    }else{
                        if($calculo < 10){
                            $clase = " class = 'danger' ";
                        }else{
                            $clase = "";
                        }
                        
                        if($calculo == 0){
                            $vence = "Hoy";
                        }else{
                            $vence = "en ".$calculo." días";
                        }
                    }
                }
                $html .= "<tr".$clase."><td>".$row->numero_boleta."</td>";
                $html .= "<td>".$this->recursos->DevuelveRut($row->rut)."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_emision)."</td>";
                $html .= "<td>(".$row->codigo.") ".$row->monto_boleta."</td>";
                $html .= "<td>".$this->recursos->FormatoFecha($row->fecha_vencimiento)."</td>";
                $html .= "<td>".$vence."</td>";
                $html .= "<td align='center'>";
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Accion(1,".$row->id_Boleta.")'><i class='fa fa-eye'></i></button>&nbsp;";
                if($row->idEstadoBoleta != 2){
                $html .= "<button type='button' class='btn btn-default btn-circle' onclick='Accion(2,".$row->id_Boleta.")'><i class='fa fa-pencil'></i></button>&nbsp;";
                }
                $html .= "</td></tr>";
            }
            $html .= "</tbody>";
            
            $resultado = array('html' => $html);
            
            $this->load->view('plantilla');
            $this->load->view('cabecera');
            $this->load->view('busqueda/resultado_boleta', $resultado);
            $this->load->view('footer');
        }else{
            return false;
        }
    }
    
    public function BuscarBoleta($id_boleta){//busca la boleta segun el id entregado
        $data = $this->boleta_model->BuscarBoleta($id_boleta);
        if($data){
            $hoy = date("Y-m-d");  
            foreach($data as $row){
                $clase = "";
                $vence = "";
                if($row->fecha_vencimiento < $hoy){
                    $calculo = $this->recursos->dias_transcurridos($row->fecha_vencimiento,$hoy);
                    if($calculo > 365){
                        $calculo = $calculo/365;
                        $vence = "Hace ".round($calculo)." años";
                    }else{
                        $vence = "Hace ".$calculo." días";
                    }
                }else{
                    $calculo = $this->recursos->dias_transcurridos($row->fecha_vencimiento,$hoy);
                    if($calculo > 365){
                        $calculo = $calculo/365;
                        $vence = "En ".round($calculo)." años";
                    }else{
                        if($calculo < 10){
                            $clase = " class = 'danger' ";
                        }else{
                            $clase = "";
                        }
                        if($calculo == 0){
                            $vence = "Hoy";
                        }else{
                            $vence = "en ".$calculo." días";
                        }
                    }
                }


                if ($row->idEstadoBoleta == 2) {
                    $this->session->set_userdata('disable','disable');
                }


                $id_boleta = $row->id_Boleta;
                $numero_boleta = $row->numero_boleta;
                $monto_boleta = "(".$row->codigo.") ".$row->monto_boleta;
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
                'vence'                     => $vence,
                'tipo_boleta'               => $tipo_boleta,
                'clase'                     => $clase
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
                if($row->fecha_vencimiento < $hoy){
                    $calculo = $this->recursos->dias_transcurridos($row->fecha_vencimiento,$hoy);
                    if($calculo > 365){
                        $calculo = $calculo/365;
                        $vence = "Hace ".round($calculo)." años";
                    }else{
                        $vence = "Hace ".$calculo." días";
                    }
                }else{
                    $calculo = $this->recursos->dias_transcurridos($row->fecha_vencimiento,$hoy);
                    if($calculo > 365){
                        $calculo = $calculo/365;
                        $vence = "En ".round($calculo)." años";
                    }else{
                        if($calculo < 10){
                            $clase = " class = 'danger' ";
                        }else{
                            $clase = "";
                        }
                        
                        if($calculo == 0){
                            $vence = "Hoy";
                        }else{
                            $vence = "en ".$calculo." días";
                        }
                    }
                }


                

                $id_boleta = $row->id_Boleta;
                $numero_boleta = $row->numero_boleta;
                $monto_boleta = $row->monto_boleta;
                
                $codigo = "<select name='codigo' id='codigo' class='form-control' style='width: 100px'>";
                foreach($this->ObtieneMoneda() as $row1){
                    if($row1->idMoneda == $row->idMoneda){
                        $codigo .= "<option value='".$row1->idMoneda."' selected>".$row1->codigo."</option>";
                    }else{
                        $codigo .= "<option value='".$row1->idMoneda."'>".$row1->codigo."</option>";
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
                $nombre_banco = "<select name='banco' id='banco'  class='form-control'>";
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
                
                $estado_boleta = "<select name='estado_boleta' '  id='estado_boleta' class='form-control'>";
                foreach($this->ObtieneEstadoBoletas() as $row1){

                    if($row1->idEstadoBoleta == $row->idEstadoBoleta){
                        $estado_boleta .= "<option value='".$row1->idEstadoBoleta."' selected>".$row1->descripcion."</option>";
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
                    'numero_boleta'             => $numero_boleta,
                    'monto_boleta'              => $monto_boleta,
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
                    'vence'                     => $vence,
                    'clase'                     => $clase
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
        $monto = trim($this->input->post('monto'));
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
            //$this->VistaModificaBoleta($id_boleta);
        }else{
            $mensaje = array('boleta_error'   => 'Ocurrió un error al tratar de modificar la boleta.');
            $this->session->set_userdata($mensaje);
            $this->TodasBoletas();
            //$this->VistaModificaBoleta($id_boleta);
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