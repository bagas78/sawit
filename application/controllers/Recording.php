<?php
class Recording extends CI_Controller{
 
	function __construct(){  
		parent::__construct(); 
		$this->load->model('m_recording');
	}  
	function harian(){  
		$data['title'] = 'Recording Harian'; 
 
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('recording/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function harian_get(){ 

		$level = $this->session->userdata('level');
		$user = $this->session->userdata('id');

		if ($level == 1) {
			//admin
			$where = array('recording_hapus' => 0);
		}else{
			//user
			$where = array('recording_hapus' => 0, 'recording_user' => $user);
		}

	    $data = $this->m_recording->get_datatables($where);
		$total = $this->m_recording->count_all($where);
		$filter = $this->m_recording->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function get_kebun($id){

		$data = $this->query_builder->view_row("SELECT b.barang_nama AS tanaman, b.barang_id AS id, c.satuan_singkatan AS satuan FROM t_kebun AS a JOIN t_barang AS b ON a.kebun_tanaman = b.barang_id LEFT JOIN t_satuan AS c ON b.barang_satuan = c.satuan_id WHERE a.kebun_id = '$id'");
		echo json_encode($data);
	}
	function get_satuan($id){

		$data = $this->query_builder->view_row("SELECT b.satuan_singkatan AS satuan, a.barang_stok AS stok FROM t_barang AS a JOIN t_satuan AS b ON a.barang_satuan = b.satuan_id WHERE a.barang_id = '$id'");
		echo json_encode($data);
	}
	function harian_add(){

		//kandang
		$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

		//obat
		$data['pestisida_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		//pupuk
		$data['pupuk_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 2");

		//generate nomor
		$get = $this->query_builder->count("SELECT * FROM t_recording");
		$data['nomor'] = 'RC-'.date('dmy').'-'.($get + 1);

		$data['title'] = 'Recording Harian';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('recording/'.$this->ui->view('add'));
	    $this->load->view('v_template_admin/admin_footer');
	}
	
	function save(){

		//generate nomor
		$get = $this->query_builder->count("SELECT * FROM t_recording");
		$nomor = 'RC-'.date('dmy').'-'.($get + 1);

		$tanaman = strip_tags(@$_POST['tanaman']);

		$set = array(
						'recording_nomor' => $nomor,
						'recording_user' => $this->session->userdata('id'),
						'recording_tanggal' => strip_tags(@$_POST['tanggal']),
						'recording_kebun' => strip_tags(@$_POST['kebun']),
						'recording_tanaman' => $tanaman,
						'recording_suhu' => strip_tags(@$_POST['suhu']),
						'recording_kondisi' => strip_tags(@$_POST['kondisi']),
					);

		$db = $this->query_builder->add('t_recording', $set);
		if ($db == 1) {

			//save panen
			if (@$_POST['panen']) {
				
				$panen = count($_POST['panen']);

				for ($i = 0; $i < $panen; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $tanaman, 'recording_barang_jumlah' => $_POST['panen'][$i], 'recording_barang_kategori' => $_POST['panen_kategori'][$i]]);
				}				
			}


			//save pruning
			if (@$_POST['pruning']) {
				
				$pruning = count($_POST['pruning']);

				for ($i = 0; $i < $pruning; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_jumlah' => $_POST['pruning'][$i], 'recording_barang_kategori' => $_POST['pruning_kategori'][$i]]);
				}				
			}


			//save semprot
			if (@$_POST['semprot']) {

				$semprot = count($_POST['semprot']);
				
				for ($i = 0; $i < $semprot; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['semprot'][$i], 'recording_barang_jumlah' => $_POST['semprot_jumlah'][$i], 'recording_barang_stok' => $_POST['semprot_stok'][$i], 'recording_barang_kategori' => $_POST['semprot_kategori'][$i]]);
				}	
			}
			

			//save pupuk
			if (@$_POST['pupuk']) {

				$pupuk = count($_POST['pupuk']);
				
				for ($i = 0; $i < $pupuk; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['pupuk'][$i], 'recording_barang_stok' => $_POST['pupuk_stok'][$i], 'recording_barang_jumlah' => $_POST['pupuk_jumlah'][$i], 'recording_barang_kategori' => $_POST['pupuk_kategori'][$i]]);
				}	
			}

			//update stok
			$this->stok->update_barang();

			//notif
			$this->notif->recording($nomor);			

			$this->session->set_flashdata('success', 'Data berhasil di simpan');
		}else{
			$this->session->set_flashdata('gagal', 'Data gagal di simpan');
		}

		redirect(base_url('recording/harian'));
	}
	function delete($id){

		$set = ['recording_hapus' => 1];
		$where = ['recording_id' => $id];
		$db = $this->query_builder->update('t_recording',$set,$where);
		
		if ($db == 1) {

			//update stok
			$this->stok->update_barang();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('recording/harian'));
	}
	function harian_view($id){

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_recording WHERE recording_id = '$id'");

		//data_barang
		$data['data_barang'] = $this->query_builder->view("SELECT * FROM t_recording AS a JOIN t_recording_barang AS b ON a.recording_nomor = b.recording_barang_nomor WHERE a.recording_id = '$id'");

		//kandang
		$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

		//obat
		$data['pestisida_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		//pupuk
		$data['pupuk_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 2");

		$data['title'] = 'Recording Harian';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('recording/'.$this->ui->view('add'));
	    $this->load->view('recording/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function harian_edit($id){

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_recording WHERE recording_id = '$id'");

		//data_barang
		$data['data_barang'] = $this->query_builder->view("SELECT * FROM t_recording AS a JOIN t_recording_barang AS b ON a.recording_nomor = b.recording_barang_nomor WHERE a.recording_id = '$id'");

		//kandang
		$data['kebun_data'] = $this->query_builder->view("SELECT * FROM t_kebun WHERE kebun_hapus = 0");

		//obat
		$data['pestisida_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 3");

		//pupuk
		$data['pupuk_data'] = $this->query_builder->view("SELECT * FROM t_barang WHERE barang_hapus = 0 AND barang_kategori = 2");

		$data['title'] = 'Recording Harian';

		$data['edit'] = 1;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('recording/'.$this->ui->view('add'));
	    $this->load->view('recording/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$nomor = strip_tags(@$_POST['nomor']);
		$tanaman = strip_tags(@$_POST['tanaman']);

		$set = array(
						'recording_user' => $this->session->userdata('id'),
						'recording_tanggal' => strip_tags(@$_POST['tanggal']),
						'recording_kebun' => strip_tags(@$_POST['kebun']),
						'recording_tanaman' => $tanaman,
						'recording_suhu' => strip_tags(@$_POST['suhu']),
						'recording_kondisi' => strip_tags(@$_POST['kondisi']),
					);

		$where = ['recording_id' => $id];
		$db = $this->query_builder->update('t_recording',$set,$where);
		if ($db == 1) {

			//delete
			$this->query_builder->delete('t_recording_barang',['recording_barang_nomor' => $nomor]);

			//save panen
			if (@$_POST['panen']) {
				
				$panen = count($_POST['panen']);

				for ($i = 0; $i < $panen; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $tanaman, 'recording_barang_jumlah' => $_POST['panen'][$i], 'recording_barang_kategori' => $_POST['panen_kategori'][$i]]);
				}				
			}


			//save pruning
			if (@$_POST['pruning']) {
				
				$pruning = count($_POST['pruning']);

				for ($i = 0; $i < $pruning; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_jumlah' => $_POST['pruning'][$i], 'recording_barang_kategori' => $_POST['pruning_kategori'][$i]]);
				}				
			}


			//save semprot
			if (@$_POST['semprot']) {

				$semprot = count($_POST['semprot']);
				
				for ($i = 0; $i < $semprot; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['semprot'][$i], 'recording_barang_jumlah' => $_POST['semprot_jumlah'][$i], 'recording_barang_stok' => $_POST['semprot_stok'][$i], 'recording_barang_kategori' => $_POST['semprot_kategori'][$i]]);
				}	
			}
			

			//save pupuk
			if (@$_POST['pupuk']) {

				$pupuk = count($_POST['pupuk']);
				
				for ($i = 0; $i < $pupuk; ++$i) {
				
					$this->query_builder->add('t_recording_barang', ['recording_barang_nomor' => $nomor, 'recording_barang_barang' => $_POST['pupuk'][$i], 'recording_barang_stok' => $_POST['pupuk_stok'][$i], 'recording_barang_jumlah' => $_POST['pupuk_jumlah'][$i], 'recording_barang_kategori' => $_POST['pupuk_kategori'][$i]]);
				}	
			}

			//update stok
			$this->stok->update_barang();

			$this->session->set_flashdata('success', 'Data berhasil di simpan');
		}else{
			$this->session->set_flashdata('gagal', 'Data gagal di simpan');
		}

		redirect(base_url('recording/harian'));
	}
}