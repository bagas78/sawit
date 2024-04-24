<?php
class Laporan extends CI_Controller{

	function __construct(){  
		parent::__construct();
		$this->load->model('m_laporan_pembelian');
		$this->load->model('m_laporan_penjualan');
		$this->load->model('m_laporan_pengeluaran');
	} 
	function pembelian(){  
		if ( $this->session->userdata('login') == 1) {

			//kebun
			$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

			//filter sum
			if (@$_POST['tanggal']) {
				
				$dt = explode('-', $_POST['tanggal']);	
				$bln = $dt[1];
				$thn = $dt[0];

				//kebun
				$data['kebun'] = @$_POST['kebun'];
				$where_kebun = 'AND pembelian_kebun = '.@$_POST['kebun'];

			}else{

				$bln = date('m');
				$thn = date('Y');

				//kebun
				$where_kebun = '';
			}

			//sum tahun
			$sum_tahun = $this->db->query("SELECT SUM(a.pembelian_barang_subtotal) AS total FROM t_pembelian_barang AS a JOIN t_pembelian AS b ON a.pembelian_barang_nomor = b.pembelian_nomor WHERE b.pembelian_hapus = 0 AND date_format(b.pembelian_tanggal, '%Y') = '$thn' {$where_kebun}")->row_array();
			$data['sum_tahun'] = $sum_tahun['total'];

			//sum bulan
			$sum_bulan = $this->db->query("SELECT SUM(a.pembelian_barang_subtotal) AS total FROM t_pembelian_barang AS a JOIN t_pembelian AS b ON a.pembelian_barang_nomor = b.pembelian_nomor WHERE b.pembelian_hapus = 0 AND date_format(b.pembelian_tanggal, '%Y') = '$thn' AND date_format(b.pembelian_tanggal, '%m') = '$bln' {$where_kebun}")->row_array();
			$data['sum_bulan'] = $sum_bulan['total'];

			$data['tahun_'] = $thn;
			$data['bulan_'] = $bln;

			$data['title'] = 'Laporan Pembelian';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pembelian');
		    $this->load->view('v_template_admin/admin_footer');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
	function penjualan(){  
		if ( $this->session->userdata('login') == 1) {

			//kebun
			$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

			//filter sum
			if (@$_POST['tanggal']) {
				
				$dt = explode('-', $_POST['tanggal']);	
				$bln = $dt[1];
				$thn = $dt[0];

				//kebun
				$data['kebun'] = @$_POST['kebun'];
				$where_kebun = 'AND penjualan_kebun = '.@$_POST['kebun'];

			}else{

				$bln = date('m');
				$thn = date('Y');

				//kebun
				$where_kebun = '';
			}

			//sum tahun
			$sum_tahun = $this->db->query("SELECT SUM(a.penjualan_barang_subtotal) AS total FROM t_penjualan_barang AS a JOIN t_penjualan AS b ON a.penjualan_barang_nomor = b.penjualan_nomor WHERE b.penjualan_hapus = 0 AND date_format(b.penjualan_tanggal, '%Y') = '$thn' {$where_kebun}")->row_array();
			$data['sum_tahun'] = $sum_tahun['total'];

			//sum bulan
			$sum_bulan = $this->db->query("SELECT SUM(a.penjualan_barang_subtotal) AS total FROM t_penjualan_barang AS a JOIN t_penjualan AS b ON a.penjualan_barang_nomor = b.penjualan_nomor WHERE b.penjualan_hapus = 0 AND date_format(b.penjualan_tanggal, '%Y') = '$thn' AND date_format(b.penjualan_tanggal, '%m') = '$bln' {$where_kebun}")->row_array();
			$data['sum_bulan'] = $sum_bulan['total'];

			$data['tahun_'] = $thn;
			$data['bulan_'] = $bln;

			$data['title'] = 'Laporan Pembelian';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/penjualan');
		    $this->load->view('v_template_admin/admin_footer');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
	function pengeluaran(){  
		if ( $this->session->userdata('login') == 1) {

			//kebun
			$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

			//filter sum
			if (@$_POST['tanggal']) {
				
				$dt = explode('-', $_POST['tanggal']);	
				$bln = $dt[1];
				$thn = $dt[0];

				//kebun
				$data['kebun'] = @$_POST['kebun'];
				$where_kebun = 'AND pengeluaran_kebun = '.@$_POST['kebun'];

			}else{

				$bln = date('m');
				$thn = date('Y');

				//kebun
				$where_kebun = '';
			}

			//sum tahun
			$sum_tahun = $this->db->query("SELECT SUM(a.pengeluaran_barang_harga) AS total FROM t_pengeluaran_barang AS a JOIN t_pengeluaran AS b ON a.pengeluaran_barang_nomor = b.pengeluaran_nomor WHERE b.pengeluaran_hapus = 0 AND date_format(b.pengeluaran_tanggal, '%Y') = '$thn' {$where_kebun}")->row_array();
			$data['sum_tahun'] = $sum_tahun['total'];

			//sum bulan
			$sum_bulan = $this->db->query("SELECT SUM(a.pengeluaran_barang_harga) AS total FROM t_pengeluaran_barang AS a JOIN t_pengeluaran AS b ON a.pengeluaran_barang_nomor = b.pengeluaran_nomor WHERE b.pengeluaran_hapus = 0 AND date_format(b.pengeluaran_tanggal, '%Y') = '$thn' AND date_format(b.pengeluaran_tanggal, '%m') = '$bln' {$where_kebun}")->row_array();
			$data['sum_bulan'] = $sum_bulan['total'];

			$data['tahun_'] = $thn;
			$data['bulan_'] = $bln;

			$data['title'] = 'Laporan Pembelian';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pengeluaran');
		    $this->load->view('v_template_admin/admin_footer');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
	function get_data($jenis, $bulan = '', $tahun = '', $kebun = ''){

		//array kebun
		$arr1 = [$jenis.'_kebun' => $kebun];

		if ($jenis == 'pembelian') {
			
			$arr2 = array('pembelian_hapus' => 0, 'DATE_FORMAT(pembelian_barang_tanggal, "%m") =' => $bulan, 'DATE_FORMAT(pembelian_barang_tanggal, "%Y") =' => $tahun);

			if ($kebun != '') {
				
				//filter kebun
				$where = array_merge($arr1, $arr2);
			}else{

				//tanpa filter kebun
				$where = $arr2;
			} 

		    $data = $this->m_laporan_pembelian->get_datatables($where);
			$total = $this->m_laporan_pembelian->count_all($where);
			$filter = $this->m_laporan_pembelian->count_filtered($where);

		}

		if ($jenis == 'penjualan') {

			$arr2 = array('penjualan_hapus' => 0, 'DATE_FORMAT(penjualan_barang_tanggal, "%m") =' => $bulan, 'DATE_FORMAT(penjualan_barang_tanggal, "%Y") =' => $tahun);

			if ($kebun != '') {
				
				//filter kebun
				$where = array_merge($arr1, $arr2);
			}else{

				//tanpa filter kebun
				$where = $arr2;
			} 

		    $data = $this->m_laporan_penjualan->get_datatables($where);
			$total = $this->m_laporan_penjualan->count_all($where);
			$filter = $this->m_laporan_penjualan->count_filtered($where);
		}

		if ($jenis == 'pengeluaran') {

			$arr2 = array('pengeluaran_hapus' => 0, 'DATE_FORMAT(pengeluaran_barang_tanggal, "%m") =' => $bulan, 'DATE_FORMAT(pengeluaran_barang_tanggal, "%Y") =' => $tahun);

			if ($kebun != '') {
				
				//filter kebun
				$where = array_merge($arr1, $arr2);
			}else{

				//tanpa filter kebun
				$where = $arr2;
			} 

		    $data = $this->m_laporan_pengeluaran->get_datatables($where);
			$total = $this->m_laporan_pengeluaran->count_all($where);
			$filter = $this->m_laporan_pengeluaran->count_filtered($where);
		}

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
}