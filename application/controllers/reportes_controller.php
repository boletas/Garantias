<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Reportes_Controller extends MY_Mantenedor{
    
    function __construct() {
        parent::__construct();
        $this->load->model('boleta_model');
        $this->load->library('recursos');
        $this->load->model('reportes_model');
    }
  
    public function index(){
        
    }
    
    public function Buscador(){
        
        $tipo_boleta = "<select name='tipo' id='tipo' class='form-control' style='display: none;'>";
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
    
    public function GeneraReportes($fecha,$fecha1,$vence,$periodo,$rut,$tipo,$busqueda){
        switch ($busqueda){
            case 1://todas las boletas
                $data = $this->reportes_model->GeneraReportes($fecha, $fecha1, $vence, 3, 1, $periodo);
                break;
            case 2://rut entidad
                $data = $this->reportes_model->GeneraReportes($fecha, $fecha1, $vence, 1, $rut, $periodo);
                break;
            case 3://tipo boleta
                $data = $this->reportes_model->GeneraReportes($fecha, $fecha1, $vence, 2, $tipo, $periodo);
                break;
        }
        
        $html = "";
        $total = 0;
        foreach ($data as $row){
            $monto = $this->ObtieneMonto($row->idMoneda, $row->monto_boleta);
            $total = $total + $monto;
            $html .= "<tr>";
            $html .= "<td width='120px'>".$row->numero_boleta."</td>\n";
            $html .= "<td width='120px'>".$this->recursos->DevuelveRut($row->rut)."</td>\n";
            $html .= "<td width='120px'>".$this->recursos->FormatoFecha($row->fecha_emision)."</td>\n";
            $html .= "<td width='120px'>".$this->recursos->FormatoFecha($row->fecha_vencimiento)."</td>\n";
            $html .= "<td width='120px'>".$row->descripcion_tipo_boleta."</td>\n";
            $html .= "<td>".$row->codigo."</td>\n";
            $html .= "<td>".$row->monto_boleta."</td>\n";
            $html .= "<td align='right'>".$this->recursos->Formato1($monto)."</td>\n";
            $html .= "</tr>\n";
        }
        
        $datos = array( 'fecha'     => $fecha, 
                        'vence'     => $vence, 
                        'periodo'   => $periodo,
                        'tipo'      => $tipo,
                        'busqueda'  => $busqueda,
                        'rut'       => $rut,
                      );
        
        $total = $this->recursos->Formato1($total);
        $resultado['html'] = $html;
        $resultado['total'] = $total;
        $resultado['datos'] = $datos;
        
        return($resultado);
    }
    
    public function VistaReporte(){
        
        $busqueda = $this->input->post("tipo_busqueda");
        $rut = $this->recursos->FormatoRut($this->input->post("rut"));
        $tipo = $this->input->post("tipo");
        $periodo = $this->input->post("periodo");//1=todas ; 10;20;30;60;90 dias
        
        $vence = $this->input->post("vence");//1=vencidas ; 2=por_vencer ; 3=todas
        $fecha = date('Y-m-d');
        if($periodo > 1 && $vence == "vencidas"){
            $fecha = $this->recursos->sumaFechas("-".$periodo." day");
        }elseif($periodo > 1 && $vence == "por_vencer"){
            $fecha = $this->recursos->sumaFechas($periodo." day");   
        }elseif($periodo > 1 && $vence == "todas"){
            $fecha = $this->recursos->sumaFechas($periodo." day");
            $fecha1 = $this->recursos->sumaFechas("-".$periodo." day");
        }
        
        if($vence == "todas"){
            $vence1 = 3;
        }else if($vence == "vencidas"){
            $vence1 = 1;
        }else if($vence == "por_vercer"){
            $vence1 = 2;
        }
        
        $resultado = $this->GeneraReportes($fecha, $fecha1, $vence1, $periodo, $rut, $tipo, $busqueda);

        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('reportes/vista_reporte', $resultado);
        $this->load->view('footer');        
    }
    
    public function ExcelReporte($fecha,$vence,$periodo,$tipo = 0,$busqueda,$rut = 0){
        $resultado = $this->GeneraReportes($fecha, $vence, $periodo, $rut, $tipo, $busqueda);
        $this->load->view('reportes/excel_reporte', $resultado);
    }
}

?>