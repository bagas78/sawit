<script type="text/javascript">
  $('form').attr('action', '<?=base_url('pekerjaan/update/'.@$data['pekerjaan_id'])?>');

  $('.kode').val('<?=@$data['pekerjaan_kode']?>');
  $('.nama').val('<?=@$data['pekerjaan_nama']?>');
  
</script>