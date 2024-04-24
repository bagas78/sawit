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
          
          <form method="POST" action="<?=base_url('produksi/pakan_save')?>">
          
          <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label>Kode Campuran</label>
                  <input readonly id="kode" type="text" name="kode" class="form-control" value="<?=@$kode?>" required>
                </div>

                <div class="form-group">
                  <label>Nama Campuran</label>
                  <input id="nama" type="text" name="nama" class="form-control" value="" required placeholder="nama campuran pakan">
                </div>

                <div class="form-group">
                  <label>Jumlah Produksi</label>
                  <input id="qty" type="number" name="qty" class="form-control" required min="1" value="1">
                </div>

            </div>

            <div class="col-md-6">
               
               <div class="form-group">
                  <label>Satuan</label>
                  <select id="satuan" name="satuan" required class="form-control" required>
                    <option hidden>-- Pilih --</option>
                    <?php foreach ($satuan_data as $v): ?>
                      <option value="<?=$v['satuan_id']?>"><?=$v['satuan_singkatan']?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea placeholder="keterangan Pakan" id="keterangan" name="keterangan" class="form-control"></textarea>
                </div>

            </div>

          <div class="col-md-12">

            <table class="table">
              <thead>
                <tr>
                  <th width="500">Pakan</th>
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
                    <select id="pakan" class="form-control pakan" required name="pakan[]">
                      <option value="" hidden>-- Pilih --</option>
                      <?php foreach ($pakan_data as $value): ?>
                        <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
                      <?php endforeach ?>
                    </select>
                  </td>
                  <td>
                    <div class="input-group">
                      <input id="pakan_stok" readonly type="number" name="pakan_stok[]" class="form-control pakan_stok" required value="0" min="0">
                      <span class="input-group-addon pakan_satuan"></span>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <input id="pakan_jumlah" type="number" name="pakan_jumlah[]" class="form-control pakan_jumlah" required value="0" min="0">
                      <span class="input-group-addon pakan_satuan"></span>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input id="pakan_harga" type="number" name="pakan_harga[]" class="form-control pakan_harga" required value="0" min="0" step="0.01">
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input readonly id="pakan_subtotal" type="text" name="pakan_subtotal[]" class="form-control pakan_subtotal" required value="0" min="0" step="0.01">
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
                      <input readonly id="pakan_total" type="text" name="pakan_total[]" class="form-control pakan_total" required value="0" min="0" step="0.01">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="5" align="right">
                    <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                    <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
                  </td>
                </tr>
              </tbody>
            </table>

          </div>

          </form>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">

function auto(){

    //border none
    $('td').css('border-top', 'none');

    //harga
    var num_total = 0;
    $.each($('.pakan_harga'), function() {
       
      var target = $(this).closest('tr');
      var harga = Number($(this).val().replace(/,/g, ''));
      var jum = Number(target.find('.pakan_jumlah').val().replace(/,/g, ''));
      var total = harga * jum;
      num_total += total;

      //paste
      target.find('.pakan_subtotal').val(number_format(total));

    });

    //total
    $('.pakan_total').val(number_format(num_total));

    setTimeout(function() {
        auto();
    }, 100);
  }

auto();

//stok pakan dan obat
$(document).on('change', '#pakan', function() {
    
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
          satuan.text(val.satuan_singkatan);

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
  $('#copy').find('.pakan_satuan').text('');
} 

//submit validation
  $('form').on('submit', function() {
      
      var err = 0;
      $.each($('.pakan'), function(index, val) {
         
         var stok = $(this).closest('tr').find('.pakan_stok').val();
         var jumlah = $(this).closest('tr').find('.pakan_jumlah').val();

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