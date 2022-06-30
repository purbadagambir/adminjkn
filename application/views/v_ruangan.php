<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> Ruangan Poliklinik</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
    </div>
    <hr>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>
    <div class="card mb-1">
        <div class="card-body">
            <button class="btn btn-sm btn-primary mb-1" data-dismiss="close" data-toggle="modal" data-target="#downloaddoctorModal"><i class="fa fa-plus"></i> Tambah</button>
            <a href="#" class="btn btn-sm btn-secondary mb-1" onclick="printLayer('printlayout')"><i class="fa fa-print"></i> Cetak</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header bg-gray-500 py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive" id="printlayout">
                <table id="datatable" class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Poli</th>
                            <th>Nama</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = json_decode($list);
                        // var_dump($list);
                        if ($data->response != null) {
                            $no = 1;
                            foreach ($data->response as $agt) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $agt->id; ?></td>
                                    <td><?php echo $agt->nama; ?></td>
                                    <td><button class="btn btn-sm btn-danger btn-delete" data-dismiss="close" data-toggle="modal" data-target="#del-dialog" data-bs-id="<?= $agt->id; ?>"><i class="fa fa-trash" title="Delete"></i></button>
                                        <button class="btn btn-sm btn-warning btn-edit"><i class="fa fa-edit" title="Edit"></i></button>
                                    </td>
                                </tr>
                        <?php endforeach;
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Kode Poli</th>
                            <th>Nama</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="downloaddoctorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title h5" id="exampleModalLabel"><i class="fa fa-plus"></i> Tambah Data</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden=5"true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('polikliniks/ruanganinsert') ?>" method="POST">
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="id_ruangan"> ID :</label>
                            </div>
                            <div class="form-group col-sm">
                                <input type="text" required class="form-control" id="id_ruangan" name="id_ruangan" placeholder="ID Ruangan"></input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="nama_ruangan"> Nama :</label>
                            </div>
                            <div class="form-group col-sm">
                                <input type="text" required class="form-control" id="nama_ruangan" name="nama_ruangan" placeholder="Nama Ruangan"></input>
                            </div>
                        </div>

                </div>
                <div class="card-footer">
                    <button type="Reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="Submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="del-dialog" role="dialog">
        <form action="<?= base_url('polikliniks/ruangandelete'); ?>" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <i class="fa fa-question-circle"></i> Confirmation</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">X</button>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="id_ruangan"> ID :</label>
                            </div>
                            <div class="form-group col-sm">
                                <input type="text" required class="form-control" id="id-edit" name="id-edit" placeholder="ID Ruangan"></input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="nama_ruangan"> Nama :</label>
                            </div>
                            <div class="form-group col-sm">
                                <input type="text" required class="form-control" id="nama-edit" name="nama-edit" placeholder="Nama Ruangan"></input>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi-check-lg"></i> Yes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="edit-dialog" role="dialog">
        <form action="<?= base_url('polikliniks/ruangandelete'); ?>" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <i class="fa fa-question-circle"></i> Confirmation</h5>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">X</button>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <p id="message"></p>
                        <input type="text" hidden id="id-edit" name="id-edit"></i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi-check-lg"></i> Yes</button>
                    </div>
                </div>
            </div>
        </form>
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

<script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/buttons.print.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/jszip.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/pdfmake.min.js') ?>"> </script>
<script src="<?= base_url('assets/js/vfs_fonts.js') ?>"> </script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: ['print', 'pdf', 'excel']
        });

        $('.loader').hide();


        $('.btn-delete').on('click', function() {
            var id = $(this).attr('data-bs-id');

            $('#message').html('Apakah anda ingin menghapus data ' + id + ' ?');
            $('#id-delete').val(id);
        });

        $('.btn-edit').on('click', function() {
            var id = $(this).attr('data-bs-id');
            var name = $(this).attr('data-bs-name');

            $('#id-edit').val(id);
            $('#id-name').val(id);
        });
    });
</script>

<script>

</script>

</body>

</html>