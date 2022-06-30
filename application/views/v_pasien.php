<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900">Daftar Pasien Baru</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
    </div>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>

    <div class="card mb-1">
        <div class="card-body">
            <a href="#" class="btn btn-sm btn-secondary" onclick="printLayer('printlayout')"><i class="fa fa-print"></i> Cetak</a>
        </div>
    </div>
    <div class="card shadow mb-4 printlayout">
        <div class="card-header bg-gray-100 py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-sm table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. RM</th>
                            <th>No Kartu</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Tanggal Create</th>
                            <th>Tanggal Applied</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = json_decode($list);
                        // var_dump($list);
                        if ($data->metadata->code == 200) {
                            if ($data->response != null) {
                                $no = 1;
                                foreach ($data->response as $agt) : ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $agt->norm; ?></td>
                                        <td><?php echo $agt->nomorkartu; ?></td>
                                        <td><?php echo $agt->nama; ?></td>
                                        <td><?php echo $agt->alamat; ?></td>
                                        <td><?php echo $agt->nohp; ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', $agt->createdate); ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', $agt->applieddate); ?></td>
                                        <td><button class="btn btn-sm btn-add btn-success" title="Add Data To E-Med" data-no-kartu="<?= $agt->nomorkartu ?>"><i class="fa fa-plus"></i></button></td>
                                        <td class="text-center" onclick="javascript : return confirm('Anda yakin menghapus data ini ?')"> <?php echo anchor('antrean/checkin/' . $agt->norm, '<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>') ?></td>
                                    </tr>
                        <?php endforeach;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addtoemed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambahkan Pasien?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Apakah anda yakin akan menambahkan pasien ini ?
                        <form action="<?= base_url('pasien/insert') ?>" method="post">
                            <input type="text" hidden id="nokartu" name="nokartu">
                            <button class="btn btn-primary" type="submit">Yes</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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

<!-- <script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/jszip.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/pdfmake.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/vfs_fonts.js') ?>"> </script> -->

<script>
    $(document).ready(function() {
        // $('#datatable').DataTable({
        //   dom: 'Bfrtip',
        //   buttons: ['print', 'pdf', 'csv', 'excel']
        // });

        $('.loader').hide();

        $('.btn-add').click(function() {
            $('#addtoemed').modal();
            let nokartu = $(this).attr('data-no-kartu');
            $('#nokartu').val(nokartu);
        })
    });
</script>

</body>

</html>