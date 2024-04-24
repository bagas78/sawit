
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('kebun/add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
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
              <th>Tanaman</th>
              <th width="70">Action</th>
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
                "url": "<?= base_url('kebun/get_data'); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "kebun_kode"},
                        { "data": "kebun_nama"},
                        { "data": "barang_nama"},
                        { "data": "kebun_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('kebun/view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a href='<?php echo base_url('kebun/edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('kebun/delete/')?>"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });

function tambah_ayam(id){
  
  //modal
  $("#modal-tambah").modal("toggle");

  //id
  $('#id').val(id);
  $('#jenis').val('').change();
  $('#stok').val('');
  $('#jumlah').val('');

}  

//stok DOC
$( document ).ready(function() {

    $('#jenis').on('change', function() {
      
      var id = $(this).val();
      $.get('<?=base_url('kandang/get_stok/')?>'+id, function(data) {
        
        var val = $.parseJSON(data);

        $('#stok').val(val.barang_stok);
        $('#jumlah').val('');
        $('#alert').val('');

      });

    });

    $('#jumlah').on('keyup', function() {
      
      var val = parseInt($(this).val());
      var stok = parseInt($('#stok').val());

      if (val > stok) {
        $('#alert').html("Jumlah melebihi stok <i class='fa fa-info-circle'></i>");
      }else{
        $('#alert').html("");
      }

    });

});

</script>