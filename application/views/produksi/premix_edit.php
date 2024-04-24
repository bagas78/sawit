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
          
          <form method="POST">
          
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

            <div id="submit" class="col-md-12 row">
              <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
              <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
            </div>

          </form>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">

//fill input
$('form').attr('action', '<?=base_url('produksi/premix_update/'.$data['premix_id'])?>');
$('#kode').val('<?=$data['premix_kode']?>');
$('#nama').val('<?=$data['premix_nama']?>');
$('#satuan').val('<?=$data['premix_satuan']?>').change();
$('#keterangan').val('<?=$data['premix_keterangan']?>');

</script>