<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
 
class Pdf_Controller extends MY_Mantenedor {
    
    function __construct() {
        parent::__construct();
        $this->load->model('pdf_model');
        $this->load->model('boleta_model');
        $this->load->model('reportes_model');
        $this->load->library('Pdf');
        $this->load->library('recursos');
    }

    public function GeneraPdf($html,$nombre){
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('');
        $pdf->SetSubject('');
        $pdf->SetKeywords('');
        
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING, array(255, 255, 255), array(255, 255, 255));
        $pdf->SetFooterData($tc = array(0, 64, 0), $lc = array(255, 255, 255));
        
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        $pdf->setFontSubsetting(true);
        
        $pdf->SetFont('helvetica', '', 10, '', true);
        
        $pdf->AddPage();
        
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $nombre_archivo = utf8_decode($nombre.date('Y-m-d-His').".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
    
    public function BoletaPdf($id_boleta){
        
        $result = $this->boleta_model->BuscarBoleta($id_boleta);
        $hoy = $this->recursos->FormatoFecha2(date('Y-m-d'));
        
        foreach($result as $row){
            $nombre = $row->nombre;
            $banco = $row->nombre_banco;
            $numero_boleta = $row->numero_boleta;
            $monto_boleta = $row->monto_boleta;
            $fecha_recepcion = $row->fecha_recepcion;
            $fecha_vencimiento = $row->fecha_vencimiento;
            $tipo_garantia = $row->tipo_garantia;
            $denominacion = $row->denominacion;
        }
        
        $html = '';
        $html .= '<br/><br/><br/><br/>';
        $html .= '<table width="100%">';
        $html .= '<tr><td colspan="2" align="center"><b>SANTIAGO,</b> '.$hoy.'</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2"><b>Señor</b></td></tr>';
        $html .= '<tr><td colspan="2"><b><u>'.$nombre.'</u></b></td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2" align="center"><b><u>Mat.: Devolución de documentos en custodia</u></b></td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">Señores:</td></tr>';
        $html .= '<tr><td colspan="2" align="center">Sírvanse recibir por devolución del siguiente Documento en Garantía Bancaria:</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td style="width: 100px">Banco</td><td style="width: 502px">:&nbsp;&nbsp;'.$banco.'</td></tr>';
        $html .= '<tr><td style="width: 100px">Número</td><td>:&nbsp;&nbsp;'.$numero_boleta.'</td></tr>';
        $html .= '<tr><td style="width: 100px">Valor</td><td>:&nbsp;&nbsp;'.$monto_boleta.'</td></tr>';
        $html .= '<tr><td style="width: 100px">Fecha Emisión</td><td>:&nbsp;&nbsp;'.$this->recursos->FormatoFecha2($fecha_recepcion).'</td></tr>';
        $html .= '<tr><td style="width: 100px">Fecha Validez</td><td>:&nbsp;&nbsp;'.$this->recursos->FormatoFecha2($fecha_vencimiento).'</td></tr>';
        $html .= '<tr><td style="width: 100px">Concepto</td><td>:&nbsp;&nbsp;'.$tipo_garantia.'</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td style="width: 100px">Detalle</td><td>:&nbsp;&nbsp;'.$denominacion.'</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">Sin otro particular le saluda,</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2" align="center"><b>Yasna Vega Leiva</b></td></tr>';
        $html .= '<tr><td colspan="2" align="center">Jefa Departamento de Finanzas</td></tr>';
        $html .= '<tr><td colspan="2" align="center">Subsecretaría de Energía</td></tr>';
        $html .= '<tr><td colspan="2">---------------------------------------------------------------------------------------------------</td></tr>';
        $html .= '<tr><td colspan="2"><b>Recepción Conforme</b></td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td>Nombre</td><td>: ...............................................................................................</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td>C.I.</td><td>: .......................................... Firma ..........................................</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2" align="center">Fecha Entrega Efectiva ........................................</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2" style="color: gray"><h5>Alameda Libertador Bernardo O´Higgins 1449,</h5></td></tr>';
        $html .= '<tr><td colspan="2" style="color: gray"><h5>Edificio StgoDowntown II, Pisos 13 y 14</h5></td></tr>';
        $html .= '<tr><td colspan="2" style="color: gray"><h5>Santiago, Chile</h5></td></tr>';
        $html .= '<tr><td colspan="2">&nbsp;</td></tr>';
        $html .= '<tr><td colspan="2" style="color: gray"><h5><a href="http://www.minenergia.cl">www.minenergia.cl</a></h5></td></tr>';
        $html .= '</table>';
        
        $nombre = "Carta_";
        
        $this->GeneraPdf($html, $nombre);
    }
    
    public function GeneraReportes($fecha,$vence,$periodo,$rut,$tipo,$busqueda){
        switch ($busqueda){
            case 1://todas las boletas
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 3, 1);
                break;
            case 2://rut entidad
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 1, $rut);
                break;
            case 3://tipo boleta
                $data = $this->reportes_model->GeneraReportes($fecha, $vence, 2, $tipo);
                break;
        }
        
        $html = '<table border="1">';
        $html .= '<tr>';
        $html .= '<td class="active"><b>N°</b></td>';
        $html .= '<td class="active"><b>Rut</b></td>';
        $html .= '<td class="active"><b>Nombre</b></td>';
        $html .= '<td class="active"><b>Tipo</b></td>';
        $html .= '<td class="active"><b>Monto</b></td>';
        $html .= '</tr>';
        
        $total = 0;
        foreach ($data as $row){
            $monto = $this->ObtieneMonto($row->idMoneda, $row->monto_boleta);
            $total = $total + $monto;
            $html .= '<tr>';
            $html .= '<td width="150px">'.$row->numero_boleta.'</td>\n';
            $html .= '<td width="120px">'.$this->recursos->DevuelveRut($row->rut).'</td>\n';
            $html .= '<td width="450px">'.$row->nombre.'</td>\n';
            $html .= '<td width="120px">'.$row->descripcion_tipo_boleta.'</td>\n';
            $html .= '<td align="right">'.$this->recursos->Formato1($monto).'</td>\n';
            $html .= '<tr>\n';
        }
        $html .= '<tr>';
        $html .= '<td colspan="4" align="right"><b>Monto Total &nbsp;</b></td>';
        $html .= '<td align="right"><b>$ '.$this->recursos->Formato1($total).'-</b></td>';
        $html .= '</tr>';
        
        return($resultado);
    }
    
    public function ReportePdf($fecha,$vence,$periodo,$tipo = 0,$busqueda,$rut = 0){
        $resultado = $this->GeneraReportes($fecha, $vence, $periodo, $rut, $tipo, $busqueda);
        
        print_r($resultado);
        die();
        
        $nombre = "Reporte_";
        $this->GeneraPdf($html, $nombre);
    }
}

