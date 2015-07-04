<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indicadores_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('plantilla');
        $this->load->view('cabecera');
        $this->load->view('indicadores/indicadores');
        $this->load->view('footer');
    }
    
    public function DevuelveBanco($idBanco){
        $data = $this->banco_model->DevuelveBanco($idBanco);
        foreach($data as $row){
            $idBanco = $row->idBanco;
            $nombre_banco = $row->nombre_banco;
        }
        $banco = array(
            'idBanco'   => $idBanco,
            'banco'     => $nombre_banco
        );
        $this->session->set_userdata($banco);
        redirect(base_url()."?sec=edita_banco",'refresh');
    }
}