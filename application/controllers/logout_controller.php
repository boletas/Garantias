<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
    }
    public function Cerrar_Sesion(){
        //borrar datos cache
        $this->RemoveCache();
        //para destruir los datos de sesion
        $this->session->sess_destroy();
        redirect(base_url(),'refresh');
    }
    public function RemoveCache(){
        $this->db->cache_delete_all();
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
    }
}