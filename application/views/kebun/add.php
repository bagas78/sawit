
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <form class="bg-alice" action="<?=base_url('kandang/save')?>" method="POST" accept-charset="utf-8">
            
            <!--hidden-->
            <input type="hidden" name="jenis" value="<?=@$jenis?>">

            <div class="row">
              <div class="col-lg-6">

                <div class="form-group">
                  <label>Kode Kandang</label>
                  <input readonly="" type="text" name="kode" class="kode form-control" required value="<?=@$kode?>">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="nama form-control" required>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="alamat form-control" required></textarea>
                </div>

              </div>

              <div class="col-lg-6">
              
                <div class="form-group">
                  <label>Luas ( m2 )</label>
                  <input type="number" name="luas" class="luas form-control" required>
                </div>
                <div class="form-group">
                  <label>Tanaman</label>
                  <select class="form-control tanaman" name="tanaman" required>
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach (@$tanaman_data as $v): ?>
                      <option value="<?=$v['barang_id']?>"><?=$v['barang_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="keterangan" class="keterangan form-control" required></textarea>
                </div>
                
              </div>
            </div>

            <br/>

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>

        
      </div>
      <!-- /.box -->