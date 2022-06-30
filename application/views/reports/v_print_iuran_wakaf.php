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
	  <div class="card-header bg-primary text-light">Informasi Wakif</div>
	  <div class="card-body">
	    <h5 class="card-title"><?php echo $this->session->userdata('name') ?></h5>
	    <?php
	    	$wakif = json_decode($list2); 
	    	if($wakif->response!=null) {
	    	foreach ($wakif->response as $value) : ?>
	    	<p class="card-text">Harga Wakaf : IDR <?php echo number_format($value->harga_wakaf) ?> <br>No Sertifikat :<?php echo $value->no_sertifikat?></p>
	    <?php endforeach; }?>
	  </div>
	</div>

	<div class="card shadow">
		<div class="card-header text-light bg-primary text-center">
			DATA IURAN WAKAF STM	
		</div>	
		<div class="card-body">	
			<div class="table-responsive">
				<table class="table table-sm table-bordered" id="datatable">
					<thead>
						<tr class="bg-light text-center font-weight-bold">
							<td>No</td>
							<td>Tanggal Bayar</td>
							<td>Nilai</td>
							<td>Ref#</td>
						</tr>
					</thead>
					<tbody>
					<?php 
						$no =1;
						$totaliuran=0;
						$iuranwakaf = json_decode($list);
						foreach ($iuranwakaf->response as $iw ) : ?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td><?php echo mdate('%d-%m-%Y ',$iw->tanggal_bayar) ?></td>
								<td><?php echo 'Rp. '.number_format($iw->nilai) ?></td>
								<td class="text-center"><?php echo '#'.$iw->nomor ?></td>
							</tr>
					<?php $totaliuran+=$iw->nilai;
						endforeach; ?>
					</tbody>
					<tfoot>
		            	<tr>
			                <!-- <th></th> -->
			                <th align="text-right" colspan="2">JUMLAH </th>
			                <th> <?php echo 'Rp. '.number_format($totaliuran).',-' ?></th>
			                <th></th>
			            </tr>
			        </tfoot>
				</table>
			</div>
		</div>
</div>		

