<?php
class Report extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_report');
	}  
	function harian(){
		$data['title'] = 'Report';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('report/harian');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data(){ 

		$where = array('report_hapus' => 0);

	    $data = $this->m_report->get_datatables($where);
		$total = $this->m_report->count_all($where);
		$filter = $this->m_report->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function add(){ 
		
		$data['title'] = 'Report';

		//kandang
		$data['kandang_data'] = $this->query_builder->view("SELECT * FROM t_kandang WHERE kandang_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('report/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){

		$user = $this->session->userdata('id');

		$set = array(
						'report_user' => $user,
						'report_tanggal' => strip_tags($_POST['tanggal']),
						'report_kandang' => strip_tags($_POST['kandang']),
						'report_kondisi_kandang' => strip_tags($_POST['kondisi_kandang']),
						'report_kondisi_suhu' => strip_tags($_POST['kondisi_suhu']),
						'report_catatan' => strip_tags($_POST['catatan']),
					);

		$db = $this->query_builder->add('t_report',$set);

		if ($db == 1) {

			//library notif
			$get = $this->query_builder->view_row("SELECT * FROM t_report WHERE report_user = '$user' ORDER BY report_id DESC LIMIT 1");
			
			$id = $get['report_id'];
			$this->notif->kandang($id);

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('report/harian'));	

	}
	function delete($id){

		$set = ['report_hapus' => 1];
		$where = ['report_id' => $id];
		$db = $this->query_builder->update('t_report',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('report/harian'));
	}
	function edit($id){
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_report where report_id = '$id'");
		
		//kandang
		$data['kandang_data'] = $this->query_builder->view("SELECT * FROM t_kandang WHERE kandang_hapus = 0");

		$data['title'] = 'Report';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('report/add');
	    $this->load->view('report/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'report_tanggal' => strip_tags($_POST['tanggal']),
						'report_kandang' => strip_tags($_POST['kandang']),
						'report_kondisi_kandang' => strip_tags($_POST['kondisi_kandang']),
						'report_kondisi_suhu' => strip_tags($_POST['kondisi_suhu']),
						'report_catatan' => strip_tags($_POST['catatan']),
					);

		$where = ['report_id' => $id];
		$db = $this->query_builder->update('t_report',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('report/harian'));
	}
	function view($id){

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_report as a LEFT JOIN t_user as b ON a.report_user = b.user_id LEFT JOIN t_kandang as c ON a.report_kandang = c.kandang_id where a.report_id = '$id'");

		$data['title'] = 'Report Harian';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('report/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
}