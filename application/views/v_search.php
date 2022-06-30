<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="h5 mb-0 text-gray-900"><i class="fa fa-users"></i> Search Patient</h5>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.history.back()"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
    <hr>

    <?php echo $this->session->flashdata('message'); ?>
    <div class="card mb-1">
        <div class="card-header bg-secondary">

        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <input type="text" hidden id="txtparent" class="form-control" value="<?= $tipe; ?>">
                    <div class="col">
                        <select id="txtopt" name="opt" class="form-control form-control-sm">
                            <option selected value="0">Choose...</option>
                            <option value="1">No Rekam Medik</option>
                            <option value="2">Nama</option>
                        </select>
                    </div>
                    <div class="col-7">
                        <input type="text" id="txtdata" name="txtdata" class="form-control form-control-sm" placeholder="Rm atau Nama">
                    </div>
                    <div class="col">
                        <button type="button" id="btn_search" class="btn btn-sm btn-dark mb-2"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-1">
        <div class="card-header">
            <i class="fa fa-list"></i>
        </div>
        <div class="card-body">
            <div class="loader">
                <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped text-sm">
                    <thead>
                        <th>#</th>
                        <th>RM</th>
                        <th>Nama</th>
                        <th>Social</th>
                        <th>DOB</th>
                        <th>J.Kel</th>
                        <th></th>
                    </thead>
                    <tbody id="datapasien">

                    </tbody>
                    <tfoot>
                        <th>#</th>
                        <th>RM</th>
                        <th>Nama</th>
                        <th>Social</th>
                        <th>DOB</th>
                        <th>J.Kel</th>
                        <th></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- modal message -->
    <div class="modal" tabindex="-1" role="dialog" id="modal_message">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-info-circle"></i> Admin JKN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="message_text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    $('#btn_search').click(function() {
        var vopsi = $('#txtopt').val();
        var vdata = $('#txtdata').val();
        var vparent = $('#txtparent').val();
        var dest;
        var tdata = '';

        if (vopsi < 1) {
            $('#modal_message').modal();
            $('#message_text').html('Silahkan pilih Opsi pencarian');
            return;
        }
        if ((vdata.length) < 3) {
            $('#modal_message').modal();
            $('#message_text').html('Data pencarian minimal 3 karakter');
            return;
        }
        $('.loader').show();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('appointment/searchPatientByOpt'); ?>',
            data: {
                opt: vopsi,
                param: vdata
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.metadata.code == 200) {
                    for (let i = 0; i < data.list.length; i++) {
                        if (vparent == 'operasi') {
                            dest = '<td><a href="<?= base_url('operasi/newOperasi/') ?>' + data.list[i].RM_NO + '/' + data.list[i].NAME + '/' + data.list[i].SOCIAL_NO + '" class="btn btn-sm btn-danger" title="Set New Operasi"> <i class="fa fa-user-plus"> </i></a ></td></tr >';
                        } else {
                            dest = '<td><a href="<?= base_url('appointment/newAppointment/') ?>' + data.list[i].RM_NO + '/' + data.list[i].NAME + '/' + data.list[i].SOCIAL_NO + '" class="btn btn-sm btn-secondary" title="Set Appointment"> <i class="fa fa-user-plus"> </i></a ></td></tr >';
                        }

                        tdata += '<tr><td>' + i + '</td>' +
                            '<td>' + data.list[i].RM_NO + '</td>' +
                            '<td>' + data.list[i].NAME + '</td>' +
                            '<td>' + data.list[i].SOCIAL_NO + '</td>' +
                            '<td>' + data.list[i].DOB + '</td>' +
                            '<td>' + data.list[i].SEX + '</td>' +
                            dest;
                    }
                } else {
                    tdata = '<tr><td class="text-center text-gray-500" colspan="7"> No data to display</td><tr>';
                }
                $('#datapasien').html(tdata);
            }
        })
        $('.loader').hide();
    });
</script>
</body>

</html>