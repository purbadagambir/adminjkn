<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> List Task Antrean</h3>
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
                    <div class="col">
                        <select name="waktu" class="form-control form-control-sm" id="waktu">
                            <option value="0" selected>Pilih Nama Task Waktu</option>
                            <option value="server">Waktu dicatat oleh server BPJS Kesehatan </option>
                            <option value="rs">Waktu dicatat oleh server RS</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="bulan" class="form-control form-control-sm" id="bulan">
                            <option value="0" selected>Pilih Nama Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-control form-select form-control-sm" name="tahun" id="tahun">
                            <option value="0" selected>Pilih Tahun</option>
                            <?php
                            $year = date('Y') - 3;
                            for ($i = 0; $i < 5; $i++) :
                            ?>
                                <option value="<?= $year + $i ?>"><?= $year + $i ?></option>
                            <?php endfor; ?>
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
        <div class="card-header bg-gray-500 py-3">
        </div>
        <div class="card-body">
            <div class="row" id="perform"></div>
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead class="table-header">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Nama Poli</th>
                            <th>jml Antrean</th>
                            <th>Task 1</th>
                            <th>Task 2</th>
                            <th>Task 3</th>
                            <th>Task 4</th>
                            <th>Task 5</th>
                            <th>Task 6</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard">
                        <!-- di isi dari ajax -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row text-xs">
                <div class="col">Task 1 : Waktu Tunggu Pendaftaran</div>
                <div class="col">Task 2 : Waktu Pelayanan Pendaftaran</div>
                <div class="col">Task 3 : Waktu Tunggu Poliklinik</div>
                <div class="col">Task 4 : Waktu Layanan Poliklinik</div>
                <div class="col">Task 5 : Waktu Tunggu Farmasi</div>
                <div class="col">Task 6 : Waktu Layanan Farmasi</div>
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
            let bulan = $('#bulan').val();
            let tahun = $('#tahun').val();
            let tdata = '';
            let x = 0;
            let total = 0;

            $.ajax({
                type: 'post',
                data: {
                    waktu: waktu,
                    bulan: bulan,
                    tahun: tahun
                },
                url: '<?= base_url('dashboard/waktuTungguByMonth'); ?>',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    // let second = new Date(1800 * 1000).toISOString().substr(14, 5);
                    // alert(second);
                    if (data.metadata.code == 200) {
                        for (let i = 0; i < data.response.list.length; i++) {
                            x++;
                            total = data.response.list[i].avg_waktu_task1 + data.response.list[i].avg_waktu_task2 +
                                data.response.list[i].avg_waktu_task3 + data.response.list[i].avg_waktu_task4 + data.response.list[i].avg_waktu_task5 + data.response.list[i].avg_waktu_task6;
                            tdata += '<tr class="table-xs">' +
                                '<td>' + x + '</td>' +
                                '<td>' + data.response.list[i].tanggal + '</td>' +
                                '<td>' + data.response.list[i].namapoli + '</td>' +
                                '<td>' + data.response.list[i].jumlah_antrean + '</td>' +
                                '<td>' + new Date(data.response.list[i].avg_waktu_task1 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '<td>' + new Date(data.response.list[i].avg_waktu_task2 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '<td>' + new Date(data.response.list[i].avg_waktu_task3 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '<td>' + new Date(data.response.list[i].avg_waktu_task4 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '<td>' + new Date(data.response.list[i].avg_waktu_task5 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '<td>' + new Date(data.response.list[i].avg_waktu_task6 * 1000).toISOString().substr(11, 8) + '</td>' +
                                '<td>' + new Date(total * 1000).toISOString().substr(11, 8) + '</td>' +
                                '</tr>'
                        }
                    } else {
                        tdata = '<tr><td colspan=3></td></tr>';
                    }
                    $('#dashboard').html(tdata);
                }
            });
            $('.loader').hide();
        })
    });
</script>

</body>

</html>