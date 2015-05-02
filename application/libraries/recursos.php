<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recursos{
    
    function DevuelveRut($_rol){
        while($_rol[0] == "0") {
            $_rol = substr($_rol, 1);
        }
        $factor = 2;
        $suma = 0;
        for($i = strlen($_rol) - 1; $i >= 0; $i--) {
            $suma += $factor * $_rol[$i];
            $factor = $factor % 7 == 0 ? 2 : $factor + 1;
        }
        $dv = 11 - $suma % 11;
        $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
        return $_rol . "-" . $dv;
    }
    
    function ValidaRutDiv($rute) {
        $c=strrpos($rute,'-');
        $rut = substr($rute,0,$c);
        $dv = substr($rute,$c+1);
        if (revisarut($rut) <> strtoupper($dv)) {
            return (0);
        } else {
            return ($rut);
        }
        return (0);
    }
    
    function dias_transcurridos($fecha_i,$fecha_f){
        $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
    }
    
    function FormatoFecha($fecha){
        return date("d-m-Y", strtotime($fecha));
    }
}
