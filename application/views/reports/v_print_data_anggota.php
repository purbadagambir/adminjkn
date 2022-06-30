<div class="container-fluid">

   <span class="mr-auto ml-md-0 my-2 my-md-0">
    <div class="row">
      <img src="<?php echo base_url('assets/img/logo.png') ?>" class="figure-img" alt="" style="max-width: 6rem">  
      <div class="col-sm-9 text-center">
        <h4><strong class="text-primary">STM ISTIQOMAH</strong></h4> 
        <p>Graha Deli Permai, Deli Tua, Namorambe</p>  
      </div>
    </div>
   </span>
   <hr>
  
  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-info"> 
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="datatable" class="table table-bordered table-sm table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
              <?php 
                    $no =1;
                    $anggota = json_decode($list);
                    foreach ($anggota->response as $agt ) : ?> 
                    <tr>
                      <td><?php echo $no++ ?></td>  
                      <td><?php echo $agt->nama; ?></td>  
                      <td><?php echo $agt->alamat; ?></td>  
                      <td><?php echo $agt->notelepon; ?></td> 
                      <td><?php echo $agt->status; ?></td>  
                    </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
               <!--  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                </tr> -->
            </tfoot>
          </table>
        </div>
    </div> 
</div>
</div>
