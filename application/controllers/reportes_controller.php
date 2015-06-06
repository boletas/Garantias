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
    
    public function GeneraReportes($fecha,$vence,$periodo,$rut,$tipo,$busqueda){
        switch ($busqueda){
            case 1://todas las boletas
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 3, 1);
                break;
            case 2://rut entidad
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 1, $rut);
                break;
            case 3://tipo boleta
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 2, $tipo);
                break;
        }
        
        $html = "";
        $total = 0;
        foreach ($data as $row){
            $monto = $this->ObtieneMonto($row->idMoneda, $row->monto_boleta);
            $total = $total + $monto;
            $html .= "<tr>";
            $html .= "<td width='150px'>".$row->numero_boleta."</td>\n";
            $html .= "<td width='120px'>".$this->recursos->DevuelveRut($row->rut)."</td>\n";
            $html .= "<td width='450px'>".$row->nombre."</td>\n";
            $html .= "<td width='120px'>".$row->descripcion_tipo_boleta."</td>\n";
            $html .= "<td align='right'>".$this->recursos->Formato1($monto)."</td>\n";
            $html .= "<tr>\n";
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
        
        $vence = $this->input->post("vence");//1=vencidas ; 2=por_vencer
        
        $fecha = date_create(date("Y-m-d"));
//      
        if($periodo > 1 && $vence == "vencidas"){
            $fecha = date_sub($fecha, date_interval_create_from_date_string(''.$periodo.' days'));
        }elseif($periodo > 1 && $vence == "por_vencer"){
            $fecha = date_add($fecha, date_interval_create_from_date_string(''.$periodo.' days'));
        }
        
        ($vence == "vencidas" ? $vence1 = 1 : $vence1 = 2);
        //($vence == "vencidas" ? $fecha = date_sub($fecha, date_interval_create_from_date_string(''.$periodo.' days')) : $fecha = date_add($fecha, date_interval_create_from_date_string(''.$periodo.' days')));
        
        $fecha = date_format($fecha, 'Y-m-d');
        
        
        $resultado = $this->GeneraReportes($fecha, $vence1, $periodo, $rut, $tipo, $busqueda);

        
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