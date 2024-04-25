<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<style type="text/css">
  .box-style{
    background: white; 
    color: #999;
    border-width: 5px;
    border-style: solid;
    border-color: whitesmoke;
  }
  .box-style:hover{
    background: lightgrey;
  }
  .tit{ 
    max-width: fit-content; 
    background: black;
    padding: 0.5%;
    color: white; 
  } 
</style>
 
    <!-- Main content --> 
    <section class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <a href="<?=base_url('barang/ayam')?>">
            <div class="small-box box-style" style="padding: 8px;">
              <div class="inner">
                <h3 style="font-size: 28px;"><?=@number_format($sawit_).' '.$sawit_satuan_;?> </h3>

                <p>TOTAL SAWIT</p>
              </div>
              <div class="icon" style="top: -20px;">
                <img width="80" height="80" src="<?=base_url('assets/gambar/sawit.png')?>">
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <a href="<?=base_url('barang/pakan')?>">
            <div class="small-box box-style" style="padding: 8px;">
              <div class="inner">
                <h3 style="font-size: 28px;"><?=@number_format($pupuk_).' '.$pupuk_satuan_;?></h3>

                <p>TOTAL PUPUK</p>
              </div>
              <div class="icon" style="top: -20px">
                <img width="80" height="80" src="<?=base_url('assets/gambar/pupuk.png')?>">
              </div>
            </div>
          </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <a href="<?=base_url('barang/obat')?>">
            <div class="small-box box-style" style="padding: 8px;">
              <div class="inner">
                <h3 style="font-size: 28px;"><?=@number_format($pestisida_).' '.$pestisida_satuan_;?></h3>

                <p>TOTAL PESTISIDA</p>
              </div>
              <div class="icon" style="top: -20px;">
                <img width="80" height="80" src="<?=base_url('assets/gambar/pestisida.png')?>">
              </div>
            </div>
          </div>
        </a>
        <!-- ./col -->
      </div>

      <!-- grafik -->

      <div class="box">
        <div class="box-header with-border">

          <div class="col-md-1 col-xs-3">
            <form method="POST" action="">
              <input type="hidden" name="filter" value="1">
              <button type="submit" class="btn btn-default <?=(@$filter == 1)?'active':'' ?>">Harian <i class="fa fa-filter"></i></button>
            </form>
          </div>
          <div class="col-md-1 col-xs-3">
            <form method="POST" action="">
              <input type="hidden" name="filter" value="2">
              <button type="submit" class="btn btn-default <?=(@$filter == 2)?'active':'' ?>">Bulanan <i class="fa fa-filter"></i></button>
            </form>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <h3 align="center">Grafik Pembelian | Penjualan | Pengeluaran <b><?=($filter == 1)? date('M Y'):'Tahun '.date('Y')?></b></h3>
          <canvas id="myChart"></canvas>

        </div>
      </div>

      <!-- end grafik -->

      <div class="box">
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      
          <h4 class="tit"><?=strtoupper('JADWAL REMINDER')?></h4>

        <!-- <a style="color: black;" href="<?=base_url('vaksin/ayam')?>"> -->
          <table class="example3 table table-bordered table-responssive display nowrap" style="width: 100%;">
            <thead>
              <tr>
                <th>Kebun</th>
                <th>Kategori</th>
                <th width="120">Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($reminder_data as $reminder): ?>

                <tr>
                  <td><?=@$reminder['kebun_nama']?></td>
                  <td><?=@$reminder['reminder_kategori_nama']?></td>
                  <td class="bg-red"><?=date_format(date_create(@$reminder['reminder_tanggal']), 'd/m/Y');?></td>
                </tr>
              <?php $no++; ?>
              <?php endforeach ?>
            </tbody>
          </table>
        <!-- </a> -->

        </div>
        <!-- /.box-body -->
      </div>

      <div class="box">
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      
          <h4 class="tit"><?=strtoupper('PEFORMA KARYAWAN '.date('M Y'))?></h4>

          <table class="example3 table table-bordered table-responssive display nowrap" style="width: 100%;">
            <thead>
              <tr>
                <th width="100">Peringkat</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Masuk</th>
                <th>Tidak Masuk</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($peforma as $value): ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$value['nama']?></td>
                  <td><?=$value['pekerjaan']?></td>
                  <td><?=$value['masuk']?></td>
                  <td><?=$value['tidak']?></td>
                </tr>
              <?php $no++; ?>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>
        <!-- /.box-body -->
      </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: [

      <?php if ($filter == 2): ?>
        
        //bulanan
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'

      <?php else: ?>

        //harian
        <?php for ($i=1; $i < $hari + 1; $i++):?>

          <?php echo $i.','; ?>

        <?php endfor ?>
        
      <?php endif ?>

      ],
      datasets: [{
        label: 'Pembelian',
        data: [
                
                <?php if ($filter == 2): ?>

                  //bulanan
                  <?php foreach ($pembelian_data as $v): ?>

                    <?php for ($i=1; $i < 13; $i++):?>
                      
                      <?php if ($v['bulan'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endfor ?>

                  <?php endforeach ?>

                <?php else: ?>

                  //harian
                  <?php foreach ($pembelian_data as $v): ?>

                    <?php for ($i=1; $i < $hari + 1; $i++):?>

                      <?php if ($v['tanggal'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endfor ?>

                  <?php endforeach ?>

                <?php endif ?>

              ],
        borderWidth: 1
      },
      {
        label: 'Penjualan',
        data: [
                
                <?php if ($filter == 2): ?>

                  //bulanan
                  <?php foreach ($penjualan_data as $v): ?>

                    <?php for ($i=1; $i < 13; $i++):?>
                      
                      <?php if ($v['bulan'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endfor ?>

                  <?php endforeach ?>

                <?php else: ?>

                  //harian
                  <?php foreach ($penjualan_data as $v): ?>

                    <?php for ($i=1; $i < $hari + 1; $i++):?>

                      <?php if ($v['tanggal'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endfor ?>

                  <?php endforeach ?>

                <?php endif ?>

              ],
        borderWidth: 1
      },
      {
        label: 'Pengeluaran',
        data: [
                
                <?php if ($filter == 2): ?>

                  //bulanan
                  <?php foreach ($pengeluaran_data as $v): ?>

                    <?php for ($i=1; $i < 13; $i++):?>                      
  
                      <?php if ($v['bulan'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endfor ?>

                  <?php endforeach ?>

                <?php else: ?>

                  //harian
                  <?php foreach ($pengeluaran_data as $v): ?>
                    
                    <?php for ($i=1; $i < $hari + 1; $i++):?>

                      <?php if ($v['tanggal'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endfor ?>

                  <?php endforeach ?>

                <?php endif ?>

              ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
