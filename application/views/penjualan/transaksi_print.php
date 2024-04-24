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

	<div class="box">

		<div class="row">

			<div class="col-md-12">
				<table border="0" style="font-weight: bold;" class="table table-responsive table-borderless">
					<tr>
						<td style="border-top: 0;">Nomor Transaksi</td>
						<td style="border-top: 0;">:</td>
						<td style="border-top: 0;" align="right"><?=@$data[0]['penjualan_nomor']?></td>
					</tr>
					<tr>
						<td style="border-top: 0;">Tanggal</td>
						<td style="border-top: 0;">:</td>
						<td style="border-top: 0;" align="right"><?= date_format(date_create(@$data[0]['penjualan_tanggal']), 'd M Y') ?></td>
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
				<span class="tit">FAKTUR TAGIHAN </span>
			</div>

			<div class="clearfix" style="margin-bottom: 30px;"></div>

			<div class="col-md-12">
				<table border="0" style="font-weight: bold;" class="table table-responsive table-borderless">
					<tr>
						<td style="border-top: 0;">Nama</td>
						<td style="border-top: 0;">:</td>
						<td style="border-top: 0;"><?=@$data[0]['kontak_nama'].' ( '.@$data[0]['kontak_tlp'].' )'?></td>
					<tr>
						<td style="border-top: 0;">Alamat</td>
						<td style="border-top: 0;">:</td>
						<td style="border-top: 0;"><?=@$data[0]['kontak_alamat']?></td>
					</tr>
				</table>
			</div>

			<div class="col-md-12">
			
				<table class="table table-responsive">
					<thead>
						<tr>
							<th width="70">No</th>
							<th>Barang</th>
							<th class="r">Qty</th>
							<th hidden class="r">Potongan</th>
							<th class="r">Harga</th>
							<th class="r">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach (@$data as $val): ?>

							<tr>
								<td><?=$i?></td>
								<td><?=@$val['barang_nama']?></td>
								<td class="r"><?=@$val['penjualan_barang_qty'].' '.@$val['satuan_singkatan']?></td>
								<td hidden class="r"><?=@$val['penjualan_barang_diskon'].' %'?></td>
								<td class="r"><?=number_format(@$val['penjualan_barang_subtotal'])?></td>
								<td class="subtotal r"><?=number_format(@$val['penjualan_barang_subtotal'])?></td>
							</tr>
						
						<?php $i++ ?>
						<?php endforeach ?>

						<tr>
							<td colspan="3"></td>
							<td class="r">Total</td>
							<td class="r"><span id="total"></span></td>
						</tr>
						<tr>
							<td style="border-top: 0;" colspan="3">Jatuh Tempo : <?php @$d = date_create(@$data[0]['penjualan_jatuh_tempo']); echo date_format($d, 'd M Y') ?></td>
							<td style="border-top: 0;" class="r">PPN (<span id="ppn"><?=@$data[0]['penjualan_ppn']?></span>%)</td>
							<td style="border-top: 0;" class="r"><span id="ppn_total"></span></td>
						</tr>
						<tr>
							<td style="border-top: 0;" colspan="3">Keterangan : <?=@$data[0]['penjualan_keterangan']?></td>
							<td style="border-top: 0;" class="r"><b>Total Akhir</b></td>
							<td style="border-top: 0;" class="r"><b id="total_akhir"></b></td>
						</tr>

					</tbody>
				</table>
			</div>

			<!-- <div class="clearfix"></div><br/>

			<div class="col-md-6 col-xs-6">
				<center>
				<p>Di Buat oleh</p>
				<br/><br/><br/>
				<p>( ___________________  )</p>
				</center>
			</div>

			<div class="col-md-6 col-xs-6" align="right">
				<center>
				<p>Penerima</p>
				<br/><br/><br/>
				<p>( ___________________  )</p>
				</center>
			</div> -->

		</div>

	</div>

</body>
</html>

<script type="text/javascript">
	
	var subtotal = $('.subtotal');
	var total = 0;
	$.each(subtotal, function(index, val) {
		 
		 total += parseInt($(this).text().replace(/,/g, ''));
		 
	});

	$('#total').text(number_format(total));

	var ppn = Number($('#ppn').text()) * Number(total) / 100;
    var final = Number(ppn) + Number(total); 

    $('#ppn_total').text(number_format(ppn));
	$('#total_akhir').text(number_format(final));

	
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>