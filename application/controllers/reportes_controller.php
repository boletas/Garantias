<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Reportes_Controller extends MY_Mantenedor{
    
    function __construct() {
        parent::__construct();
        $this->load->model('boleta_model');
        $this->load->library('recursos');
        $this->load->model('reportes_model');
    }
  
    public function index(){
        $this->Buscador();
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
    
    public function GeneraReportes(){
        $fecha = "";
        $vence = $this->input->post("vence");//1=vencidas ; 2=por_vencer
        if($vence == "vencidas"){$vence=1;}else{$vence=2;}
        $periodo = $this->input->post("periodo");//1=todas ; 10;20;30;60;90 dias
        ($vence == "vencidas" ? $fecha = strtotime('-'.$periodo.' day',strtotime(date('Y-m-d'))) : $fecha = strtotime('+'.$periodo.' day',strtotime(date('Y-m-d'))));
        
        $fecha = date('Y-m-d',$fecha);
        
        switch ($this->input->post("tipo_busqueda")){
            case 1://todas las boletas
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 3, 1);
                break;
            case 2://rut entidad
                $rut = $this->recursos->FormatoRut($this->input->post("rut"));
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 1, $rut);
                break;
            case 3://tipo boleta
                $tipo = $this->input->post("tipo");
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 2, $tipo);
                break;
        }
        
        $html = "";
        $total = 0;
        foreach ($data as $row){
            $monto = $this->ObtieneMonto($row->idMoneda, $row->monto_boleta);
            $total = $total + $monto;
            $html .= "<tr>";
            $html .= "<td width='150px'>".$row->numero_boleta."</td>";
            $html .= "<td width='120px'>".$this->recursos->DevuelveRut($row->rut)."</td>";
            $html .= "<td width='450px'>".$row->nombre."</td>";
            $html .= "<td width='120px'>".$row->descripcion_tipo_boleta."</td>";
            $html .= "<td align='right'>".$this->recursos->Formato1($monto)."</td>";
            $html .= "<tr>";
        }
        $total = $this->recursos->Formato1($total);
        $resultado = array('html' => $html, 'total' => $total);
        
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('reportes/vista_reporte', $resultado);
        $this->load->view('footer');
    }
}

?>