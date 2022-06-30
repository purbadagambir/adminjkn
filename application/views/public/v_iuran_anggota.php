<div class="container-fluid">

	<div class="bg-gradient-primary mb-1 py-2 rounded-bottom rounded-top text-light">
		<h6 class="text-center mt-2"><strong>DATA IURAN SAYA</strong></h6>
	</div>

	<div class="loader">
	    <center><img src="<?php echo base_url('assets/img/spinner/').'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
	</div>

	<div class="card shadow">
		<div class="card-header">
			<div class="col-sm text-right">
					<a class="btn btn-dark btn-sm" href="#" onclick="printLayer('printIuranAnggota') "><i class="fa fa-print"></i> Cetak </a>	
			</div>
	</div>	
		<div class="card-body">	
			<div class="table-responsive">
				<table class="table table-sm table-striped" id="datatable">
					<thead>
						<tr class="bg-light text-center text-dark">
							<td>No</td>
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
						$type='';
						$total=0;

						$iuran_anggota = json_decode($list);
						if($iuran_anggota->response !=null) {
						foreach ($iuran_anggota->response as $ia ) : 
							$total = $total + $ia->nilai; 
							if($ia->type==0) {
								$type='IURAN'; 
							}
							if($ia->type==2) {
								$type='INFAQ';
							}	
							if($ia->type==3) {
								$type='PENDAFTARAN';
							}
							if($ia->type==4) {
								$type='PENUTUP';
							}
							?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td><?php echo $type; ?></td>
								<td><?php echo mdate('%m-%Y',$ia->bulan_iuran); ?></td>
								<td><?php echo 'Rp. '.number_format($ia->nilai) ?></td>
								<td><?php echo mdate('%d-%m-%Y ',$ia->tanggal_bayar) ?></td>
								<td class="text-center"><?php echo '#'.$ia->no_referensi ?></td>
							</tr>
					<?php endforeach; } ?> 
					</tbody>
					<tfoot>
		            	<tr class="bg-light">
			                <!-- <th></th> -->
			                <th align="text-right" colspan="2">JUMLAH </th>
			                <th></th>
			                <th> <?php echo 'Rp. '.number_format($total).',-' ?></th>
			                <th></th>
			                <th></th>
			            </tr>
			        </tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
