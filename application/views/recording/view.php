<script type="text/javascript">

//data	 
$('#nomor').val('<?=@$data['recording_nomor']?>');
$('#tanggal').val('<?=@$data['recording_tanggal']?>');
$('#kebun').val('<?=@$data['recording_kebun']?>').change();
$('#suhu').val('<?=@$data['recording_suhu']?>');
$('#kondisi').val('<?=@$data['recording_kondisi']?>');
$('form').attr('action', '<?=base_url('recording/update/'.@$data['recording_id'])?>');

//clone input 
<?php $i = 1;?>

<?php foreach ($data_barang as $v): ?>

	//panen 
	<?php if($v['recording_barang_kategori'] == 'panen'): ?>

		<?php if($i - 0): ?> 

			clone('panen');

		<?php endif ?>

	<?php $i++ ?>

	<?php endif ?>

	//back value
	<?php $i = 1; ?>

	//pruning 
	<?php if($v['recording_barang_kategori'] == 'pruning'): ?>

		<?php if($i - 0): ?>

			clone('pruning');

		<?php endif ?>

	<?php $i++ ?>

	<?php endif ?>

	//back value
	<?php $i = 1; ?>

	//semprot
	<?php if($v['recording_barang_kategori'] == 'semprot'): ?>

		<?php if($i - 0): ?>

			clone('semprot');

		<?php endif ?>

	<?php $i++ ?>

	<?php endif ?>

	//back value
	<?php $i = 1; ?>

	//semprot
	<?php if($v['recording_barang_kategori'] == 'pupuk'): ?>

		<?php if($i - 0): ?>

			clone('pupuk');

		<?php endif ?>

	<?php $i++ ?>

	<?php endif ?>

<?php endforeach ?>



//// INSERT VALUE /////

<?php $i_a = 0; ?>
<?php $i_b = 0; ?>
<?php $i_c = 0; ?>
<?php $i_d = 0; ?>
<?php foreach(@$data_barang as  $key => $v): ?>

	//panen
	<?php if($v['recording_barang_kategori'] == 'panen'): ?>
		
		$('.panen:eq(<?=$i_a?>)').val('<?=$v['recording_barang_jumlah']?>');

		<?php $i_a++; ?>
	<?php endif ?>
 
	//pruning
	<?php if($v['recording_barang_kategori'] == 'pruning'): ?>
		
		$('.pruning:eq(<?=$i_b?>)').val('<?=$v['recording_barang_jumlah']?>');

		<?php $i_b++; ?>
	<?php endif ?>

	//pruning
	<?php if($v['recording_barang_kategori'] == 'semprot'): ?>
		
		$('.semprot:eq(<?=$i_c?>)').val('<?=$v['recording_barang_barang']?>').change();
		$('.semprot_jumlah:eq(<?=$i_c?>)').val('<?=$v['recording_barang_jumlah']?>');

		<?php $i_c++; ?>
	<?php endif ?>

	//pupuk
	<?php if($v['recording_barang_kategori'] == 'pupuk'): ?>
		
		$('.pupuk:eq(<?=$i_d?>)').val('<?=$v['recording_barang_barang']?>').change();
		$('.pupuk_jumlah:eq(<?=$i_d?>)').val('<?=$v['recording_barang_jumlah']?>');

		<?php $i_d++; ?>
	<?php endif ?>

<?php endforeach ?>

</script>