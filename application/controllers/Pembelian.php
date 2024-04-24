<?php
class Pembelian extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pembelian'); 
		$this->load->model('m_hutang');
	} 
	function transaksi(){ 
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pembelian';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/transaksi');
		    $this->load->view('v_template_admin/admin_footer');
 
		} 
		else{
			redirect(base_url('login')); 
		}
	} 
	function transaksi_get(){

		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');
		$kebun = $this->session->userdata('kebun');

		if ($level == 1) {
			//admin
			$where = array('pembelian_hapus' => 0);
		}else{
			//user
			$where = array('pembelian_hapus' => 0, 'pembelian_kebun' => $kebun);
		}

	    $data = $this->m_pembelian->get_datatables($where);
		$total = $this->m_pembelian->count_all($where);
		$filter = $this->m_pembelian->count_filtered($where);

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
			$data['title'] = 'Pembelian';

			//generate nomor
			$get = $this->query_builder->count("SELECT * FROM t_pembelian");
			$data['nomor'] = 'PB-'.date('dmy').'-'.($get + 1);

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_barang_kategori WHERE barang_kategori_id != 1");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/'.$this->ui->view('transaksi_add'));
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function get_barang($kategori){

		$data = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_kategori ='$kategori'");
		echo json_encode($data);
	}
	function get_satuan($id){
		$data = $this->query_builder->view_row("SELECT * FROM t_barang as a JOIN t_satuan as b ON a.barang_satuan = b.satuan_id WHERE barang_id ='$id'");
		echo json_encode($data);
	}
	function transaksi_save(){

		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);
		$struk = strip_tags($_POST['struk']);

		//pembelian
		$set1 = array(
						'pembelian_kebun' => $this->session->userdata('kebun'),
						'pembelian_user' => $this->session->userdata('id'),
						'pembelian_faktur' => strip_tags($_POST['faktur']),
						'pembelian_kontak' => strip_tags($_POST['kontak']),
						'pembelian_sales' => strip_tags($_POST['sales']),
						'pembelian_nomor' => $nomor,
						'pembelian_status' => $status,
						'pembelian_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_ppn' => strip_tags($_POST['ppn']),
						'pembelian_qty' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'pembelian_total' => strip_tags(str_replace(',', '', $_POST['total'])),
					);

		$save = $this->query_builder->add('t_pembelian',$set1);

		if ($save == 1) {

			//ada hutang
			if ($status == 'belum') {

				$this->query_builder->add('t_hutang',['hutang_nomor' => $nomor]);
			}
			
			$num = count($_POST['barang']);

			for ($i = 0; $i < $num; ++$i) {
				
				//barang
				$set2 = array(
								'pembelian_barang_nomor' => $nomor,
								'pembelian_barang_kategori' => strip_tags($_POST['kategori'][$i]),
								'pembelian_barang_barang' => strip_tags($_POST['barang'][$i]),
								'pembelian_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
								'pembelian_barang_diskon' => strip_tags(str_replace(',', '', $_POST['diskon'][$i])),
								'pembelian_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
								'pembelian_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
							);

				$this->query_builder->add('t_pembelian_barang',$set2);	
			}

			//update stok
			$this->stok->update_barang();
			$this->notif->pembelian($nomor);

			//kirim struk
			if ($struk == 1) {
				$this->notif->print($nomor, 'pembelian');
			}

			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/transaksi'));
	}
	function transaksi_delete($id){

		$set = ['pembelian_hapus' => 1];
		$where = ['pembelian_id' => $id];
		$del = $this->query_builder->update('t_pembelian',$set,$where);
		if ($del == 1) {
			
			//update stok
			$this->stok->update_barang();
			
			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/transaksi'));

	}
	function transaksi_print($id){
		$data['title'] = 'Pembelian';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id LEFT JOIN t_user as d ON a.pembelian_user = d.user_id LEFT JOIN t_kontak as e ON a.pembelian_kontak = e.kontak_id LEFT JOIN t_satuan as f ON c.barang_satuan = f.satuan_id WHERE a.pembelian_id = '$id'");
		$this->load->view('pembelian/transaksi_print',$data);
	}
	function transaksi_view($id){

		if ( $this->session->userdata('login') == 1) {

			$data['title'] = 'Pembelian';
			$data['view'] = '1';

			//data
			$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id JOIN t_user as d ON a.pembelian_user = d.user_id JOIN t_kontak as e ON a.pembelian_kontak = e.kontak_id WHERE a.pembelian_id = '$id'");

			//kontak
			$data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_barang_kategori");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/'.$this->ui->view('transaksi_add'));
		    $this->load->view('pembelian/transaksi_edit');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function hutang(){

		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Hutang';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/hutang');
		    $this->load->view('pembelian/hutang_modal');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function hutang_get(){  

		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$where = array('pembelian_hapus' => 0);
		}else{
			//user
			$where = array('pembelian_hapus' => 0, 'pembelian_user' => $user);
		}

	    $data = $this->m_hutang->get_datatables($where);
		$total = $this->m_hutang->count_all($where);
		$filter = $this->m_hutang->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function hutang_bayar($id){

		//nomor
		$get = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");
		$nomor = $get['pembelian_nomor'];

		$keterangan = strip_tags(@$_POST['keterangan']);
		$tanggal = strip_tags(@$_POST['tanggal']);
		$set = ['hutang_keterangan' => $keterangan, 'hutang_tanggal' => $tanggal];
		$where = ['hutang_nomor' => $nomor];

		$db = $this->query_builder->update('t_hutang',$set,$where);
		
		if ($db == 1) {
			
			//update status pembelian
			$this->query_builder->update('t_pembelian',['pembelian_status' => 'lunas'],['pembelian_nomor' => $nomor]);

			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/hutang'));
	}
}