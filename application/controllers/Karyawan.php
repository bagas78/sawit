<?php
class Karyawan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_karyawan');
	}   
	function index(){
		$data['title'] = 'Karyawan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('karyawan/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data(){

		$where = array('karyawan_hapus' => 0);

	    $data = $this->m_karyawan->get_datatables($where,'','karyawan_id');
		$total = $this->m_karyawan->count_all($where,'','karyawan_id');
		$filter = $this->m_karyawan->count_filtered($where,'','karyawan_id');

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
		
		$data['title'] = 'Karyawan';

		//kebun
		$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

		//pekerjaan
		$data['pekerjaan_data'] = $this->query_builder->view("SELECT * FROM t_pekerjaan WHERE pekerjaan_hapus = 0");

	    //generate kode
	    $num = $this->query_builder->count("SELECT * FROM t_karyawan") + 1;
	    $data['kode'] = 'KR00'.$num;

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('karyawan/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
		$set = array(
						'karyawan_kode' => strip_tags($_POST['kode']),
						'karyawan_pekerjaan' => strip_tags($_POST['pekerjaan']),
						'karyawan_nama' => strip_tags($_POST['nama']),
						'karyawan_alamat' => strip_tags($_POST['alamat']),
						'karyawan_telp' => strip_tags($_POST['telp']),
						'karyawan_kebun' => strip_tags($_POST['kebun']),
						'karyawan_jenis' => strip_tags($_POST['jenis']),
						'karyawan_upah' => strip_tags($_POST['upah']),
					);

		$db = $this->query_builder->add('t_karyawan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('karyawan'));	

	}
	function delete($id){

		$set = ['karyawan_hapus' => 1];
		$where = ['karyawan_id' => $id];
		$db = $this->query_builder->update('t_karyawan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('karyawan'));
	}
	function edit($id){

		//kebun
		$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

		//pekerjaan
		$data['pekerjaan_data'] = $this->query_builder->view("SELECT * FROM t_pekerjaan WHERE pekerjaan_hapus = 0");

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_karyawan where karyawan_id = '$id'");

		$data['title'] = 'Karyawan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('karyawan/add');
	    $this->load->view('karyawan/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'karyawan_nama' => strip_tags($_POST['nama']),
						'karyawan_pekerjaan' => strip_tags($_POST['pekerjaan']),
						'karyawan_alamat' => strip_tags($_POST['alamat']),
						'karyawan_telp' => strip_tags($_POST['telp']),
						'karyawan_kebun' => strip_tags($_POST['kebun']),
						'karyawan_jenis' => strip_tags($_POST['jenis']),
						'karyawan_upah' => strip_tags($_POST['upah']),
					);

		$where = ['karyawan_id' => $id];
		$db = $this->query_builder->update('t_karyawan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('karyawan'));
	}
	function view($id){

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_karyawan as a JOIN t_kebun as b ON a.karyawan_kebun = b.kebun_id LEFT JOIN t_pekerjaan as c ON a.karyawan_pekerjaan = c.pekerjaan_id where a.karyawan_id = '$id'");

		$data['title'] = 'Karyawan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('karyawan/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
}