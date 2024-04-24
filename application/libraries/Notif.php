<?php 

class Notif {
  protected $url; 

  function __construct(){ 
        $this->url = &get_instance();
    }

    function cek(){ 

      $cek = $this->url->db->query("SELECT * FROM t_notif")->row_array();

      return $cek; 
    }
 
    function send($tujuan, $text){  

      $cek = $this->cek();
      $apikey= $cek['notif_api'];

      //send mesage

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://starsender.online/api/sendText?message='.rawurlencode($text).'&tujuan='.rawurlencode($tujuan.'@s.whatsapp.net'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'apikey: '.$apikey
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      return;

      //end
    }

    function pembelian($nomor) {

      $cek = $this->cek();
      $arr = explode(',', $cek['notif_tujuan']);

      if ($cek['notif_pembelian'] == 'on') {
        
        $db = $this->url->db->query("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id WHERE a.pembelian_nomor = '$nomor'")->result_array();

        $faktur = $db[0]['pembelian_faktur'];
        $sales = $db[0]['pembelian_sales'];
        $pembayaran = $db[0]['pembelian_status'];
        $tanggal = date_format(date_create($db[0]['pembelian_tanggal']) ,'d/m/Y');
        $keterangan = $db[0]['pembelian_keterangan'];
        $total = $db[0]['pembelian_total'];

        $text = '';
        $text .= '-- Transaksi Pembelian --';
        $text .= '%0a%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'Faktur : '.$faktur;
        $text .= '%0a';
        $text .= 'Sales : '.$sales;
        $text .= '%0a';
        $text .= 'Pembayaran : '.$pembayaran;
        $text .= '%0a';
        $text .= 'Tanggal : '.$tanggal;
        $text .= '%0a';
        $text .= 'Keterangan : '.$keterangan;
        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';

        foreach ($db as $v) {
          
          $text .= $v['pembelian_barang_qty'].' x ';
          $text .= $v['barang_nama'].' : '.number_format($v['pembelian_barang_subtotal']);
          $text .= '%0a';

        }

        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'PPN : '.$db[0]['pembelian_ppn'].'%';
        $text .= '%0a';
        $text .= 'Total : '.number_format($db[0]['pembelian_total']);

        foreach ($arr as $v) {
          
          //loop send message
          $tujuan= $v;
          $this->send($tujuan, $text);

        }

      }else{

        return;
      }

    }
    function penjualan($nomor) {

      $cek = $this->cek();
      $arr = explode(',', $cek['notif_tujuan']);

      if ($cek['notif_penjualan'] == 'on') {
      
        $db = $this->url->db->query("SELECT * FROM t_penjualan as a JOIN t_penjualan_barang as b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_barang as c ON b.penjualan_barang_barang = c.barang_id LEFT JOIN t_kontak as d ON a.penjualan_kontak = d.kontak_id WHERE a.penjualan_nomor = '$nomor'")->result_array();

        $nomor = $db[0]['penjualan_nomor'];
        $kontak = $db[0]['kontak_nama'];
        $pembayaran = $db[0]['penjualan_status'];
        $tanggal = date_format(date_create($db[0]['penjualan_tanggal']) ,'d/m/Y');
        $keterangan = $db[0]['penjualan_keterangan'];
        $total = $db[0]['penjualan_total'];

        $text = '';
        $text .= '-- Transaksi Penjualan --';
        $text .= '%0a%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'Nomor : '.$nomor;
        $text .= '%0a';
        $text .= 'Pelanggan : '.$kontak;
        $text .= '%0a';
        $text .= 'Pembayaran : '.$pembayaran;
        $text .= '%0a';
        $text .= 'Tanggal : '.$tanggal;
        $text .= '%0a';
        $text .= 'Keterangan : '.$keterangan;
        $text .= '%0a';
        $text .= '--------------------------';

        foreach ($db as $v) {
          
          $text .= '%0a';
          $text .= $v['penjualan_barang_qty'].' x ';
          $text .= $v['barang_nama'].' : '.number_format($v['penjualan_barang_subtotal']);
          $text .= '%0a';

        }

        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'PPN : '.$db[0]['penjualan_ppn'].'%';
        $text .= '%0a';
        $text .= 'Total : '.number_format($db[0]['penjualan_total']);

        foreach ($arr as $v) {
          
          //loop send message
          $tujuan= $v;
          $this->send($tujuan, $text);

        }

      }else{

        return;
      }

    }
    function reminder($kebun, $kategori, $jadwal) {
      
      $cek = $this->cek();
      $arr = explode(',', $cek['notif_tujuan']);

      if ($cek['notif_reminder'] == 'on') {

        //get database
        $db1 = $this->url->db->query("SELECT * FROM t_kebun WHERE kebun_id = '$kebun'")->row_array();
        $db2 = $this->url->db->query("SELECT * FROM t_reminder_kategori WHERE reminder_kategori_id = '$kategori'")->row_array();

        $transaksi = 'Pengingat';
        $text_kebun = $db1['kebun_nama'];
        $text_kategori = $db2['reminder_kategori_nama'];
        $text_jadwal = date_format(date_create($jadwal) ,'d/m/Y');

        $text = '-- '.$transaksi.' -- %0a%0a'.'kebun : '.$text_kebun.'%0a'.'Jenis : '.$text_kategori.'%0a'.'Tanggal : '.$text_jadwal.'%0a';

        foreach ($arr as $v) {
          
          //loop send message
          $tujuan= $v;
          $this->send($tujuan, $text);

        }

      }else{

        return;
      }

    }
    function recording($nomor) { 

      $cek = $this->cek();
      $arr = explode(',', $cek['notif_tujuan']);

      if ($cek['notif_recording'] == 'on') {
      
        $db1 = $this->url->db->query("SELECT * FROM t_recording AS a JOIN t_recording_barang AS b ON a.recording_nomor = b.recording_barang_nomor LEFT JOIN t_kebun AS c ON a.recording_kebun = c.kebun_id LEFT JOIN t_barang AS d ON b.recording_barang_barang = d.barang_id WHERE a.recording_hapus = 0 AND a.recording_nomor = '$nomor'")->result_array();

        $kebun = $db1[0]['kebun_nama'];
        $kondisi = $db1[0]['recording_kondisi'];
        $suhu = $db1[0]['recording_suhu'];
        $populasi = $db1[0]['recording_populasi'];
        $bobot = $db1[0]['recording_bobot'];
        $tanggal = date_format(date_create($db1[0]['recording_tanggal']) ,'d/m/Y');

        $text = '';
        $text .= '-- Recording Kebun --';
        $text .= '%0a%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'Tanggal : '.$tanggal;
        $text .= '%0a';
        $text .= 'kebun : '.$kebun;
        $text .= '%0a';
        $text .= 'Suhu : '.$suhu;
        $text .= '%0a';
        $text .= 'Kondisi kebun : '.$kondisi;
        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';

        //ayam
        $text .= '( Panen )';
        $text .= '%0a';
        foreach ($db1 as $v) {
          if ($v['recording_barang_kategori'] == 'panen') {
            
            $tanaman = $v['recording_tanaman'];
            $b = $this->url->db->query("SELECT * FROM t_barang as a LEFT JOIN t_satuan as b ON a.barang_satuan = b.satuan_id WHERE barang_id = '$tanaman'")->row_array();

            $text .= $v['barang_nama'].' x '.$v['recording_barang_jumlah'].' '.$b['satuan_singkatan'];
            $text .= '%0a';
          }
        }

        $text .= '--------------------------';
        $text .= '%0a';

        //ayam
        $text .= '( Pruning )';
        $text .= '%0a';
        foreach ($db1 as $v) {
          if ($v['recording_barang_kategori'] == 'pruning') {

            $text .= 'Rp. '.$v['recording_barang_jumlah'];
            $text .= '%0a';
          }
        }

        $text .= '--------------------------';
        $text .= '%0a';

        //ayam
        $text .= '( Semprot )';
        $text .= '%0a';
        foreach ($db1 as $v) {
          if ($v['recording_barang_kategori'] == 'semprot') {

            $pestisida = $v['recording_barang_barang'];
            $b = $this->url->db->query("SELECT * FROM t_barang as a LEFT JOIN t_satuan as b ON a.barang_satuan = b.satuan_id WHERE barang_id = '$pestisida'")->row_array();

            $text .= $b['barang_nama'].' x '.$v['recording_barang_jumlah'].' '.$b['satuan_singkatan'];
            $text .= '%0a';
          }
        }

        $text .= '--------------------------';
        $text .= '%0a';

        //ayam
        $text .= '( Pupuk )';
        $text .= '%0a';
        foreach ($db1 as $v) {
          if ($v['recording_barang_kategori'] == 'pupuk') {

            $pupuk = $v['recording_barang_barang'];
            $b = $this->url->db->query("SELECT * FROM t_barang as a LEFT JOIN t_satuan as b ON a.barang_satuan = b.satuan_id WHERE barang_id = '$pupuk'")->row_array();

            $text .= $b['barang_nama'].' x '.$v['recording_barang_jumlah'].' '.$b['satuan_singkatan'];
            $text .= '%0a';
          }
        }
        $text .= '--------------------------';

        foreach ($arr as $v) {
          
          //loop send message
          $tujuan= $v;
          $this->send($tujuan, $text);

        }

      }else{

        return;
      }

    }
    function print($nomor, $jenis){

      if ($jenis == 'pembelian') {
        
        $db1 = $this->url->db->query("SELECT * FROM t_pembelian as a JOIN t_kontak as b ON a.pembelian_kontak = b.kontak_id WHERE a.pembelian_nomor = '$nomor'")->row_array();
        $id = $db1['pembelian_id'];

        // pembelian
        $text = '';
        $text .= 'Silahkan buka, untuk melihat struk '.$jenis.' : ';
        $text .= base_url('pembelian/transaksi_print/'.$id);

      }else{

        $db1 = $this->url->db->query("SELECT * FROM t_penjualan as a JOIN t_kontak as b ON a.penjualan_kontak = b.kontak_id WHERE a.penjualan_nomor = '$nomor'")->row_array();
        $id = $db1['penjualan_id'];

        //penjualan
        $text = '';
        $text .= 'Silahkan buka, untuk melihat struk '.$jenis.' : ';
        $text .= base_url('penjualan/transaksi_print/'.$id);
      }

      $tujuan= $db1['kontak_tlp'];

      $this->send($tujuan, $text);

    }
    function struk_pembelian($nomor) {
      
      $db1 = $this->url->db->query("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor LEFT JOIN t_barang as c ON b.pembelian_barang_barang = c.barang_id LEFT JOIN t_kontak as d ON a.pembelian_kontak = d.kontak_id WHERE a.pembelian_nomor = '$nomor'")->result_array();

      $tanggal = date_format(date_create($db1[0]['pembelian_tanggal']), 'd/m/Y');

      $text = '';
      $text .= '-- Struk Pembelian --';
      $text .= '%0a%0a';
      $text .= 'Tanggal : '.$tanggal;
      $text .= '%0a';
      $text .= '--------------------------';

      foreach ($db1 as $v) {
          
        $text .= '%0a';
        $text .= $v['pembelian_barang_qty'].' x ';
        $text .= $v['barang_nama'].' : '.number_format($v['pembelian_barang_subtotal']);

      }

      $text .= '%0a';
      $text .= '--------------------------';
      $text .= '%0a';
      $text .= 'PPN : '.$db1[0]['pembelian_ppn'].'%';
      $text .= '%0a';
      $text .= 'Total : '.number_format($db1[0]['pembelian_total']);

      ///////////////////////// API WA ///////////////////////////////////

      $tujuan= $db1[0]['kontak_tlp'];

      $this->send($tujuan, $text);

  }

  function struk_penjualan($nomor) {
      
      $db1 = $this->url->db->query("SELECT * FROM t_penjualan as a JOIN t_penjualan_barang as b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_barang as c ON b.penjualan_barang_barang = c.barang_id LEFT JOIN t_kontak as d ON a.penjualan_kontak = d.kontak_id WHERE a.penjualan_nomor = '$nomor'")->result_array();

      $tanggal = date_format(date_create($db1[0]['penjualan_tanggal']), 'd/m/Y');

      $text = '';
      $text .= '-- Struk Penjualan --';
      $text .= '%0a%0a';
      $text .= 'Tanggal : '.$tanggal;
      $text .= '%0a';
      $text .= '--------------------------';

      foreach ($db1 as $v) {
          
        $text .= '%0a';
        $text .= $v['penjualan_barang_qty'].' x ';
        $text .= $v['barang_nama'].' : '.number_format($v['penjualan_barang_subtotal']);

      }

      $text .= '%0a';
      $text .= '--------------------------';
      $text .= '%0a';
      $text .= 'PPN : '.$db1[0]['penjualan_ppn'].'%';
      $text .= '%0a';
      $text .= 'Total : '.number_format($db1[0]['penjualan_total']);

      ///////////////////////// API WA ///////////////////////////////////

      $tujuan= $db1[0]['kontak_tlp'];

      $this->send($tujuan, $text);

  }
  function pengeluaran($nomor) {

      $cek = $this->cek();
      $arr = explode(',', $cek['notif_tujuan']);

      if ($cek['notif_pengeluaran'] == 'on') {
      
        $db = $this->url->db->query("SELECT * FROM t_pengeluaran as a JOIN t_pengeluaran_barang as b ON a.pengeluaran_nomor = b.pengeluaran_barang_nomor WHERE a.pengeluaran_nomor = '$nomor'")->result_array();

        $nomor = $db[0]['pengeluaran_nomor'];
        $tanggal = date_format(date_create($db[0]['pengeluaran_tanggal']) ,'d/m/Y');
        $keterangan = $db[0]['pengeluaran_keterangan'];
        $total = $db[0]['pengeluaran_total'];

        $text = '';
        $text .= '-- Transaksi Pengeluaran --';
        $text .= '%0a%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'Nomor : '.$nomor;
        $text .= '%0a';
        $text .= 'Keterangan : '.$keterangan;
        $text .= '%0a';
        $text .= '--------------------------';

        foreach ($db as $v) {

          $text .= '%0a';
          $text .= $v['pengeluaran_barang_jumlah'].' x ';
          $text .= $v['pengeluaran_barang_barang'].' : '.number_format($v['pengeluaran_barang_harga']);

        }

        $text .= '%0a';
        $text .= '--------------------------';
        $text .= '%0a';
        $text .= 'Total : '.number_format($db[0]['pengeluaran_total']);

        foreach ($arr as $v) {
          
          //loop send message
          $tujuan= $v;
          $this->send($tujuan, $text);

        }

      }else{

        return;
      }

    }
}