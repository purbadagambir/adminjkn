<div class="container-fluid">
  <!-- Basic Card Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Reset Password</h6>
    </div>
    <div class="card-body">
      <form action="<?php echo base_url('auth/resetPassword'); ?>" method="post">
      	<?php echo form_error('id','<small class="text-danger pl-3">','</small>') ?>
      	<div class="form-group row">
  		  <div class="col-sm">
            <input type="hidden" readonly class="form-control" id="id" name="id" placeholder="user ID" value="<?php echo $this->session->userdata('id'); ?>">
          </div>
          <div class="col-sm mb-3 mb-sm-0">
            <input type="password" class="form-control" id="password1" name="password1" placeholder="Type New Password">
              <?php echo form_error('password1','<small class="text-danger pl-3">','</small>') ?>
          </div>
          <div class="col-sm">
            <input type="password" class="form-control form-control" id="password2" name="password2" placeholder="Retype New Password">
          </div>
        </div>

        <button  type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Submit </button>
        <a href="#" onclick="history.back(-1)" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Cancel</a>

      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->