<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function GeneraReportes($fecha, $fecha1, $opcion, $tipo, $valor, $periodo, $estado){
        
        
        //Fecha = Fecha calculada para buscar vencidas o por vencer
        //Opcion = Si se busca boletas vencidas o por vencer
        //Tipo = Tipo de busqueda. Por rut o por tipo de boleta
        //Valor = que puede ser el rut o el tipo de boleta
        
        $query = $this->db->query("CALL pa_reportes('".$fecha."','".$opcion."','".$tipo."','".$valor."','".$periodo."','".$fecha1."','".$estado."')");
        
        if($query){
            $data = $query->result();
            $query->free_result();
            $this->db->close();
            return $data;
        }else{
            $query->free_result();
            $this->db->close();
            return FALSE;
        }
        
    }
}
