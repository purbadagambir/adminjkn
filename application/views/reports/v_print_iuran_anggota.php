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

	<div class="card bg-light mb-2" style="max-width: 20rem;">
	  <div class="card-header bg-primary text-light">Informasi Anggota</div>
	  <div class="card-body">
	    <h5 class="card-title"><?php echo $this->session->userdata('name') ?></h5>
	    	<p class="card-text"><?php echo  $this->session->userdata('email')?></p>
	  </div>
	</div>

	<div class="card shadow">
		<div class="card-header bg-primary text-center text-light">
			<strong>DATA IURAN STM</strong>
		</div>	
		<div class="card-body">	
			<div class="table-responsive">
				<table class="table table-sm table-bordered" id="datatable">
					<thead>
						<tr class="font-weight-bold">
							<td class="text-center">No</td>
							<td>Type</td>
							<td>Bulan</td>
							<td>Nilai</td>
							<td>Tanggal Dibukukan</td>
							<td>Ref#</td>
						</tr>
					</thead>
					<tbody>
					<?php 
						$no =1;
						$iuran_anggota = json_decode($list);
						$type='';
						$tIuran=0;
						if($iuran_anggota->response !=null) {
						foreach ($iuran_anggota->response as $ia ) :
						$tIuran = $tIuran + $ia->nilai; 
							if($ia->type==0) {
								$type='IURAN'; 
							}
							elseif($ia->type==2) {
								$type='INFAQ';
							}	
							elseif($ia->type==3) {
								$type='PENDAFTARAN';
							}
							elseif($ia->type==4) {
								$type='PENUTUP';
							}
							?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td><?php echo $type; ?></td>
								<td><?php echo mdate('%m-%Y',$ia->bulan_iuran); ?></td>
								<td><?php echo 'Rp. '.number_format($ia->nilai) ?></td>
								<td><?php echo mdate('%d-%F-%Y ',$ia->tanggal_bayar) ?></td>
								<td class="text-center"><?php echo '#'.$ia->no_referensi ?></td>
							</tr>
					<?php endforeach; } ?>
					</tbody>
					<tfoot>
		            	<tr class="bg-light">
			                <!-- <th></th> -->
			                <th align="text-right" colspan="2">JUMLAH </th>
			                <th></th>
			                <th> <?php echo 'Rp. '.number_format($tIuran).',-' ?></th>
			                <th></th>
			                <th></th>
			            </tr>
			        </tfoot>
				</table>
			</div>
		</div>
</div>

