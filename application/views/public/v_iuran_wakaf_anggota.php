<div class="container-fluid">

	<div class="bg-gradient-primary mb-1 py-2 rounded-bottom rounded-top text-light">
		<H6 class="text-center mt-2"><strong>DATA IURAN WAKAF STM 2020-2023</strong></H6>
	</div>

	<div class="loader">
	    <center><img src="<?php echo base_url('assets/img/spinner/').'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
	</div>

	<div class="card bg-liht mb-2" style="max-width: 20rem;">
	  <div class="card-header bg-gradient-danger text-light">Informasi Wakaf</div>
	  <div class="card-body text-dark">
	    <h5 class="card-title"><?php echo $this->session->userdata('name') ?></h5>
	    <?php 
	    	$wakif = json_decode($list);
	    	if($wakif->response !=null) {
	    	foreach ($wakif->response as $value) : ?>
	    	<p class="card-text">Harga Wakaf : IDR <?php echo number_format($value->harga_wakaf) ?> <br>No Sertifikat :<?php echo $value->no_sertifikat?></p>
	    <?php endforeach; } ?>
	  </div>
	</div>

	<div class="card shadow">
		<div class="card-header">
			<div class="col-sm text-right">
					<a class="btn btn-dark btn-sm" onclick="printLayer('printIuranWakafAnggota')" href="#"><i class="fa fa-print"></i> Cetak </a>	
			</div>
	</div>	
		<div class="card-body">	
			<div class="table-responsive">
				<table class="table table-sm table-striped" id="datatable">
					<thead>
						<tr class="bg-light text-center">
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
						$iuranwakaf = json_decode($list2);
						if($iuranwakaf->response != null) {
						foreach ($iuranwakaf->response as $iw ) : ?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td><?php echo mdate('%d-%m-%Y ',$iw->tanggal_bayar) ?></td>
								<td><?php echo 'Rp. '.number_format($iw->nilai) ?></td>
								<td class="text-center"><?php echo '#'.$iw->nomor ?></td>
							</tr>
					<?php $totaliuran+=$iw->nilai;
						endforeach; }?>
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
