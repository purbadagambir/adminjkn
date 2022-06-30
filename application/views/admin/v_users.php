<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-1">
		<h3 class="h5 mb-0 text-gray-900"><i class="fa fa-users"></i> User Data</h3>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="window.history.back()"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
	</div>
	<hr>
	<?php echo $this->session->flashdata('message'); ?>

	<div class="card mb-1">
		<div class="card-body">
			<a href="<?= base_url('auth/registration'); ?>" class="btn btn-sm btn-primary mb-1"><i class="fa fa-user-plus"></i> Tambah Data</a>
			<a href="#" class="btn btn-sm btn-secondary mb-1" onclick="printLayer('printlayout')"><i class="fa fa-print"></i> Cetak</a>
		</div>
	</div>
	<div class="loader">
		<center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3"></div>
		<div class="card-body">
			<table class="table table-striped table-sm table-hover" id="table-user">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>E-Mail</th>
						<th>PPK</th>
						<th>Role</th>
						<th>Active</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$priv = '';
					$list = json_decode($userdata);
					if ($list->response != null) {
						foreach ($list->response as $user) :
							if ($user->role == 0) {
								$priv = 'Administrator';
							} elseif ($user->role == 1) {
								$priv = 'Anggota';
							}
					?>

							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $user->nama; ?></td>
								<td><?php echo $user->email; ?></td>
								<td><?php echo $user->ppk; ?></td>
								<td><?php echo $priv; ?></td>
								<td><?php echo $user->activated; ?></td>
								<td class="text-center"><button type="button" class="btn btn-sm btn-success ed-user" data-id="<?= $user->id; ?>"><i class="fa fa-edit"></i> </button></td>
								<td></td>
							</tr>
					<?php endforeach;
					} ?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal Grant User Access -->
	<div class="modal" tabindex="-1" role="dialog" id="user_modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">User Activation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url('users/activateUser') ?>" method="POST">
						<div class="form-group row">
							<div class="col-sm-9">
								<input type="text" hidden class="form-control" id="id_user" name="id_user" placeholder="id_user">
							</div>
						</div>

						<div class="form-group row">
							<label for="ppk" class="col-sm-2 col-form-label">PPK</label>
							<div class="col-sm-4">
								<input type="text" readonly class="form-control" id="ppk" name="ppk" value="<?= PPK; ?>">
							</div>
							<div class="col-sm-6">
								<input type="text" readonly class="form-control" id="nama" name="nama" value="<?= RS; ?>">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-2"> </div>
							<div class="col-sm-10">
								<button class="btn btn-secondary mb-1" type="close" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary mb-1 ml-1"><i class="fa fa-user-check"></i> Activate </button>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Cahayasolusindo <?php echo Date('Y') ?></span>
		</div>
	</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Logout</a>
			</div>
		</div>
	</div>
</div>


<!-- Setting Modal-->
<div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Setup Admin JKN</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('auth/settingrs') ?>" method="POST">
					<div class="form-group row">
						<label for="ppk" class="col-sm-3 col-form-label">PPK</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="ppk" name="ppk" placeholder="PPK">
						</div>
					</div>

					<div class="form-group row">
						<label for="nama" class="col-sm-3 col-form-label">Nama RS</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Rumah Sakit">
						</div>
					</div>

					<div class="form-group row">
						<label for="constid" class="col-sm-3 col-form-label">Const ID</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="constid" name="constid" placeholder="Cons Id">
						</div>
					</div>

					<div class="form-group row">
						<label for="key" class="col-sm-3 col-form-label">Key</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="key" name="key" placeholder="Password">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-3"> </div>
						<div class="col-sm-9">
							<button class="btn btn-secondary mb-1 ml-1" type="close" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary mb-1 ml-1">Save</button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets'); ?>/js/sb-admin-2.min.js"></script>

<!-- Page level custom scripts -->
<!-- <script src="<?php echo base_url('assets'); ?>/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url('assets'); ?>/js/demo/chart-pie-demo.js"></script> -->

<!-- Data Table -->
<script src="<?php echo base_url('assets'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendor/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendor/datatables/buttons.flash.min.js"></script>

<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/jszip.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/pdfmake.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/vfs_fonts.js') ?>"> </script>

<script>
	$(document).ready(function() {
		$('#table-user').DataTable({
			dom: 'Bfrtip',
			buttons: ['print', 'pdf', 'csv', 'excel']
		});

		$('.loader').hide();
	});

	$('.ed-user').click(function() {
		var id = $(this).attr('data-id');
		$('#user_modal').modal();
		$('#id_user').val(id);

	});
</script>

</body>

</html>