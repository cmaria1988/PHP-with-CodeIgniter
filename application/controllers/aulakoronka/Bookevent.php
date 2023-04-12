<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bookevent extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->Model("aulakoronka/Generalmodel");
		$this->load->Model("aulakoronka/Categorymodel");
		$this->load->Model("aulakoronka/Customermodel");
		$this->load->Model("aulakoronka/Eventmodel");
		$this->mylib->cek_adm_login();
		$this->data['js_files'][] = asset_url() . 'vendors/datepicker/js/bootstrap-datepicker.min.js';
		$this->data['js_files'][] = js_url() . 'aulakoronka/event.js';
		$this->data['css_files'][] = asset_url() . 'vendors/datepicker/css/bootstrap-datepicker.min.css';

		//$this->getData('*');

	}
	public function index($renderData = null)
	{
		$this->jstambahan = "";
		$this->getDataCategory();
		$this->getDataCustomer();
		$this->getDataEvent();
		if (!is_null($renderData)) {
			$this->tampil($renderData, false);
		}
		$this->load->template_adm('Bookevent_view', $this->data);
	}


	/* ambil data customer */
	public function getDataCustomer()
	{
		if (isset($_POST['id'])) {
			$data['customerid'] = $_POST['id'];
			$event = $this->Customermodel->getDataById($data['customerid']);
			echo json_encode($event[0]);
		} else {
			$data['customerid'] = '';
			$this->data['listcustomer'] = $this->Customermodel->getData();
		}
		$this->data['listcustomer'] = $this->Customermodel->getData();
	}

	/* ambil eventid terakhir, bisa via AJAX atau NOAJAX */
	public function getEventId($tipe = 'AJAX')
	{
		//generate no penjualan dimulai huruf Jxxxxx
		$data = $this->Generalmodel->autonumber('AK', 'events', 'eventid', '5');
		if ($tipe == 'AJAX') {
			echo json_encode($data);
		} else {
			return $data['kode'];
		}
		exit;
	}
	/* ambil semua data barang, jika ada parameter post id, ambil berdasarkan id */
	public function getDataCategory()
	{

		//cek apakah dikirim via ajax dengan memberikan $_POST['id']?
		if (isset($_POST['id'])) {
			$data['categoryid'] = $_POST['id'];
			//ambil data barang berdasarkan id
			$event = $this->Categorymodel->getDataById($data['categoryid']);
			echo json_encode($event[0]);
		} else {
			//$data['categoryid'] = '';
			//$catlist = $this->Categorymodel->getData();
			//$listcategory = array();
			//foreach ($catlist as $key => $value) {
			//	//$value['price'] = $this->mylib->rupiah($value['price']);
			//	$listcategory[$key] = $value;
			//}

			$this->data['listcategory'] = $this->Categorymodel->getData();
		}
	}
	/* ambil data penjualan */
	public function getDataEvent()
	{
		$this->data['listdataevent'] = $this->Eventmodel->getDataEvent();
	}

	/* proses simpan ke tabel */
	public function save()
	{
		//$data['eventid'] = $this->input->post('eventid');
		$data['categoryid'] = $this->input->post('categoryid');
		$data['createdate'] = date('Y-m-d H:i:s');
		$data['customerid'] = $this->input->post('customerid');
		$data['date'] =  $this->input->post('tglevent');
		$data['discount'] = (int)str_replace(".", "", $this->input->post('showdiscount'));
		$data['information'] = $this->input->post('showinfo');
		$data['numberofpeople'] = $this->input->post('shownop');
		$data['start'] = $this->input->post('showstart');
		$data['theme'] = $this->input->post('showtheme');
		$data['vendor'] = $this->input->post('showvendor');

		$payment = array();
		$payment['date'] = $data['createdate'];
		$payment['amount'] = (int)str_replace(".", "", $this->input->post('showaddpayment'));
		$payment['paymentmethod'] = $this->input->post('paymentmethod');
		$payment['information'] = $this->input->post('paymentdetail');

		if ($this->input->post("tblsimpan")) {

			if (is_null($data['customerid']) || empty($data['customerid'])) {
				$this->data['message'] = array("danger", "Customer must be selected.", 0);
			} else if (is_null($data['categoryid']) || empty($data['categoryid'])) {
				$this->data['message'] = array("danger", "Category must be selected.", 0);
			} else if (is_null($data['date']) || empty($data['date'])) {
				$this->data['message'] = array("danger", "Date must be filled in.", 0);
			} else if (is_null($payment['amount']) || empty($payment['amount'])) {
				$this->data['message'] = array("danger", "Payment amount must be filled in.", 0);
			}else if (is_null($payment['paymentmethod']) || empty($payment['paymentmethod'])) {
				$this->data['message'] = array("danger", "Payment method must be selected.", 0);
			} else {
				//cek if date is available or not
				if (count($this->Eventmodel->checkdate($data['date'])) > 0) {
					$this->data['message'] = array("danger", "Date is selected for another event.", 0);
				} else {
					$data['eventid'] = $this->getEventId('NO_AJAX');
					$payment['eventid'] = $data['eventid'];
					$this->db->trans_start();
					$this->data['message'] = $this->Eventmodel->save($data, $payment);
					$this->db->trans_complete();
					if ($this->db->trans_status() === FALSE) {
						$this->db->trans_rollback();
						$this->data['message'] = array("danger", "Failed to add new event. <br>" . $this->db->_error_message());
					} else {
						$this->db->trans_commit();
						$this->data['message'] = array("success", "Event is added successfully.", 0);
					}
				}
			}
			$this->index();
		} elseif ($this->input->post("tblubah")) {
			if (is_null($data['customerid']) || empty($data['customerid'])) {
				$this->data['message'] = array("danger", "Customer must be selected.", 0);
			} else if (is_null($data['categoryid']) || empty($data['categoryid'])) {
				$this->data['message'] = array("danger", "Category must be selected.", 0);
			} else if (is_null($data['date']) || empty($data['date'])) {
				$this->data['message'] = array("danger", "Date must be filled in.", 0);
			} else {
				//print_r($this->input->post('eventid'));
				//cek if date is available or not
				if (count($this->Eventmodel->checkdate($data['date'], $this->input->post('eventid'))) > 0) {
					$this->data['message'] = array("danger", "Date is selected for another event.", 0);
				} else {
					$data['eventid'] = $this->input->post('eventid');
					$this->db->trans_start();
					$this->data['message'] = $this->Eventmodel->update($data, $data['eventid']);

					$this->db->trans_complete();
					if ($this->db->trans_status() === FALSE) {
						$this->db->trans_rollback();
						$this->data['message'] = array("danger", "Update event is failed. <br>" . $this->db->_error_message(), $this->db->_error_number());
					} else {
						$this->db->trans_commit();
						$this->data['message'] = array("success", "Update event is successful.", 0);
					}
				}
			}
			$this->index($this->input->post('eventid'));
		} else if ($this->input->post("addpayment")) {
			if (is_null($payment['amount']) || empty($payment['amount']) || $payment['amount'] == 0) {
				$this->data['message'] = array("danger", "Payment amount must be filled in.", 0);
			}else if (is_null($payment['paymentmethod']) || empty($payment['paymentmethod'])) {
				$this->data['message'] = array("danger", "Payment method must be selected.", 0);
			} else {
				$payment['eventid'] = $this->input->post('eventid');
				$this->db->trans_start();
				$this->data['message'] = $this->Eventmodel->save(null, $payment);
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$this->data['message'] = array("danger", "Added payment is failed. <br>" . $this->db->_error_message());
				} else {
					$this->db->trans_commit();
					$this->data['message'] = array("success", "Payment is added.", 0);
				}
			}
			$this->index($this->input->post('eventid'));
		} else if ($this->input->post("tblhapus")) {
			$eventid = $this->input->post('eventid');
			$this->db->trans_start();
			$this->data['message'] = $this->Eventmodel->hapus($eventid);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->data['message'] = array("danger", "Deleting event is failed <br>" . $this->db->_error_message());
			} else {
				$this->db->trans_commit();
				$this->data['message'] = array("success", "Deleting event is success.", 0);
			}
			$this->index();
		} else {
			redirect($this->uricontroller);
		}
	}

	//tampilkan event untuk diubah */
	public function tampil($eventid, $loadview = true)
	{
		//cek ada gak nopenjualan
		if (!isset($eventid) || $eventid == '') {
			redirect('aulakoronka/Bookevent');
		}
		//buat di popup
		$this->getDataEvent();
		//ambil data event berdasarkan eventid
		$cek = $this->Eventmodel->getEventById($eventid);
		$this->data['listpayment'] = $this->Eventmodel->getPaymentById($eventid);
		$cekarr = array_filter($cek);
		//kalo ada datanya, ambil data
		if (!empty($cekarr)) {
			$this->data['listdateevent'] = $cek;
			$this->data['dataEvent'] = $cek[0];
			$remainpayment = $this->data['dataEvent']['price'] - $this->data['dataEvent']['payment'] - $this->data['dataEvent']['discount'];
			$this->data['dataEvent']['remainpayment'] = $remainpayment;

			$this->getDataCustomer();
			$this->getDataCategory();
			if ($loadview) {
				$this->load->template_adm('Bookevent_view', $this->data);
			}
		} else {
			redirect('aulakoronka/Bookevent');
		}
	}

	/*
	public function cetak($idpo){
		if(!isset($idpo)||$idpo==''){
			redirect($this->uricontroller);
		}
		$this->hasNav = false;
		$cek = $this->Pomodel->getDataById($idpo);
		$cekarr = array_filter($cek);
		if(!empty($cekarr)){
			$this->getDataBarang('');
			$this->data['dataPo'] = $cek[0];
			$tgl = $cek[0]['tgl_po'];
			$tgl1 = explode(" ",$tgl);
			$this->data['dataPo']['tgl_po'] = $tgl1[0];
			$idsup = $cek[0]['kd_supp'];
			$x = $this->Suppliermodel->getDataById($idsup);
			$this->data['dataSupplier'] = $x[0];
			$this->data['dataDetilpo'] = $this->Pomodel->getDetail($idpo);
			$this->load->view('pages/cetakpo2',$this->data);
		}else{
			redirect($this->uricontroller);
		}
	}
	
	public function getData($field){
		$this->data['listdata'] = $this->Pelangganmodel->getData($field,'belumkirim');
	}
	public function getDataById($renderData="AJAX"){
		$a = $this->Pomodel->getDataById($_POST['id']);
		echo json_encode($a[0]);
    }
    
    */
}
