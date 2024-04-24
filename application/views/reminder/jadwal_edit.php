<script type="text/javascript">
	$('form').attr('action', '<?=base_url('reminder/jadwal_update/'.@$data['reminder_jadwal_id'])?>');
	$('.kode').val('<?=@$data['reminder_jadwal_kode']?>');
	$('.kebun').val('<?=@$data['reminder_jadwal_kebun']?>').change();
	$('.kategori').val('<?=@$data['reminder_jadwal_kategori']?>').change();
	$('.hari').val('<?=@$data['reminder_jadwal_hari']?>');
	$('.keterangan').val('<?=@$data['reminder_jadwal_keterangan']?>');
</script>