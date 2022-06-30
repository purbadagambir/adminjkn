<div class="container-fluid">
	<div class="card bg-gradient-primary mb-2 py-0 border-top-primary">
	    <div class="card-body">
	      <h4 class="text-center text-light"><strong>Profil Anggota</strong></h4>
	    </div>
	 </div>
	<div class="loader">
	    <center><img src="<?php echo base_url('assets/img/spinner/').'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
	</div>

	<div class="card mb-3" style="max-width: 540px;">
	  <div class="row no-gutters">
	    <div class="col-md-4">
	      <img src="<?php echo base_url() ?>assets/foto/<?php echo $detail->foto ?>" class="card-img" alt="...">
	    </div>
	    <div class="col-md-8">
	      <div class="card-body">
	        <h5 class="card-title"><strong><?php echo $detail->nama ?></strong></h5>
	       	<p class="font-weight-bold"><?php echo $detail->alamat?> </p>
			<a href="<?php echo base_url('admin/anggota/edit/'.$detail->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Update Profiles</a>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jadwal Silaturahmi</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">
              	<?php 
	        		$list = json_decode($silaturahmi);
	        		if($list->response== null) {
	        			echo 'Belum Di Tentukan';
	        		} else {
	        			foreach ($list->response as  $value) {
	        				echo date('D, d-m-Y',strtotime($value->tanggal));	
	        			}
	        		}
	         	?>	   
          	  </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Bulan Iuran</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800">
              	<?php echo date('m-Y',$max_bulan); ?>	
		          	<a href="<?php echo base_url('admin/iuran/data_iuran_anggota/').$this->session->userdata('id') ; ?>" class="btn-circle btn-sm bg-light"><i class="fas fa-search"></i></a>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tunggakan</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                  	<?php echo 'IDR. '. number_format($tunggakan); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>	
	<div class="card">
	  <h5 class="card-header bg-dark text-light">Detail Keluarga</h5>
	  <div class="card-body">
	    <h5 class="card-title"></h5>
	    <table class="table table-striped table-sm">
			<tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
			</tr>
		
			<tr>
				<tr><th>Nama Istri</th>	<td>:</td><td><?php echo $detail->nama_istri; ?></td></tr>
				<tr><th>Nama Anak Pertama</th><td>:</td><td><?php echo $detail->anak_ke1; ?></td></tr>
				<tr><th>Nama Anak Kedua </th><td>:</td><td><?php echo $detail->anak_ke2; ?></td></tr>
				<tr><th>Nama Anak Ke Tiga </th>	<td>:</td><td><?php echo $detail->anak_ke3; ?></td></tr>
				<tr><th>Nama Orantua/ Ayah</th>	<td>:</td><td><?php echo $detail->tanggungan1; ?></td></tr>
				<tr><th>Nama Orang Tua/ Ibu</th>	<td>:</td><td><?php echo $detail->tanggungan2; ?></td></tr>
			</tr>
		</table>
	    <button class="btn btn-sm btn-primary" class="button" onclick="history.back(-1)" > Back</button>
	  </div>
	</div>	
</div>