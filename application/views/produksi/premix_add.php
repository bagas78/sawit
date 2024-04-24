<style type="text/css">
  .tit{
    background: black;
    color: white;
    padding: 0.5%;
  }
  .col-om{
    background: radial-gradient(#999999a1, #9999991f);
    padding: 1%;
    margin: 0;
  }
</style>

    <!-- Main content --> 
    <section class="content"> 

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <br/>

          <div hidden align="left" id="back">
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
          
          <form method="POST" action="<?=base_url('produksi/premix_save')?>">
          
          <div class="row col-om">
            <div class="col-md-6">
               <div class="col-md-12">
                <div class="form-group">
                  <label>Kode Campuran</label>
                  <input readonly id="kode" type="text" name="kode" class="form-control" value="<?=@$kode?>" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Campuran</label>
                  <input id="nama" type="text" name="nama" class="form-control" value="" required placeholder="nama campuran premix">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Jumlah Produksi</label>
                  <input id="qty" type="number" name="qty" class="form-control" required min="1" value="1">
                </div>
              </div>
            </div>

            <div class="col-md-6">
               <div class="col-md-12">
                <div class="form-group">
                  <label>Satuan</label>
                  <select id="satuan" name="satuan" required class="form-control" required>
                    <option hidden>-- Pilih --</option>
                    <option value="kg">Kg</option>
                    <option value="pcs">Pcs</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea placeholder="keterangan premix" id="keterangan" name="keterangan" class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="clearfix"></div><br/>

          <div class="col-md-12 col-om premix_sub">

            <h4 align="center" class="tit"><b>-- premix --</b></h4>

            <table class="table">
              <thead>
                <tr>
                  <th width="500">premix</th>
                  <th width="500">Stok</th>
                  <th width="500">Jumlah</th>
                  <th width="500">Harga</th>
                  <th width="500">Subtotal</th>
                  <th width="1">
                    <button type="button" onclick="clone()" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste">
                <tr id="copy">
                  <td>
                    <select id="premix" class="form-control premix" required name="premix[]">
                      <option value="" hidden>-- Pilih --</option>
                      <?php foreach ($premix_data as $value): ?>
                        <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
                      <?php endforeach ?>
                    </select>
                  </td>
                  <td>
                    <div class="input-group">
                      <input id="premix_stok" readonly type="number" name="premix_stok[]" class="form-control premix_stok" required value="0" min="0">
                      <span class="input-group-addon premix_satuan"></span>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <input id="premix_jumlah" type="number" name="premix_jumlah[]" class="form-control premix_jumlah" required value="0" min="0">
                      <span class="input-group-addon premix_satuan"></span>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input id="premix_harga" type="number" name="premix_harga[]" class="form-control premix_harga" required value="0" min="0" step="0.01">
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input readonly id="premix_subtotal" type="text" name="premix_subtotal[]" class="form-control premix_subtotal" required value="0" min="0" step="0.01">
                    </div>
                  </td>
                  <td>
                    <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" align="right">
                    <span><b>Total</b></span>
                  </td>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input readonly id="premix_total" type="text" name="premix_total[]" class="form-control premix_total" required value="0" min="0" step="0.01">
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

          </div>

          <div class="clearfix"></div><br/>

            <div id="submit" class="col-md-12 row">
              <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
              <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
            </div>

          </form>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">

function auto(){

    //harga
    var num_total = 0;
    $.each($('.premix_harga'), function() {
       
      var target = $(this).closest('tr');
      var harga = Number($(this).val().replace(/,/g, ''));
      var jum = Number(target.find('.premix_jumlah').val().replace(/,/g, ''));
      var total = harga * jum;
      num_total += total;

      //paste
      target.find('.premix_subtotal').val(number_format(total));

    });

    //total
    $('.premix_total').val(number_format(num_total));

    setTimeout(function() {
        auto();
    }, 100);
  }

auto();

//stok premix dan obat
$(document).on('change', '#premix', function() {
    
  var nama = $(this).prop('name').replace("[]","");  
  var id = $(this).val();
  var stok = $(this).closest('tr').find('#'+nama+'_stok');
  var satuan = $(this).closest('tr').find('.'+nama+'_satuan');
  var jumlah = $(this).closest('tr').find('#'+nama+'_jumlah');
  var select = $(this).closest('tr').find('#'+nama);

  if (id != '') {

    //cek exist data
    var index = $(this).closest('tr').index();
    var arr = new Array();

    $.each($('.'+nama), function(idx, val) {
      
          var val = $(this).val();

          if (index != idx)
          arr.push(val);

      });

     if ($.inArray(id, arr) != -1) {

        warning('Pilihan sudah ada');

        //reset value
        satuan.text('');
        jumlah.val(0);
        stok.val(0);
        select.val('').change();
        
     }else{

        //get data
        $.get('<?=base_url('recording/get_barang/')?>'+id, function(data) {
      
          var val = $.parseJSON(data);

          stok.val(val.barang_stok);
          satuan.text(val.barang_satuan);

        });
     }

  }

});

//copy paste
function clone(){
  //paste
  $('#paste').prepend($('#copy').clone().removeAttr('hidden'));

  //reset value
  $('#copy').find('select').val('').change();
  $('#copy').find('input').val(0);
  $('#copy').find('.premix_satuan').text('');
} 

//submit validation
  $('form').on('submit', function() {
      
      var err = 0;
      $.each($('.premix'), function(index, val) {
         
         var stok = $(this).closest('tr').find('.premix_stok').val();
         var jumlah = $(this).closest('tr').find('.premix_jumlah').val();

         if (Number(stok) < Number(jumlah)) {

          err += 1;

         }

      });

      if (err != 0) {

        warning('Terdapat jumlah yang lebih dari stok');
        return false;
      }else{

        return true;
      }

  });

</script>