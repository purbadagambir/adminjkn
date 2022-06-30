<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> List Task Antrean</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
    </div>
    <hr>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="loader">
        <center><img src="<?php echo base_url('assets/img/spinner/') . 'loading.gif' ?>" alt="" style="height: 40px; width:40px"></center>
    </div>

    <div class="card mb-1">
        <div class="card-body">
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
                            <th>Task</th>
                            <th>No Antrean</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Selisih</th>
                            <th>Send To JKN</th>
							<th>Response</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = json_decode($list);
                        // var_dump($list);
                        if ($data->metadata->code == 200) {
                            if ($data->response != null) {
                                $no = 1;
                                foreach ($data->response->list as $agt) : ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $agt->KODE_BOOKING; ?></td>
                                        <td><?php echo $agt->NAME; ?></td>
                                        <td><?php echo $agt->INISIAL_ANTREAN . $agt->NO_ANTREAN; ?></td>
                                        <td><?php echo date('H:i:s', strtotime($agt->START_DATE)); ?></td>
                                        <td><?php echo date('H:i:s', strtotime($agt->END_DATE)); ?></td>
                                        <td><?php echo (strtotime($agt->START_DATE)  - strtotime($agt->END_DATE)) ?></td>
                                        <td><?php echo $agt->SEND_TO_JKN; ?></td>
										<td><?php echo $agt->RESPONSE_MESSAGE; ?></td>
                                    </tr>
                        <?php endforeach;
                            }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Kodebooking</th>
                            <th>Task</th>
                            <th>No Antrean</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Selisih</th>
                            <th>Send To JKN</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>