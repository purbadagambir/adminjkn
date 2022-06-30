<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> List Task Antrean Per Tanggal</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
    </div>
    <hr>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>

    <div class="card mb-1">
        <div class="card-body">
            <form action="#">
                <div class="row">
                    <div class="col-3">
                        <input type="date" class="form-control form-control-sm" name="tanggal" id="tanggal">
                    </div>
                    <div class="col">
                        <select name="waktu" class="form-control form-control-sm" id="waktu">
                            <option value="0" selected>Pilih Nama Task Waktu</option>
                            <option value="server">Waktu dicatat oleh server BPJS Kesehatan </option>
                            <option value="rs">Waktu dicatat oleh server RS</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-sm btn-secondary" id="btn-view"><i class="fa fa-eye"></i> View</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header bg-success py-3">
        </div>
        <div class="card-body">
            <div class="row" id="perform">

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

        $('#btn-view').click(function() {
            $('.loader').show();
            let waktu = $('#waktu').val();
            let tanggal = $('#tanggal').val();
            let tdata = '';
            let x = 0;

            $.ajax({
                type: 'post',
                data: {
                    waktu: waktu,
                    tanggal: tanggal
                },
                url: '<?= base_url('dashboard/waktuTungguByDate'); ?>',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    // let second = new Date(1800 * 1000).toISOString().substr(14, 5);
                    // alert(second);
                    if (data.metadata.code == 200) {
                        for (let i = 0; i < data.response.list.length; i++) {
                            x++;
                            tdata += '<div class="col-xl-3 col-md-6 mb-4">' +
                                '<div class="card shadow h-100">' +
                                '<div class="card-header bg-info"></div>' +
                                '<div class="card-body bg-light">' +
                                '<p class="text-sm font-weight-bold text-primary text-uppercase mb-1"> <i class="fas fa-home"></i> ' + data.response.list[i].namapoli + '</p>' +
                                '<div class="row no-gutters align-items-center">' +
                                '<table class="table table-sm">' +
                                '<thead>' +
                                '<tr>' +
                                '<td colspan=2 class="bg-gray-200 text-center"> Performa</td>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody class="text-sm">' +
                                '<tr class="text-sm">' +
                                '<td> <i class="fas fa-users"></i> Total Antrean</td>' +
                                '<td> ' + data.response.list[i].jumlah_antrean + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td> <i class="fas fa-registered"></i> Pendaftaran</td>' +
                                '<td> ' + new Date(data.response.list[i].avg_waktu_task1 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><i class="fas fa-home"></i>  Poliklinik</td>' +
                                '<td> ' + new Date(data.response.list[i].avg_waktu_task3 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><i class="fas fa-pills"></i>  Farmasi</td>' +
                                '<td> ' + new Date(data.response.list[i].avg_waktu_task6 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                    } else {
                        tdata = '<p class="text-center">No data found</p>';
                    }
                    $('#perform').html(tdata);
                }
            });
            $('.loader').hide();
        })
    });
</script>

</body>

</html>