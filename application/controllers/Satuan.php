<?php
class Satuan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_satuan');
	}  
	function index(){
		$data['title'] = 'Satuan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('satuan/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data(){

		$where = array('satuan_hapus' => 0);

	    $data = $this->m_satuan->get_datatables($where);
		$total = $this->m_satuan->count_all($where);
		$filter = $this->m_satuan->count_filtered($where);

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
		
		$data['title'] = 'Satuan';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('satuan/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
		$set = array(
						'satuan_nama' => strip_tags($_POST['nama']),
						'satuan_singkatan' => strip_tags($_POST['singkatan']),
						'satuan_jumlah' => strip_tags($_POST['jumlah']),
						'satuan_keterangan' => strip_tags($_POST['keterangan']),
					);

		$db = $this->query_builder->add('t_satuan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('satuan'));	

	}
	function delete($id){

		$set = ['satuan_hapus' => 1];
		$where = ['satuan_id' => $id];
		$db = $this->query_builder->update('t_satuan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('satuan'));
	}
	function edit($id){
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_satuan where satuan_id = '$id'");

		$data['title'] = 'Satuan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('satuan/add');
	    $this->load->view('satuan/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'satuan_nama' => strip_tags($_POST['nama']),
						'satuan_singkatan' => strip_tags($_POST['singkatan']),	
						'satuan_jumlah' => strip_tags($_POST['jumlah']),
						'satuan_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['satuan_id' => $id];
		$db = $this->query_builder->update('t_satuan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('satuan'));
	}
}