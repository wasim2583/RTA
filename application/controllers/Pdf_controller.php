<?php
class Pdf_controller extends CI_Controller {
	public function pdf_create(){
		$this->load->library('m_pdf');
		$url=base_url()."uploads/".$filename;
		$html="<h1>Hello</h1>";
		$this->m_pdf->pdf->WriteHTML($html);
		//download it.
		$filename = 'report_'.date('YmdHis').'.pdf'; 
		$pdfFilePath = "uploads/".$filename;
		$this->m_pdf->pdf->Output($pdfFilePath, "F");
	}
}
?>