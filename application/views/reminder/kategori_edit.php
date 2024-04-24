<script type="text/javascript">
	$('form').attr('action', '<?=base_url('reminder/kategori_update/'.@$data['reminder_kategori_id'])?>');
	$('.nama').val('<?=@$data['reminder_kategori_nama']?>');
	$('.keterangan').val('<?=@$data['reminder_kategori_keterangan']?>');
</script>