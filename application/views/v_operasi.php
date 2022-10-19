<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-calendar"></i> Jadwal Operasi</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.history.back()"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back </a>
    </div>
    <hr>
    <div class="card mb-1">
        <div class="card-body">
            <a href="<?= base_url('operasi/searchpatient'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Set Jadwal Operasi</a>
            <a href="#" class="btn btn-sm btn-secondary" onclick="printLayer('printlayout')"><i class="fa fa-print"></i> Cetak</a>
        </div>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>

    <div class="card mb-2">
        <div class="card-header bg-gray-300"></div>
        <div class="card-body">
            <div class="row col-xl">
                <?php
                // var_dump($reqheader);
                $operasi = json_decode($list);
                if ($operasi->metadata->code === 200) {
                    foreach ($operasi->response->list as $value) : ?>
                        <div class="card ml-1 mb-1">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-1">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $value->namapoli ?></div>
                                        <div class="h6 mb-0 text-gray-800"><strong><?= $value->kodebooking; ?></strong></div>
                                        <div class="mb-0 text-gray-800"><small><?= $value->tanggaloperasi; ?></small></div>
                                        <?php if ($value->terlaksana == 1) { ?>
                                            <button disabled onclick="setBookingValue('<?= $value->kodebooking; ?>')" class="btn btn-sm btn-primary" title="Terlaksana" data-toggle="modal" data-target="#new"><i class="fa fa-check-double"></i></button>
                                        <?php } else { ?>
                                            <button onclick="setBookingValue('<?= $value->kodebooking; ?>')" class="btn btn-sm btn-success" title="Set Terlaksana" data-toggle="modal" data-target="#new"><i class="fa fa-user-check"></i></button>
                                        <?php } ?>
                                        <button class="btn btn-sm btn-danger btn-batal" title=" Batal" data-kodebooking="<?= $value->kodebooking; ?>"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-procedures fa-2x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                } else {
                    echo '<p class="text-center">' . $operasi->metadata->message . '</p>';
                } ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Set Operasi Terlaksana</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php echo form_open_multipart('operasi/setTerlaksana'); ?>
                    <div class="row">
                        <div class="form-group col-sm">
                            <input type="text" hidden class="form-control" id="ed_kodeboking" name="kodebooking"></input>
                            <input type="date" name="tanggalterlaksana" class="form-control" placeholder="">
                        </div>
                    </div>

                    <button type="Reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
                    <button type="Submit" class="btn btn-primary">Save changes</button>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="batal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="bataloperasi">Batal Operasi </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="info_kodebooking"></p>

                    <form action="<?= base_url('operasi/batalOperasi'); ?>" method="POST">
                        <div class="row">
                            <div class="form-group col-sm">
                                <input type="text" hidden class="form-control" id="batal_kodeboking" name="batal_kodebooking"></input>
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        <button type="Submit" class="btn btn-primary">Yes</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Footer -->
<footer class="sticky-footer bg-white fix-buttom">
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
    });

    $('.btn-batal').click(function() {
        $('#batal').modal();
        var kodebooking = $(this).attr('data-kodebooking');
        $('#info_kodebooking').html('Apakah anda yakin akan membatalkan jadwal operasi kode booking : ' + kodebooking + ' ?');
        $('#batal_kodeboking').val(kodebooking);
    });
</script>

<script>
    function setBookingValue(data) {
        $('#ed_kodeboking').val(data);
    }
</script>

</body>

</html>