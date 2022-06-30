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
        <div class="card-header bg-gray-300 py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive" id="printlayout">
                <table id="datatable" class="table table-striped table-sm table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>#</th>
                            <th>Task ID</th>
                            <th>Task Name</th>
                            <th>Waktu RS</th>
                            <th>Waktu BPJS</th>
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
                                    <tr class="text-xs">
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $agt->kodebooking; ?></td>
                                        <td><?php echo $agt->taskid; ?></td>
                                        <td><?php echo $agt->taskname; ?></td>
                                        <td><?php echo $agt->wakturs; ?></td>
                                        <td><?php echo $agt->waktu; ?></td>
                                    </tr>
                        <?php endforeach;
                            }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>#</th>
                            <th>Task ID</th>
                            <th>Task Name</th>
                            <th>Waktu RS</th>
                            <th>Waktu BPJS</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>