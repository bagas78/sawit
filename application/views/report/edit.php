<script type="text/javascript">
  $('form').attr('action', '<?=base_url('report/update/'.@$data['report_id'])?>');

  $('.tanggal').val('<?=@$data['report_tanggal']?>');
  $('.kandang').val('<?=@$data['report_kandang']?>').change();
  $('.catatan').val('<?=@$data['report_catatan']?>');
  $('.kondisi_kandang').val('<?=@$data['report_kondisi_kandang']?>');
  $('.kondisi_suhu').val('<?=@$data['report_kondisi_suhu']?>');

</script>