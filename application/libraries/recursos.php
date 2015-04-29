<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recursos{
    
    function DevuelveRut(){
        
    }
    
    function interval_date($init,$finish){
        //formateamos las fechas a segundos tipo 1374998435
        $diferencia = strtotime($finish) - strtotime($init);
        
        if(!is_numeric($diferencia) || $diferencia<0){
            $tiempo = "Error";
        }else{
            //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
            //floor devuelve el número entero anterior, si es 5.7 devuelve 5
            if($diferencia < 60){
                $tiempo = "Hace " . floor($diferencia) . " segundos";
            }else if($diferencia < 3600){
                $tiempo = "Hace " . floor($diferencia/60) . " minutos'";
            }else if($diferencia < 86400){
                $tiempo = "Hace " . floor($diferencia/3600) . " horas";
            }else if($diferencia < 2592000){
                $tiempo = "Hace " . floor($diferencia/86400) . " días";
            }else if($diferencia > 31104000){
                $tiempo = "Hace " . floor($diferencia/31104000) . " años";
            }else{
                $tiempo = "Error";
            }
            return $tiempo;
        }
    }
    
}
