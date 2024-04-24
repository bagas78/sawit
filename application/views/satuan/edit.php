<script type="text/javascript">
  $('form').attr('action', '<?=base_url('satuan/update/'.@$data['satuan_id'])?>');

  $('.nama').val('<?=@$data['satuan_nama']?>');
  $('.jumlah').val('<?=@$data['satuan_jumlah']?>');
  $('.singkatan').val('<?=@$data['satuan_singkatan']?>');
  $('.keterangan').val('<?=@$data['satuan_keterangan']?>');
</script>