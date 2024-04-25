<?php
class Monitoring extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('m_recording_data');
	}  
	function view($kategori){
		$data['title'] = 'Monitoring '.$kategori;
		
		$filter = @$_POST['filter'];
		if (@!$filter) {
			$data['filter'] = date('Y-m');

			//filter tanggal
			$y = date('Y');
			$m = date('m');
			$f = $y.'-'.$m;

		}else{
			$data['filter'] = $filter;

			//filter tanggal
			$y = date_format(date_create($filter), 'Y');
			$m = date_format(date_create($filter), 'm');
			$f = $y.'-'.$m;
		}

		//grafik
		$data['grafik_data'] = $this->query_builder->view("SELECT DATE_FORMAT(a.recording_tanggal, '%d') AS tanggal, DATE_FORMAT(a.recording_tanggal, '%m') AS bulan, b.recording_barang_jumlah AS jumlah FROM t_recording AS a JOIN t_recording_barang AS b ON a.recording_nomor = b.recording_barang_nomor WHERE a.recording_hapus = 0 AND DATE_FORMAT(a.recording_tanggal, '%Y-%m') = '$f' AND b.recording_barang_kategori = '$kategori'");

		//hitung hari perbulan
		$date1 = strtotime($y.'-'.$m);
		$date2 = strtotime($y.'-'.($m + 1));
		$diff = $date2 - $date1;
		$days = floor($diff / (60 * 60 * 24));

		$data['hari'] = $days;
		$data['kategori'] = $kategori;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('monitoring/'.$kategori);
	    $this->load->view('v_template_admin/admin_footer');

		// echo '<pre>';
	 //    print_r($data['grafik_data']);
	}
	function get_data($kategori, $filter){

		$where = array('DATE_FORMAT(recording_tanggal, "%Y-%m") = ' => $filter,'recording_barang_kategori' => $kategori, 'recording_hapus' => 0);

	    $data = $this->m_recording_data->get_datatables($where);
		$total = $this->m_recording_data->count_all($where);
		$filter = $this->m_recording_data->count_filtered($where);

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
