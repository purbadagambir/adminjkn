<div class="container-fluid">
    <!-- Page Heading -->
    <?php echo $this->session->flashdata('message'); ?>

    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>
    <!-- <?php var_dump($poli); ?> -->

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- <div class="col-lg-5 d-none d-lg-block"></div> -->
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create New Appointment</h1>
                        </div>
                        <form class="user" method="POST" action="<?= base_url('appointment/setAppointment'); ?>">
                            <div class="form-group row">
                                <div class="col-sm mb-0 mb-sm-0">
                                    <label for="id" class="col-form-label">Pasien</label>
                                </div>
                                <div class="col-sm-2 mb-1 mb-sm-0">
                                    <input type="text" readonly class="form-control" name="norm" placeholder="norm" value="<?= $param['rm']; ?>">

                                </div>
                                <div class="col-sm-3">
                                    <input type="text" readonly required class="form-control" name="nomorkartu" placeholder="" value="<?php if ($param['social'] == 'null') {
                                                                                                                                            echo "";
                                                                                                                                        } else {
                                                                                                                                            echo $param['social'];
                                                                                                                                        } ?>">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" readonly class="form-control" placeholder="Name" name="namapeserta" value="<?= $param['name']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-0 mb-sm-0">
                                    <label for="id" class="col-form-label">Tanggal</label>
                                </div>
                                <div class="col-sm-6 mb-0 mb-sm-0">
                                    <input type="date" class="form-control" id="tanggal" name="tanggalperiksa">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-0 mb-sm-0">
                                    <label for="id" class="col-form-label">Poliklinik</label>
                                </div>
                                <div class="col">
                                    <select id="kodepoli" name="kodepoli" class="form-control" required>
                                        <option selected>Pilih Poliklinik</option>
                                        <?php
                                        $list_poli = json_decode($poli);
                                        if ($list_poli->metadata->code == 200) {
                                            foreach ($list_poli->response as $value) : ?>
                                                <option value="<?= $value->kode_poli; ?>"><?= $value->nama_poli; ?></option>
                                        <?php endforeach;
                                        } else {
                                            echo '<option value="">' . $list_poli->metadata->message . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-0 mb-sm-0">
                                    <label for="dokter" class="col-form-label">Dokter</label>
                                </div>
                                <div class="col">
                                    <select id="dokter" name="kodedokter" class="form-control">
                                        <!-- di isi dari ajax -->
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select id="jampraktek" name="jampraktek" class="form-control">
                                        <!-- di isi dari ajax -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-0 mb-sm-0">
                                    <label for="referensi" class="col-form-label">Referensi</label>
                                </div>
                                <div class="col-sm-6 mb-0 mb-sm-0">
                                    <input type="text" class="form-control" name="nomorreferensi" placeholder="No Rujukan Faskes 1 ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-0 mb-sm-0">

                                </div>
                                <div class="col-sm mb-1 mb-sm-0">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-calendar-check"></i> Set Appointment </button>
                                    <button type="button" class="btn btn-danger" onclick="window.history.back()"><i class="fa fa-recycle"></i> Cancel </button>
                                </div>
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


<script>
    $(document).ready(function() {
        $('.loader').hide();
    });

    function dataDokter() {
        var poli = $('#kodepoli').val();
        var tanggal = $('#tanggal').val();
        var tdata = '<option selected>Pilih Dokter</option>';
        $.ajax({
            method: 'POST',
            url: '<?= base_url('appointment/getJadwalDokter'); ?>',
            data: {
                poli: poli,
                tanggal: tanggal
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                for (let i = 0; i < data.list.length; i++) {
                    tdata += '<option value="' + data.list[i].kodedokter + '">' + data.list[i].namadokter + '</option>';
                }
                $('#dokter').html(tdata);
            }
        })
    }

    function jamPraktek() {
        var poli = $('#kodepoli').val();
        var tanggal = $('#tanggal').val();
        var dokter = $('#dokter').val();
        var tdata = '<option selected>Pilih Jam Praktek Dokter</option>';

        $.ajax({
            method: 'POST',
            url: '<?= base_url('appointment/getjampraktek'); ?>',
            data: {
                kodedokter: dokter,
                kodepoli: poli,
                tanggal: tanggal
            },
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                for (let i = 0; i < data.response.length; i++) {
                    tdata += '<option value="' + data.response[i].jadwal + '">' + data.response[i].jadwal + '</option>';
                }
                $('#jampraktek').html(tdata);
            }
        })
    }

    $('#kodepoli').change(function() {
        dataDokter();
    });

    $('#tanggal').change(function() {
        dataDokter();
    });

    $('#dokter').change(function() {
        jamPraktek();
    });
</script>

</body>

</html>