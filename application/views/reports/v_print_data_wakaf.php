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
      DATA PEWAKIF TANAH PERKUBURAN STM
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered table-sm table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Harga Wakaf</th>
                    <th>Total Bayar</th>
                    <th>Sisa</th>
                    <th>Lunas</th>
                </tr>
            </thead>
            <tbody>
              <?php 
                  $data = json_decode($list);
                  $no =1;
                  $total=0;
                  $total_bayar=0;
                  $total_sisa=0;
                  if($data!=null) {
                  foreach ($data->response as $agt ) : ?> 
                    <tr>
                      <td><?php echo $no++ ?></td>  
                      <td><?php echo $agt->nama; ?></td>  
                      <td><?php echo $agt->alamat; ?></td>  
                      <td><?php echo number_format($agt->harga_wakaf); ?></td>  
                      <td><?php echo number_format($agt->total_bayar); ?></td>
                      <td><?php echo number_format($agt->harga_wakaf- $agt->total_bayar); ?></td>
                      <td><?php echo $agt->lunas; ?></td> 
                    </tr>
              <?php  $total+= $agt->harga_wakaf;
                   $total_bayar+= $agt->total_bayar;
                   $total_sisa+=($agt->harga_wakaf- $agt->total_bayar);
                  endforeach; } ?>
            </tbody>
            <tfoot class="bg-light">
                <tr>
                    <th colspan="3">Total : </th>
                    <th><?php echo number_format($total) ?></th>
                    <th><?php echo number_format($total_bayar) ?></th>
                    <th><?php echo number_format($total_sisa) ?></th>
                    <th></th>
                </tr>
            </tfoot>
          </table>
        </div>
    </div> 
</div>
