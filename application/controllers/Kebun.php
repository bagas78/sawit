<?php
class Kebun extends CI_Controller{

	function __construct(){
		parent::__construct(); 
		$this->load->model('m_kebun');
	}  
	function index(){
		$data['title'] = 'Kebun';

		//DOC
		$data['doc_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori = 5 AND barang_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kebun/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data(){

		$where = array('kebun_hapus' => 0);

	    $data = $this->m_kebun->get_datatables($where);
		$total = $this->m_kebun->count_all($where);
		$filter = $this->m_kebun->count_filtered($where);

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
		
		$data['title'] = 'Kebun';

	    //generate kode
	    $num = $this->query_builder->count("SELECT * FROM t_kebun") + 1;
	    $data['kode'] = 'KB00'.$num;

	    //tanaman
	    $data['tanaman_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = '1'");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kebun/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
		$set = array(
						'kebun_kode' => strip_tags($_POST['kode']),
						'kebun_nama' => strip_tags($_POST['nama']),
						'kebun_alamat' => strip_tags($_POST['alamat']),
						'kebun_luas' => strip_tags($_POST['luas']),
						'kebun_tanaman' => strip_tags($_POST['tanaman']),
						'kebun_keterangan' => strip_tags($_POST['keterangan']),
					);

		$db = $this->query_builder->add('t_kebun',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('kebun'));	

	}
	function delete($id){

		$set = ['kebun_hapus' => 1];
		$where = ['kebun_id' => $id];
		$db = $this->query_builder->update('t_kebun',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('kebun'));
	}
	function edit($id){
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_kebun where kebun_id = '$id'");

		//tanaman
	    $data['tanaman_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = '1'");

		$data['title'] = 'Kebun';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kebun/add');
	    $this->load->view('kebun/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'kebun_nama' => strip_tags($_POST['nama']),
						'kebun_alamat' => strip_tags($_POST['alamat']),
						'kebun_luas' => strip_tags($_POST['luas']),
						'kebun_tanaman' => strip_tags($_POST['tanaman']),
						'kebun_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['kebun_id' => $id];
		$db = $this->query_builder->update('t_kebun',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('kebun'));
	}
	function view($id){

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_kebun as a JOIN t_barang as b ON a.kebun_tanaman = b.barang_id where a.kebun_id = '$id'");

		$data['title'] = 'Kebun';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kebun/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
}