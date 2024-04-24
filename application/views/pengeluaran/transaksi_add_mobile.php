<style type="text/css">
  
  .bg-card{
    background: #f4f4f4;
    margin-top: 10px;
    margin-right: 1px;
    margin-left: 1px; 
    padding-bottom: 15px;
  }

</style>


    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">

          <br/>

          <div hidden align="left" class="back">
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn bg-navy"><i class="fa fa-arrow-left"></i> Kembali</button></a>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div>
        <div class="box-body" style="padding: 0;">
          
          <form action="<?=base_url('pengeluaran/transaksi_save');?>" method="post">
              
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nomor</label>
                    <input type="text" required readonly="" name="nomor" class="nomor form-control" value="<?=@$nomor?>">
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                  <label>Lampiran</label>
                  <input type="file" name="lampiran" class="lampiran form-control" value="">
                </div> 
                </div>
              </div>

              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="keterangan form-control"></textarea>
                  </div>
                </div>
              </div>
            </div>

              <div class="clearfix"></div>

              <div class="col-md-12">

                <div class="row">

                  <div class="col-xs-12 col-sm-12">
                    <button type="button" onclick="clone()" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </div>
                  
                </div>

                <div id="paste">

              <div class="row bg-card" id="copy">

                <div class="col-xs-12 col-sm-12"><hr></div>

                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control kategori" name="kategori[]" required>
                      <option value="" hidden>-- Pilih --</option>
                      <?php foreach ($kategori_data as $v): ?>
                        <option value="<?=@$v['pengeluaran_kategori_id']?>"><?=@$v['pengeluaran_kategori_nama']?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Barang</label>
                    <input required type="text" name="barang[]" class="form-control barang" placeholder="Nama Barang">
                  </div>
                </div>

                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah[]" class="jumlah form-control" required min="1" value="0">
                  </div>
                </div>

                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Harga</label>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input type="number" name="harga[]" class="harga form-control" required min="1" value="0" step="0.01">
                    </div>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12">
                  <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy').remove()"><i class="fa fa-minus"></i></button>
                </div>
              <!-- copy -->
              </div>

              <br/>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <div class="form-group">
                    <label>Total Akhir</label>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <td><input id="total" readonly="" type="text" name="total" class="form-control" value="0" min="0"></td>
                    </div>
                  </div>
                </div>

              </div>

              <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                <a href="<?= @$_SERVER['HTTP_REFERER'] ?>">
              <button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

              <div class="clearfix"></div><br/>

            <!-- paste -->
            </div>

          </form>          

        </div>
      </div>
      <!-- /.box -->

<script type="text/javascript">

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());

    //reset value
    $('#copy').find('select').val('').change();
    $('#copy').find('input').val(0);
    $('#copy').find('.barang').val('');
  }

  function auto(){

    //subtotal
    var harga = 0;
    $.each($('.harga'), function(index, val) {

      harga += Number($(this).val());

    });

    var jumlah = 0;
    $.each($('.jumlah'), function(index, val) {

      jumlah += Number($(this).val());

    });

    //qty akhir
    $('#total').val(jumlah * harga);

    //border none
    $('td').css('border-top', 'none');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
