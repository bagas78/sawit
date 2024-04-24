
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
         
          <form class="bg-alice" action="<?=base_url('barang/save/'.@$title)?>" method="POST" accept-charset="utf-8">

            <div class="row">
              <div class="col-lg-6">

                <div class="form-group">
                  <label>Kode</label>
                  <input readonly="" type="text" name="kode" class="kode form-control" required value="<?=@$kode?>">
                </div>
                <div class="form-group">
                  <label>Kategori</label>
                  <select name="kategori" required class="form-control kategori">
                    <option value="" hidden>-- Pilih --</option> 
                    <?php foreach ($kategori_data as $v): ?>
                      <option value="<?=$v['barang_kategori_id']?>"><?=$v['barang_kategori_nama']?></option>  
                    <?php endforeach ?> 
                  </select>

                  <script type="text/javascript">
                    
                    $('.kategori').val('<?=$kategori_id?>').change().css({
                      'background': '#EEEEEE',
                      'pointer-events': 'none'
                    });

                  </script>

                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="nama form-control" required>
                </div>
                <div class="form-group">
                  <label>Satuan</label>
                  <select name="satuan" class="satuan form-control" required>
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($satuan_data as $v): ?>
                      <option value="<?=$v['satuan_id']?>"><?=$v['satuan_singkatan']?></option>  
                    <?php endforeach ?>
                  </select>
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