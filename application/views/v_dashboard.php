<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h5 mb-0 text-gray-900"><i class="fa fa-tachometer-alt"></i> Dashboard</h5>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="refreshData()"><i class="fas fa-recycle fa-sm text-white-50"></i> Refresh</a>
  </div>
  <hr>
  <?php echo $this->session->flashdata('message');
  //var_dump($rs);
  ?>

  <div class="loader">
    <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
  </div>

  <div class="row">
    <!-- Rawat Jalan Card -->
    <div class="col-xl-3 col-md-6 mb-4">
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
    <div class="col-xl-3 col-md-6 mb-4">
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
    <div class="col-xl-3 col-md-6 mb-4">
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
    <div class="col-xl-3 col-md-6 mb-4">
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

  <div class="row">
    <div class="col-lg-8">
      <div class="card mb-4 ml-0">
        <div class=" card-header bg-primary text-white"><i class="fa fa-user-md"></i> <strong>Jadwal Poliklinik </strong></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm table-hover table-striped">
              <thead class="table-header">
                <tr>
                  <th>#</th>
                  <th>Kode</th>
                  <th>Spesialis</th>
                  <th>Name</th>
                  <th>Jadwal</th>
                  <th>Ruangan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="jadwal">
                <!-- di isi dari ajax -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-header bg-success text-white"><i class="fa fa-hospital"></i> <strong>Patient Info</strong></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm table-hover table-striped">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody id="info">
                <!-- di isi dari ajax -->
              </tbody>
            </table>
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
    refreshData();
    $('.loader').hide();
  });

  function refreshData() {
    $('.loader').show();
    getQuestData();
    getAdmissionData();
    getinfoData();
    getJadwalPoli();
    getAppointmentData();
    $('.loader').hide();
  }

  function getQuestData() {
    $.ajax({
      type: 'GET',
      url: '<?= base_url('dashboard/quesData'); ?>',
      dataType: 'json',
      success: function(data) {
        //console.log(data);
        if (data.metadata.code == 200) {
          $('#rawatjalan').html(data.list.JUMLAH + ' Patient(s)');
        } else {
          $('#rawatjalan').html('0 Patient(s)');
        }
      }
    });
  }

  function getAdmissionData() {
    $.ajax({
      type: 'GET',
      url: '<?= base_url('dashboard/admissionData'); ?>',
      dataType: 'json',
      success: function(data) {
        //console.log(data);
        if (data.metadata.code == 200) {
          $('#rawatinap').html(data.list.JUMLAH + ' Patient(s)');
        } else {
          $('#rawatinap').html('0 Patient(s)');
        }
      }
    });
  }

  function getAppointmentData() {
    $.ajax({
      type: 'GET',
      url: '<?= base_url('dashboard/countAppointment'); ?>',
      dataType: 'json',
      success: function(data) {
        console.log(data);
        if (data.metadata.code == 200) {
          $('#appointment').html(data.list.JUMLAH + ' Visitor(s)');
        } else {
          $('#appointment').html('0 Visitor(s)');
        }
      }
    });
  }

  function getJadwalPoli() {
    var tdata = '';
    var x = 0;
    $.ajax({
      type: 'GET',
      url: '<?= base_url('dashboard/getJadwalPoli'); ?>',
      dataType: 'json',
      success: function(data) {
        // console.log(data);
        if (data.metadata.code == 200) {
          for (let i = 0; i < data.list.length; i++) {
            x++;
            tdata += '<tr class="text-xs">' +
              '<td>' + x + '</td>' +
              '<td>' + data.list[i].kodedokter + '</td>' +
              '<td>' + data.list[i].namapoli + '</td>' +
              '<td>' + data.list[i].namadokter + '</td>' +
              '<td>' + data.list[i].jadwal + '</td>' +
              '<td>' + data.list[i].nama_ruangan + '</td>' +
              '<td> <a href="<?= base_url('doctors/jadwal/'); ?>' + data.list[i].kodedokter + '" class="badge" title="View jadwal"><i class="fa fa-list"></i></a></td>' +
              '</tr>'
          }
        } else {
          tdata = '<tr><td colspan=4 class="text-center"> No data found</td></tr>';
        }
        $('#jadwal').html(tdata);
        $('#doctor-poli').html(x + ' Poliklinik');
      }
    });
  }

  function getinfoData() {
    var tdata = '';
    var x = 0;
    $.ajax({
      type: 'GET',
      url: '<?= base_url('dashboard/patientInfo'); ?>',
      dataType: 'json',
      success: function(data) {
        //console.log(data);
        if (data.metadata.code == 200) {
          for (let i = 0; i < data.list.length; i++) {
            x++;
            tdata += '<tr class="text-sm">' +
              '<td>' + x + '</td>' +
              '<td>' + data.list[i].NAME + '</td>' +
              '<td>' + data.list[i].JUMLAH + '</td>' +
              '</tr>'
          }
        } else {
          tdata = '<tr><td colspan=3></td></tr>';
        }
        $('#info').html(tdata);
      }
    });
  }
</script>

</body>

</html>