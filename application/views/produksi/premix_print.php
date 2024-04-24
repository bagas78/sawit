<link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css"> 

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>

<!-- number format -->
<script type="text/javascript" src="<?php echo base_url('assets/js/number_format.js') ?>"></script>

<h4 align="center"><b>ADUKAN <?=strtoupper(@$data[0]['premix_nama'])?> ( <?=date_format(date_create(@$data[0]['premix_barang_tanggal']), 'd/m/Y')?> )</b></h4>

<table id="example" class="table table-bordered table-hover" style="width: 100%;">
  <thead>
  <tr>
    <th>BAHAN</th>
    <td align="right"><b>BERAT</b></td> 
    <td align="right"><b>HARGA</b></td>
    <td align="right"><b>JUMLAH</b></td>
  </tr>
  </thead>
  <tbody>
    <?php foreach (@$data as $v): ?>
      <tr>
        <td><?=$v['barang_nama']?></td>
        <td align="right"><span class="number berat"><?=$v['premix_barang_qty']?></span> <?=$v['barang_satuan']?></td>
        <td align="right">Rp. <span class="number"><?=$v['premix_barang_harga']?></span></td>
        <td align="right">Rp. <span class="number subtotal"><?=$v['premix_barang_subtotal']?></span></td>
      </tr>
    <?php endforeach ?>
    <tr>
      <td colspan="3" align="right" rowspan="2"><b>TOTAL</b></td>
      <td align="right">Rp <span class="number total"></span></td>
    </tr>
    <tr>
      <td align="right">Rp <span class="number total_qty"></span> / <?=@$data[0]['premix_satuan']?></td>
    </tr>
  </tbody>
</table>

<script type="text/javascript">

  var total = 0;
  var berat = 0;
  $.each($('.subtotal'), function() {
     total += Number($(this).text());
     berat += Number($(this).closest('tr').find('.berat').text());
  });

  //paste
  $('.total').text(total);
  $('.total_qty').text(Math.round(total / berat));

  //format
  $.each($('.number'), function() {
     
    var val = Number($(this).text());
    $(this).text(number_format(val));

  });

  //print
  window.print();
  window.onafterprint = back;

  function back() {
      window.history.back();
  }

</script>