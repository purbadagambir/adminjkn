<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> Appointment</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
    </div>
    <hr>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>

    <div class="card mb-1">
        <div class="card-body">
            <a href="<?= base_url('appointment/searchPatient'); ?>" class="btn btn-sm btn-primary mb-1"><i class="fa fa-user-plus"></i> New Appointment</a>
            <a href="<?= base_url('appointment/downloadAppointment') ?>" class="btn btn-sm btn-success mb-1"><i class="fa fa-download"></i> Download </a>
            <a href="#" class="btn btn-sm btn-secondary mb-1" onclick="printLayer('printlayout')"><i class="fa fa-print"></i> Cetak</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header bg-gray-500 py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive" id="printlayout">
                <table id="datatable" class="table table-striped table-sm table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kodebooking</th>
                            <th>No.Kartu</th>
                            <th>RM</th>
                            <th>Dokter</th>
                            <th>Jadwal</th>
                            <th>Antrean</th>
                            <th>Estimasi Pelayanan</th>
                            <th>Ref.</th>
                            <th>JKN</th>
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
                                    <?php if ($agt->state == 1) { ?>
                                        <tr class="text-truncate">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $agt->kodebooking; ?></td>
                                            <td><?php echo $agt->nopeserta; ?></td>
                                            <td><?php echo $agt->norm; ?></td>
                                            <td class="text-capitalize"><?php echo $agt->namadokter; ?></td>
                                            <td class="text-truncate"><?php echo $agt->jampraktek; ?></td>
                                            <td><?php echo $agt->nomorantrean; ?></td>
                                            <td class="text-truncate"><?php echo date('d-m-Y H:i', $agt->estimasidilayani); ?></td>
                                            <td><?php echo $agt->nomorreferensi ?></td>
                                            <td><?php echo $agt->send_to_jkn; ?></td>
                                            <?php if ($agt->send_to_jkn == 'N') { ?>
                                                <td class="text-center" onclick="javascript : return confirm('Anda yakin menghapus data ini ?')"> <?php echo anchor('appointment/delete/' . $agt->kodebooking, '<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>') ?></td>
                                            <?php } else { ?>
                                                <td>&nbsp;</td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                        <?php endforeach;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>