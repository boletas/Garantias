<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Mantenedor extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('banco_model');
        $this->load->model('entidad_model');
        $this->load->model('tipoBoletas_model');
        $this->load->model('garantia_model');
        $this->load->model('moneda_model');
    }
    
    public function ObtieneBancos(){
        
        $data = $this->banco_model->ObtieneBancos();
        if(!empty($data)){
            if ($data){
                return $data;
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
    
    
    
    
}