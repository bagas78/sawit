
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
         
          <form class="bg-alice" action="<?=base_url('karyawan/save')?>" method="POST" accept-charset="utf-8">
            
            <!--hidden-->
            <input type="hidden" name="jenis" value="<?=@$jenis?>">

            <div class="row">
              <div class="col-lg-6">

                <div class="form-group">
                  <label>Kode Kandang</label>
                  <input readonly="" type="text" name="kode" class="kode form-control" required value="<?=@$kode?>">
                </div>
                <div class="form-group">
                  <label>Pekerjaan</label>
                  <select name="pekerjaan" class="pekerjaan form-control" required>
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($pekerjaan_data as $val): ?>
                      <option value="<?=@$val['pekerjaan_id']?>"><?=@$val['pekerjaan_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="nama form-control" required>
                </div>
                <div class="form-group">
                  <label>No Hp / telp</label>
                  <input type="number" name="telp" class="telp form-control" required>
                </div>

              </div>

              <div class="col-lg-6">
              
                <div class="form-group">
                  <label>Kandang</label>
                  <select name="kandang" class="kandang form-control" required>
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($kandang_data as $val): ?>
                      <option value="<?=@$val['kandang_id']?>"><?=@$val['kandang_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jenis</label>
                  <select name="jenis" class="jenis form-control" required>
                    <option value="" hidden>-- Pilih --</option>
                    <option value="b">Borongan</option>
                    <option value="h">Harian</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Upah</label>
                  <input type="number" name="upah" class="upah form-control" required>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="alamat form-control" required></textarea>
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