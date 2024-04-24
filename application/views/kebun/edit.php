<script type="text/javascript">
  $('form').attr('action', '<?=base_url('kebun/update/'.@$data['kebun_id'])?>');

  $('.kode').val('<?=@$data['kebun_kode']?>');
  $('.nama').val('<?=@$data['kebun_nama']?>');
  $('.alamat').val('<?=@$data['kebun_alamat']?>');
  $('.luas').val('<?=@$data['kebun_luas']?>');
  $('.tanaman').val('<?=@$data['kebun_tanaman']?>');
  $('.keterangan').val('<?=@$data['kebun_keterangan']?>');
</script>