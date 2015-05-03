<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boleta_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function insert_boleta($num_boleta,
                    $monto_boleta,
                    $fecha_recepcion,
                    $fecha_emision,
                    $fecha_vencimiento,
                    $denominacion,
                    $idEntidad,
                    $idBanco,
                    $idMoneda,
                    $idGarantia,
                    $idTipo,
                    $idEstado){
        
        $query = $this->db->query("CALL pa_boleta('".$num_boleta."',"
                . "'".$monto_boleta."',"
                . "'".$fecha_recepcion."',"
                . "'".$fecha_emision."',"
                . "'".$fecha_vencimiento."',"
                . "'".$idEntidad."',"
                . "'".$idBanco."',"
                . "'".$idMoneda."',"
                . "'".$idGarantia."',"
                . "'".$idTipo."',"
                . "'".$idEstado."',"
                . "1,"
                . "0,"
                . "'".$denominacion."')");
                
        if($query){

            $query->free_result();
            $this->db->close();
            return TRUE;
        }else{

            $query->free_result();
            $this->db->close();
            return FALSE;
        }         
    }
    
    public function TodasBoletas(){
        $query = $this->db->query("CALL pa_boleta ('','','','','','','','','','','','2','0','')");
        if ($query){
            $data = $query->result();
            $query->free_result();
            $this->db->close();
            return $data;
        }else{
            $query->free_result();
            $this->db->close();
            return null;
        }
    }
    
    public function  BuscarBoleta($id_boleta){
        $query = $this->db->query("CALL pa_boleta ('','','','','','','','','','','','2','".$id_boleta."','')");
        if ($query){
            $data = $query->result();
            $query->free_result();
            $this->db->close();
            return $data;
        }else{
            $query->free_result();
            $this->db->close();
            return null;
        }
    }
    
    public function  BuscarBoletaModifica($id_boleta){
        $query = $this->db->query("CALL pa_boleta ('','','','','','','','','','','','2','".$id_boleta."','')");
        if ($query){
            $data = $query->result();
            $query->free_result();
            $this->db->close();
            return $data;
        }else{
            $query->free_result();
            $this->db->close();
            return null;
        }
    }
}
