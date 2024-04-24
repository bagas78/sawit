<script type="text/javascript">

<?php if(@$view == 1):?>
	$('.form-group, table').css('pointer-events', 'none');
	$('.back').removeAttr('hidden');
	$('.add').remove();
	$('.remove').remove();
	$('.save').remove(); 
<?php endif?>  
//form
$('.nomor').val('<?=@$data[0]['pengeluaran_nomor']?>');
$('.keterangan').val('<?=@$data[0]['pengeluaran_keterangan']?>');

//clone table
<?php $count = count(@$data) - 1; ?>
<?php for ($i = 0; $i < $count; $i++): ?>

	clone();

<?php endfor ?>

//insert table
<?php foreach(@$data as $key => $val): ?>

	$('.kategori:eq(<?=$key?>)').val('<?=$val['pengeluaran_barang_kategori']?>').change();
	$('.barang:eq(<?=$key?>)').val('<?=$val['pengeluaran_barang_barang']?>');
	$('.jumlah:eq(<?=$key?>)').val('<?=$val['pengeluaran_barang_jumlah']?>');
	$('.harga:eq(<?=$key?>)').val('<?=$val['pengeluaran_barang_harga']?>');

<?php endforeach ?>

</script>