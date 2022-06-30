<div class="container-fluid">

    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>

    <div class="row mb-1">
        <div class="col-lg-5">
            <div class="card mb-4 ml-0">
                <div class=" card-header bg-primary text-white h3"><i class="fa fa-user-md"></i> <strong>ANTRIAN POLIKLINIK</strong></div>
                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 50%; width: 98%;">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100 rounded" src="<?= base_url('assets/img/sliders/1.jpg'); ?>" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>RSU MITRA MEDIKA</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima, vitae eos? In a nesciunt nihil incidunt sed non repellat. Voluptatum similique molestias fuga temporibus provident excepturi obcaecati sed voluptas eaque!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?= base_url('assets/img/sliders/2.jpg'); ?>" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>We serve with Smile</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur voluptatum distinctio, provident nobis numquam cumque fugiat laudantium doloribus deserunt vel, adipisci repellendus harum aliquid dolorem, recusandae eaque deleniti sunt neque?</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?= base_url('assets/img/sliders/1.jpg'); ?>" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>...</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem tempora harum esse eveniet sequi velit ea quos. Eos, nostrum exercitationem voluptatibus unde obcaecati dolorem quaerat impedit, sapiente temporibus asperiores numquam.</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <!-- Rawat Jalan Card -->
        <div class="col-xl-3 col-md-6 mb-1">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Queues</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800" id="rawatjalan">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-1">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Admission</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800" id="rawatinap">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-procedures fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctors Data -->
        <div class="col-xl-3 col-md-6 mb-1">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Poliklinik Today</div>
                            <p class="h6 mb-0 font-weight-bold text-gray-800" id="doctor-poli"></p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments -->
        <div class="col-xl-3 col-md-6 mb-1">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Appointment Scheduled</div>
                            <p class="h6 mb-0 font-weight-bold text-gray-800" id="appointment">0 Visitor(s)</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
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

<!-- Rs Register Web service Modal-->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register Webservice Account</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('dashboard/registerWs') ?>" method="POST">
                    <div class="form-group row">
                        <label for="ws_ppk" class="col-sm-3 col-form-label">PPK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="ws_ppk" name="ws_ppk" placeholder="PPK">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ws_id" class="col-sm-3 col-form-label">ID RS</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ws_user_id" id="ws_id" placeholder="ID Rumah Sakit">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ws_name" class="col-sm-3 col-form-label">Nama RS</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ws_name" id="ws_name" placeholder="Nama Rumah Sakit">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ws_const_id" class="col-sm-3 col-form-label">Const ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ws_const_id" id="ws_const_id" placeholder="Cons Id">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ws_secreet_key" class="col-sm-3 col-form-label">Key</label>
                        <div class="col-sm-9">
                            <input type="password" suggested="current-password" class="form-control" name="ws_secreet_key" id="ws_secreet_key" placeholder="Password">
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
<script>
    $(document).ready(function() {
        $('.loader').hide();
    })
</script>

</body>

</html>