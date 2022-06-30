<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav  sticky-top bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="https://cahayasolusindo.com">
        <div class="content">
          <img src="<?php echo base_url('assets') ?>/img/developer.png" class="img-thumbnail rounded-circle" alt="..." style="height: 33px; width: 33px;">
        </div>
        <div class="sidebar-brand-text mx-3 text-warning">Cahayasoft<sup>&copy;</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('dashboard') ?>">
          <i class="fas fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        ADMIN ANTREAN
      </div>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnteran" aria-expanded="false" aria-controls="collapseUtilities">
          <i class="fas fa-users-cog"></i>
          <span>Antrean</span>
        </a>
        <div id="collapseAnteran" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">ANTREAN</h6>
            <a class="collapse-item" href="<?php echo base_url('appointment'); ?>">Appointment</a>
            <a class="collapse-item" href="<?php echo base_url('medicalrecords'); ?>">Data No RM</a>
            <a class="collapse-item" href="<?php echo base_url('pasien'); ?>">Data Pasien Baru</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDokter" aria-expanded="false" aria-controls="collapseUtilities">
          <i class="fas fa-user-md"></i>
          <span>Dokter</span>
        </a>
        <div id="collapseDokter" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Dokter</h6>
            <a class="collapse-item" href="<?php echo base_url('polikliniks'); ?>">Data Poli</a>
            <a class="collapse-item" href="<?php echo base_url('doctors'); ?>">Data Dokter</a>
            <a class="collapse-item" href="<?php echo base_url('polikliniks/ruangan'); ?>">Data Ruangan</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOperasi" aria-expanded="false" aria-controls="collapseUtilities">
          <i class="fas fa-procedures"></i>
          <span>Operasi</span>
        </a>
        <div id="collapseOperasi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">JADWAL OPERASI</h6>
            <a class="collapse-item" href="<?php echo base_url('operasi'); ?>">Jadwal Operasi</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTask" aria-expanded="false" aria-controls="collapseUtilities">
          <i class="fas fa-chart-line"></i>
          <span>Task</span>
        </a>
        <div id="collapseTask" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Task Performa</h6>
            <a class="collapse-item" href="<?php echo base_url('dashboard/sendingstatus'); ?>">Sending Status</a>
            <a class="collapse-item" href="<?php echo base_url('dashboard/waktuTungguByHari'); ?>">Performa Per Tanggal</a>
            <a class="collapse-item" href="<?php echo base_url('dashboard/waktutunggu'); ?>">Performa Per Bulan</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">
          <i class="fas fa-sign-out-alt"></i>
          <span>LogOut</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-info topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <a class="navbar-brand text-sm" href="<?= base_url('dashboard'); ?>">
            <img src="<?= base_url('assets') . '/img/logo.png' ?>" width="30" height="30" class="d-inline-block align-top rounded" alt="">
            <small><?= PPK . ' - ' . RS;  ?></small>
          </a>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-300 small"><?= $this->session->userdata('email'); ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/foto/person-blank.png'); ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#registerModal" title="Only on dashboard page">
                  <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                  Register WS
                </a>
                <a class="dropdown-item" href="<?= base_url('users'); ?>">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->