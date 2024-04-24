
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
          
          <table class="table table-borderless">
            <tr>
              <td>Pembuat</td>
              <td>: <?=@$data['user_nama']?></td>
            </tr>
            <tr>
              <td>Kandang</td>
              <td>: <?=@$data['kandang_nama']?></td>
            </tr>
            <tr>
              <td>Kondisi Kandang</td>
              <td>: <?=@$data['report_kondisi_kandang']?></td>
            </tr>
            <tr>
              <td>Kondisi Suhu</td>
              <td>: <?=@$data['report_kondisi_suhu']?></td>
            </tr>
            <tr>
              <td>Tanggal</td>
              <td>: <?=date_format(date_create(@$data['report_tanggal']), 'd/m/Y')?></td>
            </tr>
            <tr>
              <td>Catatan</td>
              <td>: <?=@$data['report_catatan']?></td>
            </tr>
          </table>

          <br/><hr>

          <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Kembali</button></a>

        </div>

        
      </div>
      <!-- /.box -->