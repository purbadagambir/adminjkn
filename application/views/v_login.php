<div class="container">
  <!-- Outer Row -->
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card o-hidden border-0 shadow-lg my-4">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <img src="<?php echo base_url('assets/') . 'img/logo.png'; ?> " alt="" class="img-fluid" style="width: 25%">
                  <h1 class="h4 text-gray-900 mb-4"><strong>Admin JKN Login</strong></h1>
                </div>
                <form class="user" method="post" action="<?php echo base_url('auth') ?>">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?php echo set_value('email') ?>">
                    <?php echo form_error('email', '<small class="text-danger pl-">', '</small>') ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    <?php echo form_error('password', '<small class="text-danger pl-">', '</small>') ?>
                  </div>
                  <div class="form-group">
                    <?php echo $this->session->flashdata('message'); ?>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in-alt"></i>
                    Login
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?php echo base_url('auth/registration') ?>">Register User</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>