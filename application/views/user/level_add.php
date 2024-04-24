    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left"><br/></div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        
            <form role="form" method="post" action="<?php echo base_url() ?>user/level_save" enctype="multipart/form-data">
            <div class="box-body" style="padding: 10px;">

                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nama Level</label>
                        <input required="" type="text" name="level_nama" class="form-control">
                      </div>  
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                        <label>Notif Whatsapp</label>
                        <select class="form-control" required name="level_notif" required>
                          <option value="" hidden>-- Pilih --</option>
                          <option value="1">Beri</option>
                          <option value="0">Tidak</option>
                        </select>
                      </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kontak</label>
                            <select class="form-control" required name="level_kontak" required>
                              <option value="" hidden>-- Pilih --</option>
                              <option value="1">Beri</option>
                              <option value="0">Tidak</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                        <label>Persediaan Gudang</label>
                        <select class="form-control" required name="level_gudang" required>
                          <option value="" hidden>-- Pilih --</option>
                          <option value="1">Beri</option>
                          <option value="0">Tidak</option>
                        </select>
                      </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reminder</label>
                            <select class="form-control" required name="level_reminder" required>
                              <option value="" hidden>-- Pilih --</option>
                              <option value="1">Beri</option>
                              <option value="0">Tidak</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                        <label>Kode Kebun</label>
                        <select class="form-control" required name="level_kebun" required>
                          <option value="" hidden>-- Pilih --</option>
                          <option value="1">Beri</option>
                          <option value="0">Tidak</option>
                        </select>
                      </div> 
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Pembelian</label>
                        <select class="form-control" required name="level_pembelian" required>
                          <option value="" hidden>-- Pilih --</option>
                          <option value="1">Beri</option>
                          <option value="0">Tidak</option>
                        </select>
                      </div>  
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pengeluaran</label>
                            <select class="form-control" required name="level_pengeluaran" required>
                                <option value="" hidden>-- Pilih --</option>
                                <option value="1">Beri</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Recording</label>
                            <select class="form-control" required name="level_recording" required>
                              <option value="" hidden>-- Pilih --</option>
                              <option value="1">Beri</option>
                              <option value="0">Tidak</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Monitoring</label>
                            <select class="form-control" required name="level_monitoring" required>
                              <option value="" hidden>-- Pilih --</option>
                              <option value="1">Beri</option>
                              <option value="0">Tidak</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Penjualan</label>
                            <select class="form-control" required name="level_penjualan" required>
                              <option value="" hidden>-- Pilih --</option>
                              <option value="1">Beri</option>
                              <option value="0">Tidak</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Laporan</label>
                            <select class="form-control" required name="level_laporan" required>
                              <option value="" hidden>-- Pilih --</option>
                              <option value="1">Beri</option>
                              <option value="0">Tidak</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                        <label>Absensi</label>
                        <select class="form-control" required name="level_absensi" required>
                          <option value="" hidden>-- Pilih --</option>
                          <option value="1">Beri</option>
                          <option value="0">Tidak</option>
                        </select>
                      </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tampilan</label>
                            <select class="form-control" required name="level_tampilan" required>
                              <option value="" hidden>-- Pilih --</option>
                              <option value="desktop">Desktop</option>
                              <option value="tablet">Tablet</option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
                <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
            </div>
          </form>

        </div>

        
      </div>
      <!-- /.box -->
