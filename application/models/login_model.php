<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login_user($username,$password){

        $query = $this->db->query("CALL valida_login('$username','$password')");
        
        if ($query->num_rows > 0){
            $this->db->close();
            return $query;
        }else{
            return null;
        }
    }
}