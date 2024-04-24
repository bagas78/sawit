<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= strtoupper(@$title) ?> | LAPORAN</title> 

	<!-- Bootstrap 3.3.7 --> 
  	<link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css"> 

  	<!-- jQuery 3 -->
  	<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>

  	<!--number format-->
  	<script src="<?php echo base_url() ?>assets/js/number_format.js"></script>

  	<style type="text/css">
  		.box{
  			padding: 3%; 
  		} 
  		.tit{
  			border-width: 2px;
		    border-style: solid; 
		    padding: 0.5%;
		    font-weight: bold;
		    font-size: x-large;
  		}
  		table {
			max-width: 100%;
			max-height: 100%;
		}
		table .r {
		  	text-align: right;
		}
  	</style>

</head>
<body>

	<div class="box" style="padding: 0;">

		<div class="row">

			<div class="col-md-12">
				<table border="0" style="font-weight: bold;" class="table table-responsive table-borderless">
					<tr>
						<td style="border-top: 0;">Nomor</td>
						<td style="border-top: 0;">:</td>
						<td style="border-top: 0;" align="right"><?=@$data[0]['pengeluaran_nomor']?></td>
					</tr>
					<tr>
						<td style="border-top: 0;">Tanggal</td>
						<td style="border-top: 0;">:</td>
						<td style="border-top: 0;" align="right"><?= date_format(date_create(@$data[0]['pembelian_tanggal']), 'd M Y') ?></td>
					</tr>
					<tr>
						<td style="border-top: 0;">Transaksi</td>
						<td style="border-top: 0;">:</td>
						<td style="border-top: 0;" align="right"><?=@$data[0]['user_nama']?></td>
					</tr>
				</table>
			</div>

			<div class="clearfix" style="margin-top: 30px;"></div>

			<div class="col-md-12" align="center">
				<span class="tit">FAKTUR PENGELUARAN</span>
			</div>

			<div class="clearfix" style="margin-bottom: 30px;"></div>

			<div class="col-md-12">
			
				<table border="0" class="table table-responsive table-borderless" style="width: 100%;">
					<thead>						
						<tr>
							<th width="70">No</th>
							<th>Barang</th>
							<th class="r">Jumlah</th>
							<th class="r">Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach (@$data as $val): ?>

							<tr>
								<td><?=$i?></td>
								<td><?=@$val['pengeluaran_barang_barang']?></td>
								<td class="r jumlah"><?=number_format(@$val['pengeluaran_barang_jumlah'])?></td>
								<td class="r harga"><?=number_format(@$val['pengeluaran_barang_harga'])?></td>
							</tr>
						
						<?php $i++ ?>
						<?php endforeach ?>

						<tr>
							<td colspan="2"></td>
							<td class="r"><b>Total</b></td>
							<td class="r"><span id="total"></span></td>
						</tr> 

					</tbody>
				</table>
			</div>

		</div>

	</div>

</body>
</html>

<script type="text/javascript">
	
	var harga = $('.harga');
	var total = 0;
	$.each(harga, function(index, val) {
		 
		 total += parseInt($(this).text().replace(/,/g, ''));
		 
	});

	$('#total').text(number_format(total));

	
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>