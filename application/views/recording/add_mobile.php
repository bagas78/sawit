<style type="text/css">
  .tit{
    background: black;
    color: white;
    padding: 0.5%;
  }
  .col-om{
    background: radial-gradient(#999999a1, #9999991f);
    padding: 1%;
  }
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
        <div class="box-body" style="padding: 0;">
          
          <form method="POST" action="<?=base_url('recording/save')?>">
          
          <div class="row col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor</label>
                <input readonly id="nomor" type="text" name="nomor" class="form-control" value="<?=@$nomor?>">
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Recording</label>
                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d')?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kebun</label>
                <select id="kebun" class="form-control" required name="kebun">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($kebun_data as $value): ?>
                    <option value="<?=@$value['kebun_id']?>"><?=@$value['kebun_nama']?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-md-6"> 
              <div class="form-group">
                <label>Suhu</label>
                <input id="suhu" type="text" name="suhu" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Tanaman</label>
                <input required id="tanaman-text" type="text" readonly class="form-control">
                <input type="hidden" name="tanaman" id="tanaman">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kondisi Kebun</label>
                <textarea class="form-control" name="kondisi" id="kondisi" required></textarea>
              </div>
            </div>
          </div>

          <div class="clearfix"></div><br/>

          <!-- panen -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- PANEN --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('panen')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_panen"></div>

            </div>

          <div class="clearfix"></div><br/>
          <!-- end panen -->


          <!-- pruning -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- PRUNING --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('pruning')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_pruning"></div>
          
          </div>

          <div class="clearfix"></div><br/>
          <!-- end pruning -->


          <!-- semprot -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- SEMPROT --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('semprot')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_semprot"></div>
          
          </div>

          <div class="clearfix"></div><br/>
          <!-- end semprot -->

          <!-- pupuk -->
           <div class="col-md-12">

              <h4 align="center" class="tit"><b>-- PUPUK --</b></h4>

              <div class="row">

                <div class="col-xs-12 col-sm-12">
                  <button type="button" onclick="clone('pupuk')" class="form-control add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                
              </div>

              <div id="paste_pupuk"></div>
          
          </div>

          <div class="clearfix"></div><br/>
          <!-- end semprot -->

          <div class="col-md-12" style="margin-bottom: 3%;">
            <div id="submit" class="col-md-12 row">
              <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
              <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
            </div>
          </div>

          </form>

        </div>

        
      </div>
      <!-- /.box -->


<div hidden>

  <!-- copy panen -->
  <div class="row bg-card" id="copy_panen">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-12 col-sm-12">
      <div class="form-group">
        <label>Jumlah</label>
        <div class="input-group">
          <input type="number" name="panen[]" class="form-control panen" required="" min="0" value="0">
          <span class="input-group-addon panen_satuan"></span>
        </div>
      </div>
    </div>

    <!-- hidden -->
    <input value="panen" type="hidden" name="panen_kategori[]" class="form-control panen_kategori">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_panen').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- end panen -->


  <!-- copy pruning -->
  <div class="row bg-card" id="copy_pruning">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-12 col-sm-12">
      <div class="form-group">
          <label>Biaya</label>
          <div class="input-group">
          <input type="number" name="pruning[]" class="form-control pruning" required="" min="0" value="0">
          <span class="input-group-addon">Rp</span>
        </div>
      </div>
    </div>

    <!-- hidden -->
    <input value="pruning" type="hidden" name="pruning_kategori[]" class="form-control pruning_kategori">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_pruning').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- end pruning -->

  <!-- copy semprot -->
  <div class="row bg-card" id="copy_semprot">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-4 col-sm-4">
      <div class="form-group">
        <label>Pestisida</label>
        <select id="semprot" class="form-control semprot" required name="semprot[]">
          <option value="" hidden>-- Pilih --</option>
          <?php foreach ($pestisida_data as $value): ?>
            <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-4 col-sm-4">
      <div class="form-group">
        <label>Stok</label>
        <div class="input-group">
          <input readonly type="number" name="semprot_stok[]" class="form-control semprot_stok" required value="0" min="0">
          <span class="input-group-addon semprot_satuan"></span>
        </div>
      </div>
    </div>
    <div class="col-xs-4 col-sm-4">
      <label>Jumlah</label>
      <div class="input-group">
        <input type="number" name="semprot_jumlah[]" class="form-control semprot_jumlah" required value="0" min="0">
        <span class="input-group-addon semprot_satuan"></span>
      </div>
    </div>

    <!-- hidden -->
    <input value="semprot" type="hidden" name="semprot_kategori[]" class="form-control semprot_kategori">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_semprot').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- end semprot -->

  <!-- copy pupuk -->
  <div class="row bg-card" id="copy_pupuk">

    <div class="col-xs-12 col-sm-12"><br></div>

    <div class="col-xs-4 col-sm-4">
      <div class="form-group">
        <label>Pupuk</label>
        <select id="pupuk" class="form-control pupuk" required name="pupuk[]">
          <option value="" hidden>-- Pilih --</option>
          <?php foreach ($pupuk_data as $value): ?>
            <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-4 col-sm-4">
      <div class="form-group">
        <label>Stok</label>
        <div class="input-group">
          <input readonly type="number" name="pupuk_stok[]" class="form-control pupuk_stok" required value="0">
          <span class="input-group-addon pupuk_satuan"></span>
        </div>
      </div>
    </div>
    <div class="col-xs-4 col-sm-4">
      <label>Jumlah</label>
      <div class="input-group">
        <input type="number" name="pupuk_jumlah[]" class="form-control pupuk_jumlah" required value="0" min="0">
        <span class="input-group-addon pupuk_satuan"></span>
      </div>
    </div>

    <!-- hidden -->
    <input id="pupuk_kategori" type="hidden" name="pupuk_kategori[]" class="form-control pupuk_kategori" value="pupuk">

    <div class="col-xs-12 col-sm-12">
      <button type="button" class="form-control remove btn btn-danger btn-sm" onclick="$(this).closest('#copy_pupuk').remove()"><i class="fa fa-minus"></i></button>
    </div>

  </div>
  <!-- end pupuk -->

</div>


<script type="text/javascript">

//kebun
$(document).on('change', '#kebun', function() {

  var id = $(this).val();

  $.get('<?=base_url('recording/get_kebun/')?>'+id, function(response) {
    
    //paste response
    var val = JSON.parse(response);
    $('#tanaman-text').val(val['tanaman']);
    $('#tanaman').val(val['id']);
    $('.panen_satuan').text(val['satuan']);

  });

});

//semprot dan pupuk
$(document).on('change', '#semprot, #pupuk', function() {

  var id = $(this).val();
  var nama = $(this).prop('name').replace("[]", "");  
  var satuan = $(this).closest('.row').find('.'+nama+'_satuan');
  var select = $(this).closest('.row').find('#'+nama);
  var jumlah = $(this).closest('.row').find('.'+nama+'_jumlah');
  var stok = $(this).closest('.row').find('.'+nama+'_stok');
  
  if (id != '') {

    //cek exist data
    var index = $(this).closest('.row').index();
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
        select.val('').change();

     }else{

        //get data
        $.get('<?=base_url('recording/get_satuan/')?>'+id, function(data) {
          
          var val = $.parseJSON(data);

          satuan.text(val.satuan);
          stok.val(val.stok);

        });

     } 

  }

}); 

//copy paste
function clone(target){
  //paste
  $('#paste_'+target).prepend($('#copy_'+target).clone().removeAttr('hidden'));

  //reset value
  $('#copy_'+target).find('select').val('').change();
  $('#copy_'+target).find('input[type="number"]').val(0);
  $('#copy_'+target).find('#'+target+'_satuan').text('');

  $('#copy_'+target).find('#'+target+'_gejala').val('');
} 

//cek stok populasi
$(document).on('keyup | change', '.afkir_jumlah', function() {

  var afkir = 0;
  $.each($('.afkir_jumlah'), function(index, val) {
     
     afkir += parseInt($(this).val());

  });

  if (afkir > parseInt($('#populasi').val())) {

    warning('Jumlah melebihi populasi');

    //reset
    $(this).val(0);

  }

});

//cek stok pakan dan premix
$(document).on('keyup | change', '.pakan_jumlah, .premix_jumlah', function() {

  var nama = $(this).prop('name').replace("[]", "");
  var stok = $(this).closest('.row').find('#'+nama.replace('jumlah', 'stok'));

  var jum = 0;
  $.each($('.'+nama), function(index, val) {
     
     jum += parseInt($(this).val());

  });

  if (jum > parseInt(stok.val())) {

    warning('Jumlah melebihi stok');

    //reset
    $(this).val(0);

  }

});


//otomatis
// function auto(){

//   setTimeout(function() {
//       auto();
//   }, 100);
// }

//auto();

</script>