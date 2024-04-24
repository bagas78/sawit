<style type="text/css">
  .tit{
    text-align: center;
    background: black;
    color: white;
    padding: 0.5%;
    font-weight: bold;
  }
</style>


    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left" class="back">
            <a href="<?=base_url('produksi/pakan')?>"><button type="button" class="btn bg-navy"><i class="fa fa-arrow-left"></i> Kembali</button></a>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <h4 class="tit"><?=@$nama?></h4>
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>Di tambah</th>
              <th>Satuan</th>
              <th width="1">Action</th>
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
                "url": "<?= base_url('produksi/pakan_view_get_data/'.@$id); ?>",
                "type": "GET"
            },
            "columns": [   
                        { "data": "pakan_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },                              
                        { "data": "total"},
                        { "data": "satuan_singkatan"},
                        { "data": "pakan_qty_tanggal",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('produksi/pakan_print/')?>"+data+"'><button class='btn btn-xs btn-info'><i class='fa fa-print'> Print</i></button></a>";
                          }
                        },
                        
                    ],
        });

    });
</script>