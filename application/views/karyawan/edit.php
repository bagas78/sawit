<script type="text/javascript">
  $('form').attr('action', '<?=base_url('karyawan/update/'.@$data['karyawan_id'])?>');

  $('.kode').val('<?=@$data['karyawan_kode']?>');
  $('.nama').val('<?=@$data['karyawan_nama']?>');
  $('.alamat').val('<?=@$data['karyawan_alamat']?>');
  $('.telp').val('<?=@$data['karyawan_telp']?>');
  $('.kandang').val('<?=@$data['karyawan_kandang']?>').change();
  $('.pekerjaan').val('<?=@$data['karyawan_pekerjaan']?>').change();
  $('.jenis').val('<?=@$data['karyawan_jenis']?>').change();
  $('.upah').val('<?=@$data['karyawan_upah']?>');
</script>