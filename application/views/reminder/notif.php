
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <br/>

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
              <th>Kebun</th>
              <th>Kategori</th>
              <th>Status</th>
              <th>Tanggal</th>
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
                "url": "<?= base_url('reminder/notif_get_data'); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "kebun_nama"},
                        { "data": "reminder_kategori_nama"},
                        { "data": "reminder_status",
                        "render": 
                        function( data ) {
                            if (data == 0) {var s = '<span class="bg-red">Belum</span>';}else{var s = '<span class="bg-green">Sudah</span>';}
                            return s;
                          }
                        },
                        { "data": "reminder_tanggal",
                        "render": 
                        function( data ) {
                            return moment(data).format("DD/MM/YYYY");
                          }
                        },
                        { "data": "reminder_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<button onclick='proses("+data+")' class='btn btn-xs btn-success'>Proses <i class='fa fa-rotate-right'></i></button>";
                          }
                        },
                        
                    ],
        });

    });


function proses(id) {
  
  swal({
    title: "Yakin akan proses",
    text: "",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $(location).attr('href','<?=base_url('reminder/notif_proses/')?>'+id);
      
    }
  });

}

</script>