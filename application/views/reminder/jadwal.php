
    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('reminder/jadwal_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <table id="example" class="table table-bordered table-hover display nowrap" style="width: 100%;">
            <thead>
            <tr>
              <th>Kode</th>
              <th>Kebun</th>
              <th>Kategori</th>
              <th>reminder</th>
              <th>Keterangan</th>
              <th width="30">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#example').DataTable({ 

            "responsive"  : true,
            "scrollX"     : true,
            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            
            "ajax": {
                "url": "<?= base_url('reminder/jadwal_get_data'); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "reminder_jadwal_kode"},
                        { "data": "kebun_nama"},
                        { "data": "reminder_kategori_nama"},
                        { "data": "reminder_jadwal_hari",
                        "render": 
                        function( data ) {
                            return data+' hari sekali';
                          }
                        },
                        { "data": "reminder_jadwal_keterangan"},
                        { "data": "reminder_jadwal_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('reminder/jadwal_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('reminder/jadwal_delete/')?>"+data+"/<?= @$jenis ?>') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>