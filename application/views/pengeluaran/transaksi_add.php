<style type="text/css">
  .lm{
    background: #3c8dbc;
    padding: 0.5% 1% 0.5% 1%;
    border-radius: 5px;
    color: white;
  }
</style>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border"> 

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
        <div class="box-body">
          
          <form action="<?=base_url('pengeluaran/transaksi_save');?>" method="post" enctype="multipart/form-data">
              
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nomor</label>
                  <input type="text" required readonly="" name="nomor" class="nomor form-control" value="<?=@$nomor?>">
                </div>
                <div class="form-group">
                  <label>Lampiran</label>
                  <input type="file" name="lampiran" class="lampiran form-control" value="">
                </div>              
              </div>
              <div class="col-md-6"> 
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="keterangan" class="keterangan form-control"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th>Kategori</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th width="1"><button type="button" onclick="clone()" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>
                  <tbody id="paste">
                    <tr id="copy">
                      <td>
                        <select class="form-control kategori" name="kategori[]" required>
                          <option value="" hidden>-- Pilih --</option>
                          <?php foreach ($kategori_data as $v): ?>
                            <option value="<?=@$v['pengeluaran_kategori_id']?>"><?=@$v['pengeluaran_kategori_nama']?></option>
                          <?php endforeach ?>
                        </select>
                      </td>
                      <td>
                        <input required type="text" name="barang[]" class="form-control barang" placeholder="Nama Barang">
                      </td>
                      <td>
                        <input type="number" name="jumlah[]" class="jumlah form-control" required min="1" value="0" step="0.01">
                      </td>
                      <td>
                        <div class="input-group">
                          <span class="input-group-addon">Rp</span>
                          <input type="number" name="harga[]" class="harga form-control" required min="1" value="0" step="0.01">
                        </div>
                      </td>
                      <td>
                        <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="2"></td>
                      <td align="right">Total Akhir</td>
                      <td>
                        <div class="input-group">
                          <span class="input-group-addon">Rp</span>
                          <input id="total"  type="text" name="total" class="form-control" value="0">
                        </div>
                      </td>
                    </tr>

                    <tr class="save">
                      <td colspan="3"></td>
                      <td align="right">
                        <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                        <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>

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
    var jumlah = 0;
    var harga = 0;
    $.each($('.jumlah'), function(index, val) {

      jumlah += Number($(this).val());
      harga += Number($(this).closest('tr').find('.harga').val());

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
