<script type="text/javascript">
	
	$('form').attr('action', '<?=base_url('pengeluaran/kategori_update/'.@$data['pengeluaran_kategori_id'])?>');
	$('.nama').val('<?=@$data['pengeluaran_kategori_nama']?>');
	$('.keterangan').val('<?=@$data['pengeluaran_kategori_keterangan']?>');

</script>