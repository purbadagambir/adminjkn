<div class="container-fluid">

   <span class="mr-auto ml-md-0 my-2 my-md-0">
    <div class="row">
      <img src="<?php echo base_url('assets/img/logo.png') ?>" class="figure-img" alt="" style="max-width: 5rem">  
      <div class="col-sm-9 text-center">
        <h4><strong class="text-primary">STM ISTIQOMAH</strong></h4> 
        <h5>Graha Deli Permai, Deli Tua, Namorambe</h5>  
      </div>
    </div>
   </span>
   <hr>
  
  <div class="card shadow mb-4">
    <div class="card-header bg-primary font-weight-bold text-center text-light">
      JADWAL SILATURAHMI ANGGOTA STM PERIODE 2020 - 2023
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-sm table-striped table-bordered" id="datatable">
          <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Alamat</th>
          </tr>
          </thead>
          <tbody>

          <?php 
            $no =1;
            $silaturahmi = json_decode($list);
            if($silaturahmi!=null) {
            foreach ($silaturahmi->response as $slmi ):  ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td><?php $tanggal = date_create($slmi->tanggal);
                    echo date_format($tanggal,'d M Y'); ?></td>
              <td><?php echo $slmi->nama; ?></td>
              <td><?php echo $slmi->alamat; ?></td>
            </tr>
          <?php endforeach; } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
    </div>
  </div>
</div>
