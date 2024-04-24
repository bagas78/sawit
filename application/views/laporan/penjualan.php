
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

        <form method="POST" action="<?=base_url('laporan/penjualan')?>">
          <div class="col-md-3 col-xs-11 row">
            <select class="form-control select2" name="kebun" required> 
              <option value="">-- Kebun --</option>             
              <?php foreach ($kebun_data as $v): ?>
                <option value="<?=$v['kebun_id']?>"><?=$v['kebun_nama']?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-3 col-xs-11">
            <input name="tanggal" class="form-control" type="month" required>  
          </div>
          <div class="col-md-1 col-xs-1">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>  
          </div>
        </form>

        <div class="clearfix"></div><hr>
          
          <table id="example" class="table table-bordered table-hover display nowrap" style="width: 100%;">
            <thead>
            <tr>
              <th>Kebun</th>
              <th>Barang</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Subtotal</th>
              <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <hr>

          <h4 style="background: steelblue; color: white; padding: 0.4%; width: fit-content;"><b>TOTAL PENJUALAN</b></h4>

          <?php $dc = date_create($tahun_.'-'.$bulan_); ?>

          <table class="table table-bordered table-responssive">
              <tr style="background: azure;">
                  <td>Bulan <?= date_format($dc, 'F'); ?></td>
                  <td><b><?='Rp. '.@number_format($sum_bulan)?></b></td>
              </tr>
              <tr style="background: cornsilk;">
                  <td>Tahun <?= date_format($dc, 'Y'); ?></td>
                  <td><b><?='Rp. '.@number_format($sum_tahun)?></b></td>
              </tr>
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
                "url": "<?= base_url('laporan/get_data/penjualan/'.$bulan_.'/'.$tahun_.'/'.@$kebun); ?>",
                "type": "GET"
            },
            "columns": [     
                        { "data": "kebun_nama"},
                        { "data": "barang_nama"},
                        { "data": "penjualan_barang_qty"},
                        { "data": "penjualan_barang_harga",
                        "render": 
                        function( data ) {
                            return "<span> Rp. "+number_format(data)+"</span>";
                          }
                        },
                        { "data": "penjualan_barang_subtotal",
                        "render": 
                        function( data ) {
                            return "<span> Rp. "+number_format(data)+"</span>";
                          }
                        },
                        { "data": "penjualan_barang_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        
                    ],
        });

    });

function loop(){

    $.each($('.select2-results__option'), function() {
      
      var txt = $(this).text();
      var target = $(this);
      if (txt == '-- Kebun --') {

        target.attr('hidden', 'true');
      } 

    });

    setTimeout(function() { 
        loop();
    }, 100);
}

loop();
</script>