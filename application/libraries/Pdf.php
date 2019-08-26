<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{ 
	function __construct() 
	{ 
		parent::__construct(); 
	}

	public function Header() {
        // Logo
        $image_file = FCPATH.'assets/img/logo_dki.png';
        $this->Image($image_file, 15, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('times', 'B', 13);
		// Title
		//$this->Cell(0, 0, 'tes', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->SetXY(30, 13);
		$this->Cell(160, 0, 'PEMERINTAH PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA', 0, false, 'C', 0, '', 1, false, 'M', 'M');
        //$this->SetFont('times', 'B', 15);
		$this->SetXY(30, 19);
		$this->Cell(160, 0, 'DINAS PENANGGULANGAN KEBAKARAN DAN PENYELAMATAN', 0, false, 'C', 0, '', 1, false, 'M', 'M');
        //$this->Cell(0, 0, '   tes', 1, false, 'C', 0, '', 1, false, 'M', 'M');
        $this->SetFont('times', 'B', 10);
        $this->SetXY(30, 24);
        $this->Cell(160, 0, 'http://www.jakartafire.net', 0, false, 'C', 0, '', 1, false, 'M', 'M');
        //$this->SetLineWidth(0.2);
        $color = 'black';
        $style = array('width' => (0.5), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $color);
        $this->Line(15,27,190,27,$style);
        //$this->SetXY(30, 29);
        //$this->Cell(220, 0, 'what the hell', 0, false, 'C', 0, '', 1, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().' dari '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
