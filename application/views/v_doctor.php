<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-user-md"></i> Doctor Data</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.history.back()"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
    <hr>
    <?php echo $this->session->flashdata('message'); ?>

    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>

    <div class="card mb-1">
        <div class="card-body">
            <button class="btn btn-sm btn-success mb-1" data-dismiss="close" data-toggle="modal" data-target="#downloaddoctorModal"><i class="fa fa-download"></i> Download Hfis</button>
            <a href="#" class="btn btn-sm btn-secondary mb-1" onclick="printLayer('printlayout')"><i class="fa fa-print"></i> Cetak</a>
        </div>
    </div>

    <div class="card mb-1">
        <div class="card-body">
            <div class="row">
                <?php
                $dokter = json_decode($list);
                if ($dokter->metadata->code == 200) {
                    foreach ($dokter->response as $value) : ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100">
                                <div class="card-header bg-secondary"></div>
                                <div class="card-body bg-light">
                                    <p class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $value->namadokter ?></p>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="mb-0 text-gray-800"><small><?= $value->inisialantrian . ' - ' . $value->namaruangan . ' : ' . $value->namapoli; ?></small></div>
                                            <a href="<?= base_url('doctors/jadwal/') . $value->kodedokter; ?>" class="btn btn-sm btn-info" title="Jadwal"><i class="fa fa-list"></i></a>
                                            <button type="button" class="btn btn-sm btn-success btn-edit-dokter" data-id_dokter="<?= $value->kodedokter; ?>" data-nama_dokter="<?= $value->namadokter; ?>" data-inisial="<?= $value->inisialantrian; ?>" data-doctor_no="<?= $value->doctor_no; ?>" title="Edit"><i class="fa fa-edit"></i></button>
                                            <?php
                                            if (($value->doctor_no) == 0) { ?>
                                                <a href="<?= base_url('doctors/addToEMed/') . $value->kodedokter; ?>" class="btn btn-warning btn-sm" title="Add To E-Med"><i class="fa fa-plus"></i></a>
                                            <?php  }  ?>
                                            <!-- <a href="<?= base_url('doctors/synToEmed/') . $value->kodedokter; ?>" class="btn btn-sm btn-secondary" title="Sync To E-Med"><i class="fa fa-upload"></i></a> -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-md fa-3x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                } ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="downloaddoctorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title h5" id="exampleModalLabel">Opsi Dowload</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden=5"true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('doctors/getJadwalHfis'); ?>" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="kodepoli">Kode Poliklinik </label>
                        </div>
                        <div class="form-group col-sm-8">
                            <select name="kodepoli" id="kodepoli" class="form-control">
                                <option value="" selected>Pilih Poli</option>
                                <?php
                                $data_poli = json_decode($poli);
                                if ($data_poli->metadata->code = 200) {
                                    foreach ($data_poli->response as $value) : ?>
                                        <option value="<?= $value->kode_poli; ?>"><?= $value->nama_poli; ?></option>
                                <?php endforeach;
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="tanggal" class=""> Tanggal Praktek</label>
                        </div>
                        <div class="form-group col-sm-8">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="No.RM">
                        </div>
                    </div>

                    <button type="Reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
                    <button type="Submit" class="btn btn-primary">Submit</button>
                </form>
                <p class="text-xs"> * Note : Proses ini akan memakan waktu karena adanya proses syncronisasi data dengan HFIS</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="inisialAntrian" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="inisialAntrian">Setup Inisial Antrian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="doctors/setInisial" method="POST">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="ed_id_dokter">Nama Dokter</label>
                        </div>
                        <div class="form-group col-sm-8">
                            <input type="text" class="form-control" hidden id="ed_id_dokter" name="kodedokter">
                            <input type="text" class="form-control" readonly id="ed_nama_dokter">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="ed_id_dokter">Dokter E-Med</label>
                        </div>
                        <div class="form-group col-sm-8">
                            <select name="contact_no" id="contact_no" class="form-control">
                                <option value="" selected> Pasangkan dokter E-Med</option>
                                <?php
                                $data_doctor = json_decode($doctors);
                                if ($data_doctor->metadata->code = 200) {
                                    foreach ($data_doctor->list as $value) : ?>
                                        <option value="<?= $value->CONTACT_NO; ?>"><?= $value->NAME; ?></option>
                                <?php endforeach;
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="inisial">Inisal Antrean</label>
                        </div>
                        <div class="form-group col-sm-8">
                            <input type="text" id='inisial' name="inisialantrian" class="form-control text-uppercase" placeholder="Inisial Antrian">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="ed_id_dokter">Ruangan Poli</label>
                        </div>
                        <div class="form-group col-sm-8">
                            <select name="nama_ruangan" id="nama_ruangan" class="form-control">
                                <option value="" selected> Pilih Ruangan Poli</option>
                                <?php
                                $data_ruangan = json_decode($ruangan);
                                if ($data_ruangan->response != null) {
                                    foreach ($data_ruangan->response as $vruangan) : ?>
                                        <option value="<?= $vruangan->nama; ?>"><?= $vruangan->nama; ?></option>
                                <?php endforeach;
                                } ?>
                            </select>
                        </div>
                    </div>
                    <button type="Reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="Submit" class="btn btn-primary">Save changes</button>
                </form>
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

<script>
    $(document).ready(function() {
        $('.loader').hide();
    });

    $('.btn-edit-dokter').click(function() {
        $('#edit').modal();
        var id_dokter = $(this).attr('data-id_dokter');
        var nama_dokter = $(this).attr('data-nama_dokter');
        var doctor_no = $(this).attr('data-doctor_no');
        var inisial = $(this).attr('data-inisial');
        var poli = $(this).attr('data-poli');
        $('#ed_id_dokter').val(id_dokter);
        $('#ed_nama_dokter').val(nama_dokter);
        $('#contact_no').val(doctor_no);
        $('#inisial').val(inisial);
        $('#nama_ruangan').val(poli);
    });
</script>

</body>

</html>