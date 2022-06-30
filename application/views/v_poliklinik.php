<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> Poliklinik</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
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
                            <th>Kode Sub Spesialis</th>
                            <th>Nams Sub Spesialis</th>
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
                                        <td><?php echo $agt->kode_poli; ?></td>
                                        <td><?php echo $agt->nama_poli; ?></td>
                                        <td><?php echo $agt->kd_subspesialis; ?></td>
                                        <td><?php echo $agt->nama_subspesialis; ?></td>
                                    </tr>
                        <?php endforeach;
                            }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Kode Poli</th>
                            <th>Nama</th>
                            <th>Kode Sub Spesialis</th>
                            <th>Nams Sub Spesialis</th>
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
                    <p class="modal-title h5" id="exampleModalLabel">Opsi Dowload</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden=5"true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('polikliniks/getDataPoliHfis/' . PPK) ?>" method="POST">
                        <h6>Apakah anda yakin akan mendowload data Poliklinik dari Hfis ?</h6>
                        <p class="text-xs"> * Note : Proses ini akan memakan waktu karena adanya proses syncronisasi data dengan HFIS</p>
                        <button type="Reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="Submit" class="btn btn-primary">OK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>