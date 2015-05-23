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
                
                $query = $this->reportes_model->GeneraReportes($fecha, $vence, 3, 1);
                
                if($query){
                    echo 'si';
                }else{
                    echo 'no';
                }
                
                
                break;
            case 2://rut entidad
                $rut = $this->recursos->FormatoRut($this->input->post("rut"));
                $query = $this->reportes_model->GeneraReportes($fecha, $vence, 1, $rut);
                
                
                if($query){
                    echo 'si';
                }else{
                    echo 'no';
                }
                
                break;
            case 3://tipo boleta
                $tipo = $this->input->post("tipo");
                $query = $this->reportes_model->GeneraReportes($fecha, $vence, 2, $tipo);
                
                if($query){
                    echo 'si';
                }else{
                    echo 'no';
                }
                break;
        }       
    }
}

?>