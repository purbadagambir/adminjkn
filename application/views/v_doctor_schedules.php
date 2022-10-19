<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h4 mb-0 text-gray-800"><i class="fa fa-calendar text-gray-500"></i> Jadwal Dokter</h3>
        <button onclick="window.history.back()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</button>
    </div>
    <hr>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-gray-100 py-3">

        </div>
        <div class="card-body">
            <div class="table-responsive" id="printlayout">
                <table id="datatable" class="table table-striped table-sm table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Hari</th>
                            <th>Jadwal</th>
                            <th>Kapasitas</th>
                            <th>Nama Poli</th>
                            <th>Tanggal Create</th>
                            <th>Tanggal Update</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = json_decode($list);
                        //var_dump($data);
                        if ($data->metadata->code == 200) {
                            if ($data->response != null) {
                                $no = 1;
                                foreach ($data->response as $agt) : ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $agt->namadokter; ?></td>
                                        <td><?php echo $agt->namahari; ?></td>
                                        <td><?php echo $agt->jadwal; ?></td>
                                        <td><?php echo $agt->kapasitaspasien; ?></td>
                                        <td><?php echo $agt->namapoli; ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', $agt->createdate); ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', $agt->lastupdate); ?></td>
                                        <td><a href="<?php echo base_url('doctors/deleteJadwal/') . $agt->kodedokter . '/' . $agt->jadwal; ?>" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fa fa-trash"></i> </a></td>
                                    </tr>
                        <?php endforeach;
                            }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Hari</th>
                            <th>Jadwal</th>
                            <th>Kapasitas</th>
                            <th>Nama Poli</th>
                            <th>Tanggal Create</th>
                            <th>Tanggal Update</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>