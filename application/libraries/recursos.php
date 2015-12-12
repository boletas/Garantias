<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recursos{
    
    function DevuelveRut($_rol){
        if($_rol == ""){
            return 0;
        }        
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
        $dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias = abs($dias); $dias = floor($dias);		
	return $dias;
    }
    
    function FormatoFecha($fecha){
        return date("d-m-Y", strtotime($fecha));
    }
    
    function FormatoFecha1($fecha){
        return date("Y-m-d", strtotime($fecha));
    }
    
    function FormatoFecha2($fecha){
        // Está funcion toma una fecha con formato 2004/12/01 y la devuelve en formato 01/Dic/2004 
        $ano = substr($fecha, 0, 4);
        $mes = substr($fecha, 5, 2);
        $dia = substr($fecha, 8, 2);

        if ($mes=="01") $mes="Enero";
        elseif ($mes=="02") $mes="Febrero";
        elseif ($mes=="03") $mes="Marzo";
        elseif ($mes=="04") $mes="Abril";
        elseif ($mes=="05") $mes="Mayo";
        elseif ($mes=="06") $mes="Junio";
        elseif ($mes=="07") $mes="Julio";
        elseif ($mes=="08") $mes="Agosto";
        elseif ($mes=="09") $mes="Septiembre";
        elseif ($mes=="10") $mes="Octubre";
        elseif ($mes=="11") $mes="Noviembre";
        elseif ($mes=="12") $mes="Diciembre";
        else $mes="--";
        $fecha = ($mes."-".$dia."-".$ano);
        return $fecha;
    }
    
    function EstadoRed($url){
        $f = @fopen($url,'r');
        if($f !== false){
            return true;
        }else{
            return false;
        }
    }
    
    /*function Indicadores(){
        $xmlSource = "http://indicadoresdeldia.cl/webservice/indicadores.xml";
        $estado = $this->EstadoRed($xmlSource);
        if($estado){
            return (simplexml_load_file($xmlSource));
        }else{
            return false;
        }
    }*/
    
    function Indicadores(){
        $url = "http://mindicador.cl/api";
        $estado = $this->EstadoRed($url);
        if($estado){
            if(ini_get('allow_url_fopen')){
                $json = file_get_contents($url);
            }else{
                $curl = curl_init($url);
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                $json = curl_exec($curl);
                curl_close($curl);
            }
            $indicadores = json_decode($json);
            $indica['euro'] = $this->FormatoMoneda($indicadores->euro->valor);
            $indica['uf'] = $this->FormatoMoneda($indicadores->uf->valor);
            $indica['dolar'] = $this->FormatoMoneda($indicadores->dolar->valor);
            $indica['utm'] = $this->FormatoMoneda($indicadores->utm->valor);
            return $indica;
        }else{
            return false;
        }
    }
    
    function FormatoRut($rut1){
        $rut1 = explode("-", $rut1);
        $rut = $rut1[0];
        return ($rut);
    }
    
    function UltimoDiaMes(){
        $anio = date('Y');
        $mes = date('m');
        $fecha = date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));
        $fecha = $fecha."-".$mes."-".$anio;
        return ($fecha);
    }
    
    function PrimerDiaMes() {
        $month = date('m');
        $year = date('Y');
        return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
    }
    
    function IngresoIndicadores(){
        //$fecha = $this->sumaFechas2('-9 day');
        $fecha = $this->sumaFechas2('9 day');
        $fecha_ant = $this->sumaFechas('0 day');
        $fecha_pos = $this->sumaFechas('10 day');
        
        if($fecha >= $fecha_ant && $fecha <= $fecha_pos){
            return 1;
        }else{
            return 1;
        }
    }
    
    function Formato1($val){//formatea el monto de las monedas
        return number_format($val,0,",",".");
    }
    
    function sumaFechas($suma,$fechaInicial = false){
      $fecha = !empty($fechaInicial) ? $fechaInicial : date('Y-m-d');
      $nuevaFecha = date('Y-m-d',strtotime ($suma,strtotime($fecha)));
      return ($nuevaFecha);
    }
    
    function sumaFechas2($suma,$fechaInicial = false){
      $fecha = $this->PrimerDiaMes();
      $nuevaFecha = date('Y-m-d',strtotime ($suma,strtotime($fecha)));
      return ($nuevaFecha);
    }
    
    function FormatoMoneda($valor){
        return number_format((float)$valor,2,",",".");
    }
    
    function FormatoMonedaMySQL($valor){
        $valor = str_replace(".","",$valor);
        $valor = str_replace(",",".",$valor);
        return $valor;
    }
    
    function Formato_monedas($valor){
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        
        return $valor;
    }
    
    function formateo_moneda($codigo, $monto){
        if($codigo == "USD"){
            return "(".$codigo.") ".number_format($monto,2,',','.');
        }elseif ($codigo == "CLP") {
            return "(".$codigo.") ".number_format($monto,0,',','.');
        }elseif ($codigo == "U.F.") {
            return "(".$codigo.") ".number_format($monto,2,',','.');
        }elseif ($codigo == "EUR") {
            return "(".$codigo.") ".number_format($monto,2,',','.');
        }
        
    }
    
    function formateo_moneda_dos($codigo, $monto){
        if($codigo == "USD"){
            return number_format($monto,2,',','.');
        }elseif ($codigo == "CLP") {
            return number_format($monto,0,',','.');
        }elseif ($codigo == "U.F.") {
            return number_format($monto,2,',','.');
        }elseif ($codigo == "EUR") {
            return number_format($monto,2,',','.');
        }
        
    }
    
    function VenceEn($fecha){
        $vence = "";
        $clase = "";
        $calculo = 0;
        $hoy = date("Y-m-d");
        if($fecha < $hoy){
            $calculo = $this->dias_transcurridos($fecha,$hoy);
            if($calculo > 365){
                $calculo = $calculo/365;
                $vence = "Hace ".round($calculo)." años";
            }else{
                $vence = "Hace ".$calculo." días";
            }
        }else{
            $calculo = $this->dias_transcurridos($fecha,$hoy);
            if($calculo > 365){
                $calculo = $calculo/365;
                $vence = "En ".round($calculo)." años";
            }else{
                if($calculo < 10){ // marca la boleta con color para identificar que pronto vencera
                    $clase = " class = 'danger' ";
                }else{
                    $clase = "";
                }

                if($calculo == 0){
                    $vence = "Hoy";
                }else{
                    $vence = "en ".$calculo." días";
                }
            }
        }
        
        $vencimiento['vence'] = $vence;
        $vencimiento['clase'] = $clase;
        
        return $vencimiento;
    }
    
}
