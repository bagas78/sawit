<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <form method="POST" action="">
                <div class="col-md-3">
                  <input type="month" name="filter" class="form-control" value="<?=$filter?>">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary">Cari <i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div> 
        <div class="box-body"> 

          <div style="margin-bottom: 10px;">
            <button onclick="tab('data')" class="t-data btn btn-danger active">Tampilkan Data <i class="fa fa-paste"></i></button>
            <button onclick="tab('grafik')" class="t-grafik btn btn-default">Tampilkan Grafik <i class="fa fa-pie-chart"></i></button>
          </div>
          
          <table id="example" class="table table-bordered table-hover display nowrap" style="width: 100%;">
            <thead>
            <tr>
              <th>Lokasi Pruning</th>
              <th>Biaya</th>
              <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <canvas style="display: none;" id="myChart"></canvas>

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
                "url": "<?= base_url('monitoring/get_data/pruning/'.@$filter); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "kebun_nama"},
                        { "data": "recording_barang_jumlah",
                        "render": 
                        function( data ) {
                            return 'Rp. '+number_format(data);
                          }
                        },
                        { "data": "recording_tanggal",
                        "render": 
                        function( data, type, row, meta ) {
                            return moment(data).format("DD/MM/YYYY");
                          }
                        }
                        
                    ],
        });

    });

    function tab(x){

      var d = $('.t-data');
      var g = $('.t-grafik');

      //data onclick
      if (x == 'data') {

        d.removeClass('btn-default');
        d.addClass('btn-danger');
        g.removeClass('btn-danger');
        g.addClass('btn-default');

        //hide
        $('#example_wrapper').css('display', '');
        $('#myChart').css('display', 'none');

      }

      //grafik onclick
      if (x == 'grafik') {

        g.removeClass('btn-default');
        g.addClass('btn-danger');
        d.removeClass('btn-danger');
        d.addClass('btn-default');
        
        //hide
        $('#example_wrapper').css('display', 'none');
        $('#myChart').css('display', '');
      }

    }

  //grafik
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: [ 

        //harian
        <?php for ($i=1; $i < $hari + 1; $i++):?>

          <?php echo $i.','; ?>

        <?php endfor ?>

      ],
      datasets: [{
        label: 'Grafik Pruning <?=date_format(date_create($filter), 'M Y')?>',
        data: [
                
                //harian
                <?php foreach ($grafik_data as $v): ?>

                  <?php for ($i=1; $i < $hari + 1; $i++):?>

                    <?php if ($v['tanggal'] == $i): ?>
                    
                      <?=$v['jumlah'].','; ?>

                    <?php else: ?>
                      
                      <?='0'.','; ?>

                    <?php endif ?>

                  <?php endfor ?>

                <?php endforeach ?>

              ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>