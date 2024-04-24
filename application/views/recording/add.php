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
          
          <form method="POST" action="<?=base_url('recording/save')?>">
          
          <div class="col-md-12 col-om">
            <div hidden class="col-md-6">
              <div class="form-group">
                <label>Nomor</label>
                <input id="nomor" type="text" name="nomor" class="form-control" value="">
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
                <label>Tanaman</label>
                <input required id="tanaman-text" type="text" readonly class="form-control">
                <input type="hidden" name="tanaman" id="tanaman">
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
                <label>Kondisi Kebun</label>
                <textarea class="form-control" name="kondisi" id="kondisi" required></textarea>
              </div>
            </div>

          </div>

          <div class="clearfix"></div><br/>

          <!-- panen sawit -->

          <div class="col-md-12 col-om panen_sub">

            <h4 align="center" class="tit"><b>-- PANEN --</b></h4>

            <table class="table">
              <thead>
                <tr>
                  <th>Jumlah</th>
                  <th hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('panen')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_panen"></tbody>
            </table>

          </div>

          <div class="clearfix"></div><br/>

          <!-- pruning batang -->

          <div class="col-md-12 col-om pruning_sub">

            <h4 align="center" class="tit"><b>-- PRUNING --</b></h4>

            <table class="table">
              <thead>
                <tr>
                  <th>Biaya</th>
                  <th hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('pruning')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_pruning"></tbody>
            </table>

          </div>

          <div class="clearfix"></div><br/>

          <!-- semprot -->
          
          <div class="col-md-12 col-om semprot_sub">  

            <h4 align="center" class="tit"><b>-- SEMPROT --</b></h4>
            
            <table class="table">
              <thead>
                <tr>
                  <th width="500">Pestisida</th>
                  <th width="500">Stok</th>
                  <th width="500">Jumlah</th>
                  <th width="500" hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('semprot')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_semprot"></tbody>
            </table>

          </div>

          <div class="clearfix"></div><br/>

          <!-- pupuk -->

          <div class="col-md-12 col-om pupuk_sub">

            <h4 align="center" class="tit"><b>-- PUPUK --</b></h4>

            <table class="table">
              <thead>
                <tr>
                  <th width="500">Pupuk</th>
                  <th width="500">Stok</th>
                  <th width="500">Jumlah</th>
                  <th width="500" hidden>Kategori</th>
                  <th width="1">
                    <button type="button" onclick="clone('pupuk')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                  </th>
                </tr>
              </thead>
              <tbody id="paste_pupuk"></tbody>
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

<!-- copy -->
<table>

  <!--panen-->
  <tr id="copy_panen" hidden> 
    <td>
      <div class="input-group">
        <input type="number" name="panen[]" class="form-control panen" required="" min="0" value="0">
        <span class="input-group-addon panen_satuan"></span>
      </div>
    </td>
    <td hidden>
       <input value="panen" type="text" name="panen_kategori[]" class="form-control panen_kategori">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>

  <!--pruning-->
  <tr id="copy_pruning" hidden> 
    <td>
      <div class="input-group">
        <input type="number" name="pruning[]" class="form-control pruning" required="" min="0" value="0">
        <span class="input-group-addon">Rp</span>
      </div>
    </td>
    <td hidden>
       <input value="pruning" type="text" name="pruning_kategori[]" class="form-control pruning_kategori">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>
  
  <!--semprot-->
  <tr id="copy_semprot" hidden>
    <td>
      <select id="semprot" class="form-control semprot" required name="semprot[]">
        <option value="" hidden>-- Pilih --</option>
        <?php foreach ($pestisida_data as $value): ?>
          <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
        <?php endforeach ?>
      </select>
    </td>
    <td>
      <div class="input-group">
        <input readonly type="number" name="semprot_stok[]" class="form-control semprot_stok" required value="0" min="0">
        <span class="input-group-addon semprot_satuan"></span>
      </div>
    </td>
    <td>
      <div class="input-group">
        <input type="number" name="semprot_jumlah[]" class="form-control semprot_jumlah" required value="0" min="0">
        <span class="input-group-addon semprot_satuan"></span>
      </div>
    </td>
    <td hidden>
      <input id="semprot_kategori" type="text" name="semprot_kategori[]" class="form-control semprot_kategori" value="semprot">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>

  <!--pupuk-->
  <tr id="copy_pupuk" hidden>
    <td>
      <select id="pupuk" class="form-control pupuk" required name="pupuk[]">
        <option value="" hidden>-- Pilih --</option>
        <?php foreach ($pupuk_data as $value): ?>
          <option value="<?=@$value['barang_id']?>"><?=@$value['barang_nama']?></option>
        <?php endforeach ?>
      </select>
    </td>
    <td>
      <div class="input-group">
        <input readonly type="number" name="pupuk_stok[]" class="form-control pupuk_stok" required value="0">
        <span class="input-group-addon pupuk_satuan"></span>
      </div>
    </td>
    <td>
      <div class="input-group">
        <input type="number" name="pupuk_jumlah[]" class="form-control pupuk_jumlah" required value="0" min="0">
        <span class="input-group-addon pupuk_satuan"></span>
      </div>
    </td>
    <td hidden>
      <input id="pupuk_kategori" type="text" name="pupuk_kategori[]" class="form-control pupuk_kategori" value="pupuk">
    </td>
    <td>
      <button type="button" class="remove btn btn-danger btn-sm" onclick="$(this).closest('tr').remove()"><i class="fa fa-minus"></i></button>
    </td>
  </tr>

</table>

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
  var satuan = $(this).closest('tr').find('.'+nama+'_satuan');
  var select = $(this).closest('tr').find('#'+nama);
  var jumlah = $(this).closest('tr').find('.'+nama+'_jumlah');
  var stok = $(this).closest('tr').find('.'+nama+'_stok');
  
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

//cek stok pakan dan premix
$(document).on('keyup | change', '.semprot_jumlah, .pupuk_jumlah', function() {

  var nama = $(this).prop('name').replace("[]", "");
  var stok = $(this).closest('tr').find('.'+nama.replace('jumlah', 'stok'));

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