<section class="content-header">
      <h1>
        <?php echo $title; ?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> 

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

            <div align="left">
              <a href="<?=base_url('user/level_add')?>"><button class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</button></a>
            </div>
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <table id="example1" class="table table-bordered table-hover display nowrap" style="width: 100%;">
                <thead>
                <tr>
                  <th>Level</th>
                  <th>Tanggal Input</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr <?php if($key['level_id'] == 1){ echo 'style="pointer-events: none; background: gainsboro;"'; } ?>>
                    <td><?php echo $key['level_nama'] ?></td>
                    <td><?= $key['level_tanggal'] ?></td>
                    <td style="width: 80px;">
                      <div>
                      <a href="<?=base_url('user/level_edit/'.$key['level_id'])?>"><button class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></button></a>
                      <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapus<?php echo $key['level_id'] ?>"><i class="fa fa-trash"></i></button>

                      </div>
                    </td>
                  </tr>

                 <!--modal hapus-->
                  <div class="modal fade" id="modalHapus<?php echo $key['level_id'] ?>">
                    <div class="modal-dialog" align="center">
                      <div class="modal-content" style="max-width: 300px;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4>Confirmed ?</h4>   
                        </div>
                        <div class="modal-body" align="center">
                           <a href="<?php echo base_url() ?>user/level_delete/<?php echo $key['level_id'] ?>"><button class="btn btn-success" style="width: 49%;">Yes</button></a>
                           <button class="btn btn-danger" data-dismiss="modal" style="width: 49%;">No</button>
                        </div>
                      </div>
                    </div>
                   </div> 

                <?php endforeach ?>

                </tfoot>
              </table>

        </div>

        
      </div>
      <!-- /.box -->


    
      