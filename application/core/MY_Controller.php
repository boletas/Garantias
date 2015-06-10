<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Mantenedor extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('banco_model');
        $this->load->model('entidad_model');
        $this->load->model('tipoBoletas_model');
        $this->load->model('garantia_model');
        $this->load->model('moneda_model');
        $this->load->model('estadoBoleta_model');
        $this->load->model('ultimo_monto_model');
        
        $this->load->library('recursos');
    }
    
    public function ObtieneBancos(){
        $data = $this->banco_model->ObtieneBancos();
        if(!empty($data)){
            if ($data){
                return $data;
            }
        }
    }
    
    public function ObtieneStringBancos(){
        $data = $this->banco_model->ObtieneBancos();
        if(!empty($data)){
            if ($data){
                $html = "";
                $c = 0;
                $html .= "<tbody>\n";
                foreach ($data as $row) {
                    $html .= "<tr><td>".++$c."</td>";
                    $html .= "<td>".$row->nombre_banco."</td>";
                    $html .= "<td style='text-align: center;'><button type='button' value='$row->idBanco' name='editar_banco' class='btn btn-outline btn-primary btn-xs' Onclick=\"Accion('editar',$row->idBanco)\">Editar</button></td>";
                    $html .= "</tr>\n";
                }
                $html .= "</tbody>";
                return $html;
            }
        }
    }
    
    public function TraerEntidad($id){
        $data = $this->entidad_model->TraerEntidad($id);
        if(!empty($data)){
            if ($data){
                return $data;
            }
        }
    }
    
    public function ObtieneMoneda(){
        $data = $this->moneda_model->ObtieneMoneda();
        if(!empty($data)){
            if ($data){
                return $data;
            }
        }
    }
    
    public function ObtieneTipoGarantia(){
        $data = $this->garantia_model->ObtieneGarantias();
        if(!empty($data)){
            if ($data){
                return $data;
            }
        }
    }
    
    public function ObtieneTipoBoletas(){
        $data = $this->tipoBoletas_model->ObtieneTipoBoletas();
        if(!empty($data)){
            if ($data){
                return $data;
            }
        }
    }
    
    public function ObtieneEstadoBoletas(){
        $data = $this->estadoBoleta_model->ObtieneEstadoBoletas();
        if(!empty($data)){
            if ($data){
                return $data;
            }
        }
    }
    
    public function ObtieneUltimoIngreso(){
        $data = $this->ultimo_monto_model->ObtieneUltimoIngreso();
        if(!empty($data)){
            if ($data){
                return $data;
            }
        }
    }
    
    public function ObtieneMonto($cual,$cuanto){
        foreach($this->ObtieneUltimoIngreso() as $row => $monto){
            if($row == 0){
                $fecha_costo = $monto->fecha_costo;
                $e_uf = $monto->e_uf."<br>";
                $e_dolar = $monto->e_dolar;
                $e_euro = $monto->e_euro;
            }
        }
        
        switch ($cual){
            case 1://CLP
                $total = $cuanto; 
                break;
            case 2://USD
                $total = $cuanto * $e_dolar; 
                break;
            case 3://U.F.
                $total = $cuanto * $e_uf;
                break;
            case 4://EUR
                $total = $cuanto * $e_euro; 
                break;
        }
        return $total;
    }
}