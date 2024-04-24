<?php
class Reminder extends CI_Controller{

	function __construct(){ 
		parent::__construct();
		$this->load->model('m_reminder_kategori');
		$this->load->model('m_reminder_jadwal');
		$this->load->model('m_reminder'); 
	}  
	function kategori(){
		$data['title'] = 'Reminder Kategori';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('reminder/kategori');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function kategori_get_data(){ 
 
		$where = array('reminder_kategori_hapus' => 0);

	    $data = $this->m_reminder_kategori->get_datatables($where);
		$total = $this->m_reminder_kategori->count_all($where);
		$filter = $this->m_reminder_kategori->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function kategori_add(){ 
		
		$data['title'] = 'Reminder Kategori';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('reminder/kategori_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function kategori_save(){

		$set = array(
						'reminder_kategori_nama' => strip_tags($_POST['nama']),
						'reminder_kategori_keterangan' => strip_tags($_POST['keterangan']),
					);

		$db = $this->query_builder->add('t_reminder_kategori',$set);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('reminder/kategori'));	

	}
	function kategori_edit($id){

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_reminder_kategori where reminder_kategori_id = '$id'");

		$data['title'] = 'Reminder Kategori';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('reminder/kategori_add');
	    $this->load->view('reminder/kategori_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function kategori_update($id){

		$set = array(
						'reminder_kategori_nama' => strip_tags($_POST['nama']),
						'reminder_kategori_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['reminder_kategori_id' => $id];
		$db = $this->query_builder->update('t_reminder_kategori',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('reminder/kategori'));
	}
	function kategori_delete($id){

		$set = ['reminder_kategori_hapus' => 1];
		$where = ['reminder_kategori_id' => $id];
		$db = $this->query_builder->update('t_reminder_kategori',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('reminder/kategori'));
	}
	function jadwal(){ 
		$data['title'] = 'Reminder Jadwal';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('reminder/jadwal');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function jadwal_get_data(){ 
 
		$where = array('reminder_jadwal_hapus' => 0);

	    $data = $this->m_reminder_jadwal->get_datatables($where);
		$total = $this->m_reminder_jadwal->count_all($where);
		$filter = $this->m_reminder_jadwal->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function jadwal_add(){ 
		
		$data['title'] = 'Reminder Jadwal';

	    //generate kode
	    $num = $this->query_builder->count("SELECT * FROM t_reminder_jadwal") + 1;
	    $data['kode'] = 'VK00'.$num;

	    //kandang
		$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

		//sawit
		$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_reminder_kategori WHERE reminder_kategori_hapus = 0");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('reminder/jadwal_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function jadwal_save(){

		$kebun = strip_tags($_POST['kebun']);
		$kategori = strip_tags($_POST['kategori']);

		$set = array(
						'reminder_jadwal_kode' => strip_tags($_POST['kode']),
						'reminder_jadwal_kebun' => $kebun,
						'reminder_jadwal_kategori' => $kategori,
						'reminder_jadwal_hari' => strip_tags($_POST['hari']),
						'reminder_jadwal_keterangan' => strip_tags($_POST['keterangan']),
					);

		$db = $this->query_builder->add('t_reminder_jadwal',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('reminder/jadwal'));	

	}
	function jadwal_delete($id){

		$set = ['reminder_jadwal_hapus' => 1];
		$where = ['reminder_jadwal_id' => $id];
		$db = $this->query_builder->update('t_reminder_jadwal',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('reminder/jadwal'));
	}
	function jadwal_edit($id){

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_reminder_jadwal where reminder_jadwal_id = '$id'");

		//kandang
		$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

		//ayam
		$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_reminder_kategori WHERE reminder_kategori_hapus = 0");

		$data['title'] = 'Reminder Jadwal';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('reminder/jadwal_add');
	    $this->load->view('reminder/jadwal_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function jadwal_update($id){

		$kebun = strip_tags($_POST['kebun']);
		$kategori = strip_tags($_POST['kategori']);

		$set = array(
						'reminder_jadwal_kebun' => $kebun,
						'reminder_jadwal_kategori' => $kategori,
						'reminder_jadwal_hari' => strip_tags($_POST['hari']),
						'reminder_jadwal_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['reminder_jadwal_id' => $id];
		$db = $this->query_builder->update('t_reminder_jadwal',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('reminder/jadwal'));
	}

	function notif(){
		
		$data['title'] = 'Vaksinasi';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('reminder/notif');
	    $this->load->view('v_template_admin/admin_footer');
	}

	function notif_get_data(){  

		$where = array('reminder_hapus' => 0);

	    $data = $this->m_reminder->get_datatables($where);
		$total = $this->m_reminder->count_all($where);
		$filter = $this->m_reminder->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function notif_proses($id){

		$set = ['reminder_status' => 1];
		$where = ['reminder_id' => $id];
		$db = $this->query_builder->update('t_reminder',$set,$where);
		
		if ($db == 1) {

			$this->session->set_flashdata('success','Data berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('reminder/notif'));
	}

	//add reminder
	function add_notif(){

		$data = $this->db->query("SELECT * FROM t_reminder_jadwal WHERE reminder_jadwal_hapus = 0")->result_array();

		foreach ($data as $v) {

            //set
            $jadwal = $v['reminder_jadwal_id'];
            $kebun = $v['reminder_jadwal_kebun'];
            $kategori = $v['reminder_jadwal_kategori'];

            $u = $v['reminder_jadwal_hari'];
            $now = date('Y-m-d');

            //cek data vaksin
            $cek = $this->db->query("SELECT * FROM t_reminder WHERE reminder_jadwal = '$jadwal' AND reminder_kebun = '$kebun' AND reminder_kategori = '$kategori' ORDER BY reminder_id DESC LIMIT 1")->row_array();

            if (@$cek) {

            	//sudah ada
            	$d = $cek['reminder_tanggal'];
            	$date = new DateTime($d); 
	            $date->modify("+".$u." day");
	            $tanggal = $date->format('Y-m-d');

	            //simpan
	            if ($tanggal == $now) {
	            	
	            	$cek2 = $this->db->query("SELECT * FROM t_reminder WHERE reminder_kebun = '$kebun' AND reminder_kategori = '$kategori' AND reminder_tanggal = '$tanggal'")->num_rows();

	            	if (@$cek2 == 0) {
	            		
	            		$set = array(
	            					'reminder_jadwal' => $jadwal,
	            					'reminder_kategori' => $kategori,
	            					'reminder_kebun' => $kebun,
	            					'reminder_tanggal' => $tanggal,
	            				);

	            		$this->db->set($set);
	            		$this->db->insert('t_reminder');
						
						//library notif
						$this->notif->reminder($kebun, $kategori, $tanggal);
	            	}
	            }

            }else{

				//jadwal baru            	
            	$d = $v['reminder_jadwal_tanggal'];
				$date = new DateTime($d); 
	            $date->modify("+".$u." day");
	            $tanggal = $date->format('Y-m-d');

	            $cek2 = $this->db->query("SELECT * FROM t_reminder WHERE reminder_kebun = '$kebun' AND reminder_kategori = '$kategori' AND reminder_tanggal = '$tanggal'")->num_rows();

	            if ($tanggal == $now) {

	            	if (@$cek2 == 0) {
            		
	            		$set = array(
	            					'reminder_jadwal' => $jadwal,
	            					'reminder_kategori' => $kategori,
	            					'reminder_kebun' => $kebun,
	            					'reminder_tanggal' => $tanggal,
	            				);

	            		$this->db->set($set);
	            		$this->db->insert('t_reminder');

	            		//library notif
						$this->notif->reminder($kebun, $kategori, $tanggal);
	            	}
	            }
            }	
			
		}
	}
	
	function test(){

		
	}
}