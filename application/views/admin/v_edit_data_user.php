<div class="container-fluid">
 	<div class="card border-secondary mb-3">
	  <div class="card-header bg-secondary text-white"><strong>Form Edit Data User</strong></div>
	  <div class="card-body text-dark">
	    <h5 class="card-title">Data User</h5>
	    <hr>
	    <?php 
			$anggota = json_decode($list);
			foreach ($anggota->response as $agt) { ?>
			<?php echo form_open_multipart('admin/users/editUser') ?>
			<div class="row">
				<div class="form-group col-md-6">
					<label for="nama">Nama Anggota</label>
					<input type="hidden" name="id" id="id" value="<?php echo $agt->id; ?>" class="form-control">
					<input type="text" readonly name="nama" value="<?php echo $agt->nama; ?>" class="form-control">
				</div>

				<div class="form-group col-md-6">
					<label for="">E-Mail</label>
					<input type="text" readonly name="email" id="email" value="<?php echo $agt->email; ?>" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-8">
				<label for="role">Hak Akses</label>
	            <select class="form-control" name="role">
	                <option selected>Role</option>
	                <option value="0">Administrator</option>
	                <option value="1">User / Anggota</option>
	                <option value="2">Bendahara</option>
	                <option value="3">Pengurus</option>
	                <option value="4">Ketua</option>
	              </select>
	          	</div>    
	          	 <?php echo form_error('role','<small class="text-danger pl-3">','</small>') ?> 
			</div>		
		<?php  } form_close(); ?>	    
	  </div>
	  <div class="card-footer bg-transparent border-success">
	  	<button class="btn btn-success btn-sm" type="button" onclick="history.back(-1);">Cancel</button>
		<button class="btn btn-primary btn-sm" type="submit">Save Changes</button>	  	
	  </div>
	</div>
</div>
