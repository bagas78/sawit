<script type="text/javascript">
  $('form').attr('action', '<?=base_url('gudang/update/'.@$data['gudang_id'])?>');

  $('.kode').val('<?=@$data['gudang_kode']?>');
  $('.nama').val('<?=@$data['gudang_nama']?>');
  $('.alamat').val('<?=@$data['gudang_alamat']?>');
  $('.luas').val('<?=@$data['gudang_luas']?>');
  $('.keterangan').val('<?=@$data['gudang_keterangan']?>');
</script>