
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('produksi/pakan_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Baru</button></a>
              <a href="<?= base_url('produksi/pakan_stok') ?>"><button class="btn btn-success"><i class="fa fa-plus"></i> Tambah Stok</button></a>
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
              <th>Nama</th> 
              <th>Stok</th>
              <th>Satuan</th>
              <th width="60">Action</th>
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
                "url": "<?= base_url('produksi/pakan_get_data'); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pakan_kode"},
                        { "data": "pakan_nama"},
                        { "data": "pakan_stok"},
                        { "data": "satuan_singkatan"},
                        { "data": "pakan_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('produksi/pakan_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produksi/pakan_delete/')?>"+data+"/<?=@$kategori?>') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button> "+
                            "<a href='<?php echo base_url('produksi/pakan_view/')?>"+data+"'><button class='btn btn-xs bg-navy'><i class='fa fa-arrow-right'></i></button></a>";
                          }
                        },
                        
                    ],
        });

    });
</script>