
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
        <div class="box-body" style="padding: 0;">
          
          <form action="<?=base_url('penjualan/transaksi_save');?>" method="post">

            <!-- hidden action hack -->
            <input type="hidden" name="struk" value="0" id="struk">
            <input type="hidden" value="0" id="send">
              
            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor</label>
                <input type="text" required readonly="" name="nomor" class="nomor form-control" value="<?=@$nomor?>">
              </div>
              <div class="form-group">
                <label>Pelanggan</label>
                <select name="kontak" required class="kontak form-control">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach (@$kontak_data as $val): ?>
                    <option value="<?=@$val['kontak_id']?>"><?=@$val['kontak_nama']?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label>Pembayaran</label>
                <select name="status" required class="status form-control">
                  <option value="" hidden>-- Pilih --</option>
                  <option value="lunas">Lunas</option>
                  <option value="belum">Belum</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Jatuh Tempo</label>
                <input type="date" required name="jatuh tempo" class="jatuh_tempo form-control" value="<?=date('Y-m-d')?>">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="keterangan form-control"></textarea>
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

                <!-- <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select required name="kategori[]" class="kategori form-control">
                      <option value="" hidden>-- Kategori --</option>
                      <?php foreach ($kategori_data as $val): ?>
                        <option value="<?=$val['barang_kategori_id']?>"><?=$val['barang_kategori_nama']?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div> -->
                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Barang</label>
                    <select required name="barang[]" class="barang form-control">
                      <option value="" hidden>-- Barang --</option>
                      <?php foreach ($barang_data as $val): ?>
                        <option value="<?=$val['barang_id']?>"><?=$val['barang_nama']?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Harga</label> 
                    <input type="number" name="harga[]" class="harga form-control" required min="1" value="0" step="0.01">
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Qty</label>
                    <div class="input-group">
                      <input type="number" name="qty[]" class="qty form-control" required min="1" value="0" step="0.01">
                      <span class="satuan input-group-addon"></span>
                    </div>
                  </div>
                </div>

                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Diskon (%)</label>
                    <input type="number" name="diskon[]" class="diskon form-control" required min="0" value="0" step="0.01">
                  </div>
                </div>

                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Stok</label>
                    <div class="input-group">
                      <input readonly="" type="text" name="stok[]" class="stok form-control" required min="1" value="0">
                      <span class="satuan input-group-addon"></span>
                    </div>
                  </div>
                </div>

                <div class="col-xs-6 col-sm-6">
                  <div class="form-group">
                    <label>Subtotal</label>
                    <input type="text" name="subtotal[]" class="subtotal form-control" required min="1" value="0" readonly="">
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
                    <label>Qty Akhir</label>
                    <input id="qty" readonly="" type="text" name="qty_akhir" class="form-control" value="0" min="0">
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12">
                  <div class="form-group">
                    <label>PPN</label>
                    <div class="input-group">
                      <input id="ppn"  type="text" name="ppn" class="form-control" required min="0" value="0">
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12">
                  <div class="form-group">
                    <label>Total Akhir</label>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <td>
                        <input id="total" readonly="" type="text" name="total" class="form-control" value="0" min="0">
                      </td>
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
  }

  //get barang
  $(document).on('change', '.kategori', function() {
    
    var target = $(this).closest('#copy').find('.barang');

    //reset
    target.empty();

    var id = $(this).val();
    var html = '';
    $.get('<?=base_url('penjualan/get_barang/')?>'+id, function(data) {
      
      var arr = JSON.parse(data);

      html += "<option value='' hidden>-- Pilih --</option>";

      $.each(arr, function(index, val) {
         
         html += "<option value='"+val['barang_id']+"'>"+val['barang_nama']+"</option>";

      });

      //append option barang
      target.append(html);

    });

  });

  $(document).on('change', '.barang', function() {

    //get stok
    var barang = $(this).val();
    var stok = $(this).closest('.row').find('.stok');

    $.get('<?=base_url('penjualan/get_stok/')?>'+barang, function(data) {
        
        number_format(stok.val(data));

    });

    //push array
    var id = $(this).val();
    var index = $(this).closest('.row').index();
    var arr = new Array(); 

    //cek array exist
    if (id != null) {

        $.each($('.barang'), function(idx, val) {
      
            var val = $(this).val();

            if (index != idx)
            arr.push(val);

        });

       if ($.inArray(id, arr) != -1) {

          warning('Barang sudah ada');

          //reset value
          $(this).closest('.row').find('select').val('').change();
          $(this).closest('.row').find('input').val(0);
          
       }else{

          $.get('<?=base_url('penjualan/get_satuan/')?>'+id, function(data) {
            
            var val = $.parseJSON(data);

            target.closest('tr').find('.satuan').text(val['satuan_singkatan']);

          });

       }
    }

  });

  $(document).on('change', '.qty', function() {
    var qty = parseInt($(this).val());
    var stok = parseInt($(this).closest('.row').find('.stok').val().replace(/,/g, ''));

    if (qty > stok) {
      $(this).val(0);
      warning('Stok kurang dari Qty');
    }

  });

  function auto(){

    //subtotal
    var harga = 0;
    var qty = 0;
    var total = 0;
    $.each($('.harga'), function(index, val) {

      var h = parseInt($(this).val());
      var q = parseInt($(this).closest('.row').find('.qty').val());
      var d = parseInt($(this).closest('.row').find('.diskon').val());
      var s = parseInt($(this).closest('.row').find('.subtotal').val().replace(/,/g, ''));

      harga += h;
      qty += q;
      total += s;

      //subtotal
      var sub = (h * q) - ((h * q) * d / 100);
      $(this).closest('.row').find('.subtotal').val(number_format(sub));

    });

    //qty akhir
    $('#qty').val(qty);

    //ppn
    var ppn = Number($('#ppn').val()) * Number(total) / 100;
    var final = Number(ppn) + Number(total); 

    //total akhir
    $('#total').val(number_format(final));

    //border none
    $('td').css('border-top', 'none');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

  $("form").on("submit", function(){

    var send = $('#send').val();

    if (send == 0) {

      swal({
        title: "Kirim struk ke pelanggan?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((send) => {
        
        if (send) {

          //kirim struk
          $('#struk').val(1);
          $('#send').val(1);
          $('form').submit();
          
        }else{

          //tidak kirim struk
          $('#struk').val(0);
          $('#send').val(1);
          $('form').submit();

        }

      });
      
      //kirim post
      if ($('#send').val() == 1) {
          
        //kirim
        return true;
      }else{

        //tidak
        return false;
      } 

    }
     
  })

</script>
