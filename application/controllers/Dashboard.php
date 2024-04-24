<?php
class Dashboard extends CI_Controller{

	function __construct(){  
		parent::__construct(); 
	} 
	function index(){  
		if ( $this->session->userdata('login') == 1) {

			$data['dashboard'] = 'class="active"';  
		    $data['title'] = 'Dashboard';  

		    //data
		    $get = $this->db->query("SELECT a.barang_kategori_nama AS nama,SUM(b.barang_stok) AS stok, c.satuan_singkatan AS satuan FROM t_barang_kategori AS a LEFT JOIN t_barang AS b ON a.barang_kategori_id = b.barang_kategori LEFT JOIN t_satuan AS c ON b.barang_satuan = c.satuan_id WHERE b.barang_hapus = 0 GROUP BY a.barang_kategori_id")->result_array();

		    //telur
		   	$data['sawit_'] = $get[0]['stok'];
		   	$data['pupuk_'] = $get[1]['stok'];
		   	$data['pestisida_'] = $get[2]['stok']; 

		   	//satuan
		   	$data['sawit_satuan_'] = $get[0]['satuan'];
		   	$data['pupuk_satuan_'] = $get[1]['satuan'];
		   	$data['pestisida_satuan_'] = $get[2]['satuan'];

		   	//peforma
		   	$bulan = date('Y-m');
		   	$data['peforma'] = $this->db->query("SELECT karyawan_nama AS nama ,SUM(CASE WHEN absen_status = 'masuk' THEN 1 ELSE 0 END) AS masuk, SUM(CASE WHEN absen_status = 'tidak' THEN 1 ELSE 0 END) AS tidak, pekerjaan_nama as pekerjaan FROM t_karyawan AS a LEFT JOIN t_absen AS b ON a.karyawan_id = b.absen_karyawan LEFT JOIN t_pekerjaan as c ON a.karyawan_pekerjaan = c.pekerjaan_id WHERE a.karyawan_hapus = 0 AND DATE_FORMAT(b.absen_tanggal, '%Y-%m') = '$bulan' GROUP BY a.karyawan_id ORDER BY masuk DESC")->result_array();

		   	//reminderasi
		   	$data['reminder_data'] = $this->db->query("SELECT * FROM t_reminder AS a JOIN t_kebun AS b ON a.reminder_kebun = b.kebun_id JOIN t_reminder_kategori as c ON a.reminder_kategori = c.reminder_kategori_id WHERE a.reminder_hapus = 0 AND a.reminder_status = 0")->result_array();

		   	//GRAFIK
		   	$tahun = date('Y');

			if (@$_POST['filter'] == 2) {

				//bulanan

				//filter
				$data['filter'] = 2;

				//pembelian
				$data['pembelian_data'] = $this->query_builder->view("SELECT SUM(pembelian_total) AS total, DATE_FORMAT(pembelian_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(pembelian_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(pembelian_tanggal, '%m'), '0','') AS bulan FROM t_pembelian WHERE pembelian_hapus = 0 AND DATE_FORMAT(pembelian_tanggal, '%Y') = '$tahun' GROUP BY DATE_FORMAT(pembelian_tanggal, '%m')");

				//penjualan
				$data['penjualan_data'] = $this->query_builder->view("SELECT SUM(penjualan_total) AS total, DATE_FORMAT(penjualan_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(penjualan_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(penjualan_tanggal, '%m'), '0','') AS bulan FROM t_penjualan WHERE penjualan_hapus = 0 AND DATE_FORMAT(penjualan_tanggal, '%Y') = '$tahun' GROUP BY DATE_FORMAT(penjualan_tanggal, '%m')");		

				//pengeluaran
				$data['pengeluaran_data'] = $this->query_builder->view("SELECT SUM(pengeluaran_total) AS total, DATE_FORMAT(pengeluaran_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(pengeluaran_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(pengeluaran_tanggal, '%m'), '0','') AS bulan FROM t_pengeluaran WHERE pengeluaran_hapus = 0 AND DATE_FORMAT(pengeluaran_tanggal, '%Y') = '$tahun' GROUP BY DATE_FORMAT(pengeluaran_tanggal, '%m')");				

			}else{

				//harian

				$data['filter'] = 1;

				//pembelian
				$data['pembelian_data'] = $this->query_builder->view("SELECT SUM(pembelian_total) AS total, DATE_FORMAT(pembelian_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(pembelian_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(pembelian_tanggal, '%m'), '0','') AS bulan FROM t_pembelian WHERE pembelian_hapus = 0 AND DATE_FORMAT(pembelian_tanggal, '%Y') = '$tahun' GROUP BY pembelian_tanggal");


				//penjualan
				$data['penjualan_data'] = $this->query_builder->view("SELECT SUM(penjualan_total) AS total, DATE_FORMAT(penjualan_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(penjualan_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(penjualan_tanggal, '%m'), '0','') AS bulan FROM t_penjualan WHERE penjualan_hapus = 0 AND DATE_FORMAT(penjualan_tanggal, '%Y') = '$tahun' GROUP BY penjualan_tanggal");


				//pengeluaran
				$data['pengeluaran_data'] = $this->query_builder->view("SELECT SUM(pengeluaran_total) AS total, DATE_FORMAT(pengeluaran_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(pengeluaran_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(pengeluaran_tanggal, '%m'), '0','') AS bulan FROM t_pengeluaran WHERE pengeluaran_hapus = 0 AND DATE_FORMAT(pengeluaran_tanggal, '%Y') = '$tahun' GROUP BY pengeluaran_tanggal");
			}

			$y = date('Y');
			$m = date('m');

			$date1 = strtotime($y.'-'.$m);
			$date2 = strtotime($y.'-'.($m + 1));
			$diff = $date2 - $date1;
			$days = floor($diff / (60 * 60 * 24));

			$data['hari'] = $days;

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('dashboard/dashboard');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
}