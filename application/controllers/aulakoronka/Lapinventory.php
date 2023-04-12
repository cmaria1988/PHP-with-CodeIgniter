<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Lapinventory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->mylib->cek_adm_login();
		$this->load->library('pdf');
		$this->load->model('aulakoronka/Lapinventorymodel');
		//datepicker
		$this->data['js_files'][] = asset_url() . 'vendors/datepicker/js/bootstrap-datepicker.min.js';
		$this->data['css_files'][] = asset_url() . 'vendors/datepicker/css/bootstrap-datepicker.min.css';
		$this->data['js_files'][] = js_url() . 'aulakoronka/lapinventory.js';
	}

	public function index()
	{
		//pilih tgl awal dan tanggal akhir
		$this->load->template_adm('Lapinventory_view', $this->data);
	}
	function cetak()
	{

		if ($this->input->post('tblcetak')) {

			$tglawal = $this->input->post('tglawal');
			$tglakhir = $this->input->post('tglakhir');
			$format = $this->input->post('format');
			//cek dulu ada datanya gak? kalo gak ada munculin error_get_last
			$cekdata = $this->Lapinventorymodel->cekInventory($tglawal, $tglakhir);
			if ($cekdata) {
				if ($format == 'pdf') {
					$this->laporanpdf($tglawal, $tglakhir);
				} elseif ($format == 'xls') {
					$this->laporanxls($tglawal, $tglakhir);
				}
			} else {
				$this->data['error'] = "Inventory Data is not exist.";
				$this->load->template_adm('Lapinventory_view', $this->data);
			}
		} else {
			redirect('aulakoronka/Lapinventory/index');
		}
	}

	function laporanpdf($tglawal, $tglakhir)
	{
		$tglAwalIndo = $this->mylib->tglIndo($tglawal);
		$tglAkhirIndo = $this->mylib->tglIndo($tglakhir);
		//ambil data laporan
		$dtlaporan = $this->Lapinventorymodel->getLaporan($tglawal, $tglakhir);

		//buat objek berdasarkan class fpdf
		$pdf = new FPDF();
		$pdf->AddPage();
		//font arial tebal ukuran 16
		$pdf->SetFont('Arial', 'B', 16);
		//cetak, lebar 190, tinggi 7, border 0, tidak ada enter setelahnya, rata Center
		$pdf->Cell(190, 7, 'LAPORAN INVENTORY', 0, 0, 'C');
		//enter
		$pdf->Ln();
		$pdf->Cell(190, 7, $tglAwalIndo . ' - ' . $tglAkhirIndo, 0, 1, 'C');
		$pdf->Ln();
		//buat header table data, tentukan label, panjang kolom dan perataan
		$header = array(
			array("label" => "Inventory ID", "length" => 40, "align" => "C"),
			array("label" => "Inventory", "length" => 50, "align" => "C"),
			array("label" => "Quantity", "length" => 50, "align" => "C"),
			array("label" => "Purchase Date", "length" => 40, "align" => "C"),
		);
		$pdf->SetFont('Arial', '', '10');
		//latar belakang warna hitam
		$pdf->SetFillColor(0, 0, 0);
		//text warna putih
		$pdf->SetTextColor(255, 255, 255);
		//warna border/garis tepi kolom
		$pdf->SetDrawColor(128, 0, 0);
		//print header
		foreach ($header as $kolom) {
			//parameter terakhir, jika true berarti menggunakan warna latar belakang
			$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', 'C', true);
		}
		$pdf->Ln();
		#tampilkan data tabelnya
		$pdf->SetFillColor(224, 235, 255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial', '', '9');
		$fill = false;
		//$total = 0;
		//looping tampilkan data laporan
		foreach ($dtlaporan as $id => $detil) {
			$i = 0;
			$detil['purchasedate'] = $this->mylib->tglIndo($detil['purchasedate']);
			foreach ($detil as $cell) {
				$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $header[$i]['align'], $fill);
				$i++;
			}
			$fill = !$fill;

			$pdf->Ln();
		}
		//munculin total
		$pdf->SetFont('Arial', 'B', '10');
		//$pdf->Cell(140, 5, 'Total', 1, '0', 'C', true);
		//$pdf->Cell(40, 5, $this->mylib->rupiah($total), 1, '0', 'R', true);
		//download dengan nama laporan.pdf
		$pdf->Output('D', 'laporaninventory.pdf');
	}
	function laporanxls($tglawal, $tglakhir)
	{
		$tglAwalIndo = $this->mylib->tglIndo($tglawal);
		$tglAkhirIndo = $this->mylib->tglIndo($tglakhir);
		//ambil data laporan
		$dtinventory = $this->Lapinventorymodel->getLaporan($tglawal, $tglakhir);
		
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'LAPORAN INVENTORY AULA KORONKA')
			->setCellValue('A2', $tglAwalIndo . ' - ' . $tglAkhirIndo);
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A4', 'Inventory ID')
			->setCellValue('B4', 'Inventory')
			->setCellValue('C4', 'Quantity')
			->setCellValue('D4', 'Purchase Date');

		//looping data
		$i = 5;
		$total = 0;
		foreach ($dtinventory as $id => $dt) {
			//$subTotal = $dt['orderTotal'];
			//$total = $total + $subTotal;

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $i, $dt['inventoryid'])
				->setCellValue('B' . $i, $dt['name'])
				->setCellValue('C' . $i, $dt['quantity'])
				->setCellValue('D' . $i, $this->mylib->tglIndo($dt['purchasedate']));
			$i++;
		}
		//$spreadsheet->setActiveSheetIndex(0)
		//			->setCellValue('A'.$i, 'Total')	
		//			->setCellValue('D'.$i, $total);	

		$spreadsheet->getActiveSheet()->setTitle('Laporan Inventory' . date('d-m-Y'));

		$writer = new Xlsx($spreadsheet);
		$filename = 'laporaninventory';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output'); // download file 
	}
}
