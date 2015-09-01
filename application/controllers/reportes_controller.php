<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Reportes_Controller extends MY_Mantenedor{
    
    function __construct() {
        parent::__construct();
        $this->load->model('boleta_model');
        $this->load->library('recursos');
        $this->load->model('reportes_model');
        $this->load->model('indicadores_model');
        $this->load->model('anexo_model');
    }
  
    public function index(){
        
    }
    
    public function Buscador(){
        
        $tipo_boleta = "<select name='tipo' id='tipo' class='form-control' style='display: none;'>";
        $tipo_boleta .= "<option value='0'>--- Tipo ---</option>";
        foreach($this->ObtieneTipoBoletas() as $row){
            $tipo_boleta .= "<option value='".$row->idTipoBoleta."'>".$row->descripcion_tipo_boleta."</option>";
        }
        $tipo_boleta .= "</select>";
        
        $resultado = array('tipo_boleta' => $tipo_boleta);
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('reportes/reportes', $resultado);
        $this->load->view('footer');
    }
    
    public function GeneraReportes($fecha,$fecha1,$vence,$periodo,$rut,$tipo,$busqueda, $estado){
        
        $data = "";        
        switch ($busqueda){
            case 1://todas las boletas
                $data = $this->reportes_model->GeneraReportes($fecha, $fecha1, $vence, 3, 1, $periodo, $estado);
                break;
            case 2://rut entidad
                $data = $this->reportes_model->GeneraReportes($fecha, $fecha1, $vence, 1, $rut, $periodo, $estado);
                break;
            case 3://tipo boleta
                $data = $this->reportes_model->GeneraReportes($fecha, $fecha1, $vence, 2, $tipo, $periodo, $estado);
                break;
        }
        
        $html = "";
        $total = 0;
        foreach ($data as $row){
            $monto_anexo = 0;
            $anexo = $this->MontoAnexo($row->id_Boleta);
            $monto_anexo = ($anexo ? $anexo : false);
            
            $monto = $this->ObtieneMonto($row->idMoneda, ($monto_anexo ? $monto_anexo : $row->monto_boleta));
            $total = $total + $monto;
            
            $html .= "<tr>";
            $html .= "<td width='120px'>".$row->numero_boleta."</td>\n";
            $html .= "<td width='120px'>".$this->recursos->DevuelveRut($row->rut)."</td>\n";
            $html .= "<td width='120px'>".$this->recursos->FormatoFecha($row->fecha_emision)."</td>\n";
            $html .= "<td width='120px'>".$this->recursos->FormatoFecha($row->fecha_vencimiento)."</td>\n";
            $html .= "<td width='120px'>".$row->descripcion_tipo_boleta."</td>\n";
            $html .= "<td>".$row->codigo."</td>\n";
            $html .= "<td>".($monto_anexo ? $monto_anexo : $row->monto_boleta)."</td>\n";
            $html .= "<td align='right'>".$this->recursos->Formato1($monto)."</td>\n";
            $html .= "</tr>\n";
        }
        
        $datos = array( 'fecha'     => $fecha, 
                        'fecha1'    => $fecha1, 
                        'vence'     => $vence, 
                        'periodo'   => $periodo,
                        'tipo'      => $tipo,
                        'busqueda'  => $busqueda,
                        'rut'       => $rut,
                        'estado'    => $estado
                      );
        
        $total = $this->recursos->Formato1($total);
        $resultado['html'] = $html;
        $resultado['total'] = $total;
        $resultado['datos'] = $datos;

        return($resultado);
    }
    
    public function VistaReporte(){
        $valores = $this->indicadores_model->UltimoMonto();
        if(empty($valores)){
            redirect(base_url()."index.php/indicadores_controller/IngresoIndicadores", 'refresh');
        }
        
        $busqueda = $this->input->post("tipo_busqueda");
        $rut = $this->recursos->FormatoRut($this->input->post("rut"));
        $tipo = $this->input->post("tipo");
        $periodo = $this->input->post("periodo");//1=todas ; 10;20;30;60;90 dias
        $estado = $this->input->post("estado"); //0= todas, 1= custodia, 2= pendiente, 3= entregadas

        $vence = $this->input->post("vence");//1=vencidas ; 2=por_vencer ; 3=todas
        $fecha = date('Y-m-d');
        $fecha1 = "";
        if($periodo > 1 && $vence == "vencidas"){
            $fecha = $this->recursos->sumaFechas("-".$periodo." day");
        }elseif($periodo > 1 && $vence == "por_vencer"){
            $fecha = $this->recursos->sumaFechas($periodo." day");   
        }elseif($periodo > 1 && $vence == "todas"){
            $fecha = $this->recursos->sumaFechas($periodo." day");
            $fecha1 = $this->recursos->sumaFechas("-".$periodo." day");
        }

        $vence1 = 0;
        
        if($vence == "todas"){
            $vence1 = 3;
        }else if($vence == "vencidas"){
            $vence1 = 1;
        }else if($vence == "por_vencer"){
            $vence1 = 2;
        }
        
        $fecha = (!empty($fecha) ? $fecha : 0);
        $fecha1 = (!empty($fecha1) ? $fecha1 : 0);
        $vence1 = (!empty($vence1) ? $vence1 : 0);
        $periodo = (!empty($periodo) ? $periodo : 0);
        $rut = (!empty($rut) ? $rut : 0);
        $tipo = (!empty($tipo) ? $tipo : 0);
        $busqueda = (!empty($busqueda) ? $busqueda : 0);
        $estado = (!empty($estado) ? $estado : 0);
        
        $resultado = $this->GeneraReportes($fecha, $fecha1, $vence1, $periodo, $rut, $tipo, $busqueda, $estado);

        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('reportes/vista_reporte', $resultado);
        $this->load->view('footer');        
    }
    
    public function ExcelReporte($fecha, $fecha1, $vence, $periodo, $rut, $tipo, $busqueda, $estado){
        $resultado = $this->GeneraReportes($fecha, $fecha1, $vence, $periodo, $rut, $tipo, $busqueda, $estado);
        $this->load->view('reportes/excel_reporte', $resultado);
    }
    
    public function MontoAnexo($idBoleta){
        $data = $this->anexo_model->TraerMontoAnexo($idBoleta);
        if($data){
            return $data->monto_final;
        }else{
            return false;
        }
    }
}

?>