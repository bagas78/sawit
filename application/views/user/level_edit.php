<script type="text/javascript">
	$('form').attr('action', '<?=base_url('user/level_update/'.@$data['level_id'])?>');

	$('[name="level_nama"]').val('<?=@$data['level_nama']?>');
	$('[name="level_notif"]').val('<?=@$data['level_notif']?>').change();
	$('[name="level_kontak"]').val('<?=@$data['level_kontak']?>').change();
	$('[name="level_gudang"]').val('<?=@$data['level_gudang']?>').change();
	$('[name="level_reminder"]').val('<?=@$data['level_reminder']?>').change();
	$('[name="level_kebun"]').val('<?=@$data['level_kebun']?>').change();
	$('[name="level_pembelian"]').val('<?=@$data['level_pembelian']?>').change();
	$('[name="level_pengeluaran"]').val('<?=@$data['level_pengeluaran']?>').change();
	$('[name="level_recording"]').val('<?=@$data['level_recording']?>').change();
	$('[name="level_monitoring"]').val('<?=@$data['level_monitoring']?>').change();
	$('[name="level_penjualan"]').val('<?=@$data['level_penjualan']?>').change();
	$('[name="level_laporan"]').val('<?=@$data['level_laporan']?>').change();
	$('[name="level_absensi"]').val('<?=@$data['level_absensi']?>').change();
	$('[name="level_tampilan"]').val('<?=@$data['level_tampilan']?>');
</script>
