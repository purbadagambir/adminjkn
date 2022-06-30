<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-sm-7 mx-auto">
      <div class="card-body p-3">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>

              <!-- FORM DATA REGISTER ANGGOTA -->
              <form class="user" method="post" action="<?php echo base_url('auth/registration') ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control" id="name" name="name" placeholder="Nama" value="<?php echo set_value('name') ?>">
                  <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                  <?php echo form_error('id_anggota', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control" id="email" name="email" placeholder="E-Mail Address" value="<?php echo set_value('email') ?>">
                  <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control" id="password1" name="password1" placeholder="Password">
                    <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control" id="password2" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user-plus"></i>
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?php echo base_url('auth') ?> ">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>