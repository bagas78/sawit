<?php 
class Pengeluaran extends CI_Controller{

	function __construct(){
		parent::__construct(); 
		$this->load->model('m_pengeluaran');
		$this->load->model('m_pengeluaran_kategori');
	} 
	function transaksi(){  
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Pengeluaran';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/transaksi');
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
			$where = array('pengeluaran_hapus' => 0);
		}else{
			//user
			$where = array('pengeluaran_hapus' => 0, 'pengeluaran_user' => $user);
		}

	    $data = $this->m_pengeluaran->get_datatables($where);
		$total = $this->m_pengeluaran->count_all($where);
		$filter = $this->m_pengeluaran->count_filtered($where);

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
			$data['title'] = 'Pengeluaran';

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_pengeluaran_kategori WHERE pengeluaran_kategori_hapus = 0");

			//generate nomor
			$get = $this->query_builder->count("SELECT * FROM t_pengeluaran");
			$data['nomor'] = 'PG-'.date('dmy').'-'.($get + 1);

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/'.$this->ui->view('transaksi_add'));
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function transaksi_save(){

		$nomor = strip_tags($_POST['nomor']);

		//upload lampiran
		if (@$_FILES['lampiran']['name']) {
			
			//replace Karakter name foto
	        $filename = $_FILES['lampiran']['name'];

	        //replace name foto
	        $type = explode(".", $filename);
	        $no = count($type) - 1;
	        $new_name = md5($i.time()).'.'.$type[$no];

			//config uplod foto
			  $config = array(
			  'upload_path' 	=> './assets/lampiran',
			  'allowed_types' 	=> "gif|jpg|png|jpeg",
			  'overwrite' 		=> TRUE,
			  'file_name'       => $new_name,
			  );

			//upload foto
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('lampiran')) {

				//sukses upload
			    $lampiran = $new_name;

			}else{

				//gagal upload
				$lampiran = '';
			}
			
		}else{

			//foto kosong
			$lampiran = '';
		}

		//pembelian
		$set1 = array(
						'pengeluaran_kebun' => $this->session->userdata('kebun'),	
						'pengeluaran_user' => $this->session->userdata('id'),
						'pengeluaran_nomor' => $nomor,
						'pengeluaran_keterangan' => strip_tags($_POST['keterangan']),
						'pengeluaran_lampiran' => $lampiran,
						'pengeluaran_total' => strip_tags(str_replace(',', '', $_POST['total'])),
					);

		$save = $this->query_builder->add('t_pengeluaran',$set1);

		if ($save == 1) {
			
			$num = count($_POST['barang']);

			for ($i = 0; $i < $num; ++$i) {
				
				//barang
				$set2 = array(
								'pengeluaran_barang_nomor' => $nomor,
								'pengeluaran_barang_kategori' => strip_tags($_POST['kategori'][$i]),
								'pengeluaran_barang_barang' => strip_tags($_POST['barang'][$i]),
								'pengeluaran_barang_jumlah' => strip_tags(str_replace(',', '', $_POST['jumlah'][$i])),
								'pengeluaran_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
							);

				$this->query_builder->add('t_pengeluaran_barang',$set2);	
			}


			$this->notif->pengeluaran($nomor);

			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pengeluaran/transaksi'));
	}
	function transaksi_delete($id){

		$set = ['pengeluaran_hapus' => 1];
		$where = ['pengeluaran_id' => $id];
		$del = $this->query_builder->update('t_pengeluaran',$set,$where);
		if ($del == 1) {
			
			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pengeluaran/transaksi'));

	}
	function transaksi_print($id){
		$data['title'] = 'Pengeluaran';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_pengeluaran as a JOIN t_pengeluaran_barang as b ON a.pengeluaran_nomor = b.pengeluaran_barang_nomor JOIN t_user as d ON a.pengeluaran_user = d.user_id WHERE a.pengeluaran_id = '$id'");
		$this->load->view('pengeluaran/transaksi_print',$data);
	}
	function transaksi_view($id){

		if ( $this->session->userdata('login') == 1) {

			$data['title'] = 'Pengeluaran';
			$data['view'] = '1';

			//kategori
			$data['kategori_data'] = $this->query_builder->view("SELECT * FROM t_pengeluaran_kategori WHERE pengeluaran_kategori_hapus = 0");

			//data
			$data['data'] = $this->query_builder->view("SELECT * FROM t_pengeluaran as a JOIN t_pengeluaran_barang as b ON a.pengeluaran_nomor = b.pengeluaran_barang_nomor JOIN t_user as d ON a.pengeluaran_user = d.user_id WHERE a.pengeluaran_id = '$id'");

			
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/'.$this->ui->view('transaksi_add'));
		    $this->load->view('pengeluaran/transaksi_edit');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function kategori(){

		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Kategori';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/kategori');
		    $this->load->view('v_template_admin/admin_footer');
 
		} 
		else{
			redirect(base_url('login')); 
		}
	}
	function kategori_get(){

		$where = array('pengeluaran_kategori_hapus' => 0);

		$data = $this->m_pengeluaran_kategori->get_datatables($where);
		$total = $this->m_pengeluaran_kategori->count_all($where);
		$filter = $this->m_pengeluaran_kategori->count_filtered($where);

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
		if ( $this->session->userdata('login') == 1) {
			$data['title'] = 'Kategori';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/kategori_add');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function kategori_save(){

		$set = array(
						'pengeluaran_kategori_nama' => strip_tags(@$_POST['nama']),
						'pengeluaran_kategori_keterangan' => strip_tags(@$_POST['keterangan']), 
					);

		$save = $this->query_builder->add('t_pengeluaran_kategori',$set);

		if ($save == 1) {

			$this->session->set_flashdata('success','Data berhasil di simpan');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('pengeluaran/kategori'));
	}
	function kategori_edit($id){

		if ( $this->session->userdata('login') == 1) {

			$data['title'] = 'Kategori';

			//data
			$data['data'] = $this->query_builder->view_row("SELECT * FROM t_pengeluaran_kategori WHERE pengeluaran_kategori_id = '$id'");

			
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengeluaran/kategori_add');
		    $this->load->view('pengeluaran/kategori_edit');
		    $this->load->view('v_template_admin/admin_footer');

		} 
		else{
			redirect(base_url('login'));
		}
	}
	function kategori_update($id){

		$set = array(
						'pengeluaran_kategori_nama' => strip_tags(@$_POST['nama']),
						'pengeluaran_kategori_keterangan' => strip_tags(@$_POST['keterangan']), 
					);

		$where = ['pengeluaran_kategori_id' => $id];
		$save = $this->query_builder->update('t_pengeluaran_kategori',$set,$where);

		if ($save == 1) {

			$this->session->set_flashdata('success','Data berhasil di rubah');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pengeluaran/kategori'));
	}
	function kategori_delete($id){

		$set = ['pengeluaran_kategori_hapus' => 1];
		$where = ['pengeluaran_kategori_id' => $id];
		$save = $this->query_builder->update('t_pengeluaran_kategori',$set,$where);

		if ($save == 1) {

			$this->session->set_flashdata('success','Data berhasil di hapus');

		} else {

			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pengeluaran/kategori'));
	}
}