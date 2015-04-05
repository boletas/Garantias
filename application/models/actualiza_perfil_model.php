<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualiza_Perfil_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function Actualiza_Usuario($usuario){
        
        $query = $this->db->query("CALL pa_actualiza_usuario ('".$usuario['idUsuario']."','".$usuario['nombre']."','".$usuario['ap_paterno']."','".$usuario['ap_materno']."')");
        if ($query){
            $this->db->close();
            return $query;
        }else{
            return null;
        }
    }
    
    public function Actualiza_Login($login){
        
        $query = $this->db->query("CALL pa_actualiza_login('".$login['idPerfil']."','".$login['nombre_usuario']."','".$login['pass_usuario_dos']."')");
        if ($query){
            $this->db->close();
            return $query;
        }else{
            return null;
        }
    }
}