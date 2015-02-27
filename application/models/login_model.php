<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login_user($username,$password)
    {

        $query = $this->db->query("CALL select_user('$username','$password')");
        
        if ($query->num_rows > 0)
        {
            
            return $query->row();

        }else{
         
            $this->session->set_flashdata('usuario_incorrecto','Usuario o contraseña incorrecto');
            redirect('login_controller');
        }
    }
}