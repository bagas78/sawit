<?php
class penjualan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_penjualan');
		$this->load->model('m_piutang');
	}  
	function transaksi(){  
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'penjualan';
 
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/transaksi');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{ 
			redirect(base_url('login'));
		}
	}
	function transaksi_get(){

		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$where = array('penjualan_hapus' => 0);
		}else{
			//user
			$where = array('penjualan_hapus' => 0, 'penjualan_user' => $user);
		}

	    $data = $this->m_penjualan->get_datatables($where);
		$total = $this->m_penjualan->count_all($where);
		$filter = $this->m_penjualan->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function transaksi_add(){
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'penjualan';

			//generate nomor
			$get = $this->query_builder->count("SELECT * FROM t_penjualan");
			$data['nomor'] = 'PJ-'.date('dmy').'-'.($get + 1);

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 'p' AND kontak_hapus = 0");

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_barang_kategori WHERE barang_kategori_id = 1");

			//barang
			$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori = 1 AND barang_hapus = 0");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/'.$this->ui->view('transaksi_add'));
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function get_barang($kategori){

		$data = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori ='$kategori' AND barang_hapus = 0");
		echo json_encode($data);
	}
	function get_satuan($id){

		$data = $this->query_builder->view_row("SELECT * FROM t_barang as a JOIN t_satuan as b ON a.barang_satuan = b.satuan_id WHERE barang_id ='$id'");
		echo json_encode($data);
	}
	function get_stok($barang){

		$db = $this->query_builder->view_row("SELECT barang_stok as stok FROM t_barang WHERE barang_id = '$barang'");

		if (@$db) {
			$stok = (int) $db['stok'];
		}else{
			$stok = 0;
		}
		
		echo json_encode($stok);
	}
	function transaksi_save(){

		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);
		$struk = strip_tags($_POST['struk']);

		//penjualan
		$set1 = array(	
						'penjualan_kebun' => $this->session->userdata('kebun'),
						'penjualan_user' => $this->session->userdata('id'),
						'penjualan_kontak' => strip_tags($_POST['kontak']),
						'penjualan_nomor' => $nomor,
						'penjualan_status' => $status,
						'penjualan_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'penjualan_keterangan' => strip_tags($_POST['keterangan']),
						'penjualan_qty' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'penjualan_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'penjualan_total' => strip_tags(str_replace(',', '', $_POST['total'])),
					);

		$save = $this->query_builder->add('t_penjualan',$set1);

		if ($save == 1) {

			//ada piutang
			if ($status == 'belum') {

				$this->query_builder->add('t_piutang',['piutang_nomor' => $nomor]);
			}
			
			$num = count($_POST['barang']);

			for ($i = 0; $i < $num; ++$i) {
				
				//barang
				$set2 = array(
								'penjualan_barang_nomor' => $nomor,
								'penjualan_barang_kategori' => strip_tags($_POST['kategori'][$i]),
								'penjualan_barang_barang' => strip_tags($_POST['barang'][$i]),
								'penjualan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
								'penjualan_barang_diskon' => strip_tags(str_replace(',', '', $_POST['diskon'][$i])),
								'penjualan_barang_stok' => strip_tags(str_replace(',', '', $_POST['stok'][$i])),
								'penjualan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
								'penjualan_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
							);

				$this->query_builder->add('t_penjualan_barang',$set2);	
			}

			//update stok
			$this->stok->update_barang();
			$this->notif->penjualan($nomor);

			//kirim struk
			if ($struk == 1) {
				$this->notif->print($nomor, 'penjualan');
			}

			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('penjualan/transaksi'));
	}
	function transaksi_delete($id){

		$set = ['penjualan_hapus' => 1];
		$where = ['penjualan_id' => $id];
		$del = $this->query_builder->update('t_penjualan',$set,$where);
		if ($del == 1) {
			
			//update stok
			$this->stok->update_barang();
			
			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('penjualan/transaksi'));

	}
	function transaksi_print($id){
		$data['title'] = 'penjualan';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan as a JOIN t_penjualan_barang as b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_barang as c ON b.penjualan_barang_barang = c.barang_id JOIN t_user as d ON a.penjualan_user = d.user_id JOIN t_kontak as e ON a.penjualan_kontak = e.kontak_id LEFT JOIN t_satuan as f ON c.barang_satuan = f.satuan_id WHERE a.penjualan_id = '$id'");
		$this->load->view('penjualan/transaksi_print',$data);
	}
	function transaksi_view($id){

		if ( $this->session->userdata('login') == 1) {

			$data['title'] = 'penjualan';
			$data['view'] = '1';

			//data
			$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan as a JOIN t_penjualan_barang as b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_barang as c ON b.penjualan_barang_barang = c.barang_id JOIN t_user as d ON a.penjualan_user = d.user_id JOIN t_kontak as e ON a.penjualan_kontak = e.kontak_id WHERE a.penjualan_id = '$id'");

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 'p' AND kontak_hapus = 0");

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_barang_kategori");

			//barang
			$data['barang_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori = 1 AND barang_hapus = 0");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/'.$this->ui->view('transaksi_add'));
		    $this->load->view('penjualan/transaksi_edit');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function piutang(){

		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'piutang';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/piutang');
		    $this->load->view('penjualan/piutang_modal');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function piutang_get(){

		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$where = array('penjualan_hapus' => 0);
		}else{
			//user
			$where = array('penjualan_hapus' => 0, 'penjualan_user' => $user);
		}

	    $data = $this->m_piutang->get_datatables($where);
		$total = $this->m_piutang->count_all($where);
		$filter = $this->m_piutang->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function piutang_bayar($id){

		//nomor
		$get = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
		$nomor = $get['penjualan_nomor'];

		$keterangan = strip_tags(@$_POST['keterangan']);
		$tanggal = strip_tags(@$_POST['tanggal']);
		$set = ['piutang_keterangan' => $keterangan, 'piutang_tanggal' => $tanggal];
		$where = ['piutang_nomor' => $nomor];

		$db = $this->query_builder->update('t_piutang',$set,$where);
		
		if ($db == 1) {
			
			//update status penjualan
			$this->query_builder->update('t_penjualan',['penjualan_status' => 'lunas'],['penjualan_nomor' => $nomor]);

			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('penjualan/piutang'));
	}
}