<?php
class Wa extends CI_Controller{ 

	function __construct(){
		parent::__construct();
	}  
	function index(){

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_notif");
		$data['tujuan'] = explode(',', $data['data']['notif_tujuan']);

		$data['title'] = 'Notif Whatsapp';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('wa/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){

		$id = strip_tags(@$_POST['id']);

		$set = array(
						'notif_api' => strip_tags(@$_POST['api']),
						'notif_tujuan' => strip_tags(implode(',', @$_POST['tujuan'])),
						'notif_pembelian' => strip_tags(@$_POST['pembelian']),
						'notif_penjualan' => strip_tags(@$_POST['penjualan']),
						'notif_pengeluaran' => strip_tags(@$_POST['pengeluaran']),
						'notif_reminder' => strip_tags(@$_POST['reminder']),
						'notif_recording' => strip_tags(@$_POST['recording']), 
					);

		if (@$id) {

			//update
			$where = ['notif_id' => $id];	
			$db = $this->query_builder->update('t_notif',$set, $where);
		}else{

			//insert
			$db = $this->query_builder->add('t_notif',$set);
		}

		if ($db == 1) {

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {

			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('wa'));
	}
}