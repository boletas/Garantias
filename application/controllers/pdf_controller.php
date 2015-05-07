<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
 
class Pdf_Controller extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('pdf_model');
        $this->load->model('boleta_model');
        $this->load->library('Pdf');
    }

    public function BoletaPdf($id_boleta){
        
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('');
        $pdf->SetSubject('');
        $pdf->SetKeywords('');
        
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        $pdf->setFontSubsetting(true);
        
        $pdf->SetFont('freemono', '', 14, '', true);
        
        $pdf->AddPage();
        
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
    
        $result = $this->boleta_model->BuscarBoleta($id_boleta);
        
        $hoy = date("d-m-Y");
        
        $html = "";
        $html .= "<table border='1'>";
        $html .= "<tr align='center'><td>SANTIAGO ".$hoy."</td></tr>";
        $html .= "</table>";
        
        foreach($result as $row){
            
        }
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
        $nombre_archivo = utf8_decode("Localidades.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
}

