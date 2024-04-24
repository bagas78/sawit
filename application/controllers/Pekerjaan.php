<?php
class Pekerjaan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pekerjaan');
	}  
	function index(){
		$data['title'] = 'Pekerjaan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pekerjaan/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data(){

		$where = array('pekerjaan_hapus' => 0);

	    $data = $this->m_pekerjaan->get_datatables($where);
		$total = $this->m_pekerjaan->count_all($where);
		$filter = $this->m_pekerjaan->count_filtered($where);

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
		
		$data['title'] = 'Pekerjaan';

	    //generate kode
	    $num = $this->query_builder->count("SELECT * FROM t_pekerjaan") + 1;
	    $data['kode'] = 'PK00'.$num;

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pekerjaan/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
		$set = array(
						'pekerjaan_kode' => strip_tags($_POST['kode']),
						'pekerjaan_nama' => strip_tags($_POST['nama']),
					);

		$db = $this->query_builder->add('t_pekerjaan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('pekerjaan'));	

	}
	function delete($id){

		$set = ['pekerjaan_hapus' => 1];
		$where = ['pekerjaan_id' => $id];
		$db = $this->query_builder->update('t_pekerjaan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('pekerjaan'));
	}
	function edit($id){
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_pekerjaan where pekerjaan_id = '$id'");

		$data['title'] = 'Pekerjaan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pekerjaan/add');
	    $this->load->view('pekerjaan/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'pekerjaan_nama' => strip_tags($_POST['nama']),
					);

		$where = ['pekerjaan_id' => $id];
		$db = $this->query_builder->update('t_pekerjaan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('pekerjaan'));
	}
}