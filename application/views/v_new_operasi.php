<div class="container-fluid">
    <!-- Page Heading -->
    <?php echo $this->session->flashdata('message'); ?>

    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>
    <!-- <?php var_dump($param); ?> -->

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- <div class="col-lg-5 d-none d-lg-block"></div> -->
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create New Jadwal Operasi</h1>
                        </div>
                        <form class="user" method="POST" action="<?= base_url('operasi/setoperasi'); ?>">
                            <div class="form-group-sm row">
                                <div class="col-sm mb-0 mb-sm-0">
                                    <label for="id" class="col-form-label-sm">Pasien</label>
                                </div>
                                <div class="col-sm-3 mb-1 mb-sm-0">
                                    <input type="text" readonly class="form-control form-control-sm" name="nomorrm" placeholder="norm" value="<?= $param['rm']; ?>">
                                    <input type="text" hidden class="form-control form-control-sm" name="nopeserta" placeholder="" value="<?= $param['social']; ?>">
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" readonly required class="form-control form-control-sm" placeholder="Name" name="namapeserta" value="<?= $param['name']; ?>">
                                </div>
                            </div>
                            <div class="form-group-sm row">
                                <div class="col-sm-2 mb-0 mb-sm-0">
                                    <label for="id" class="col-form-label-sm">Tanggal</label>
                                </div>
                                <div class="col-sm-6 mb-0 mb-sm-0">
                                    <input type="date" required class="form-control form-control-sm" name="tanggaloperasi">
                                </div>
                            </div>
                            <div class="form-group-sm-sm row">
                                <div class="col-sm-2 mb-0 mb-sm-0">
                                    <label for="id" class="col-form-label-sm">Spesialistik</label>
                                </div>
                                <div class="col">
                                    <select id="kodepoli" required name="kodepoli" class="form-control form-control-sm">
                                        <option selected>Pilih Spesialis</option>
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
                            <div class="form-group-sm row">
                                <div class="col-sm-2 mb-0 mb-sm-0">
                                    <label for="referensi" class="col-form-label-sm">Jenis Operasi</label>
                                </div>
                                <div class="col-sm mb-0 mb-sm-0">
                                    <input type="text" class="form-control form-control-sm" name="jenistindakan" placeholder="Jenis Tindakan Operasi ">
                                </div>
                            </div>
                            <div class="form-group-sm row">
                                <div class="col-sm-2 mb-0 mb-sm-0">

                                </div>
                                <div class="col-sm mb-1 mb-sm-0">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-calendar-check"></i> Set Operasi </button>
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

<!-- Data Table -->
<script src="<?php echo base_url('assets'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendor/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendor/datatables/buttons.flash.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: ['print', 'pdf', 'csv', 'excel']
        });

        $('.loader').hide();
    });
</script>

</body>

</html>