<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> Alokasi No. Rekam Medik</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
    </div>
    <hr>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="card mb-1">
        <div class="card-body">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#new"><i class="fa fa-plus"></i> New RM</button>
            <a href="#" class="btn btn-sm btn-secondary" onclick="printLayer('printlayout')"><i class="fa fa-print"></i> Cetak</a>
        </div>
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
                            <th>No. RM</th>
                            <th>Tanggal Create</th>
                            <th>Tanggal Update</th>
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
                                        <td><?php echo date('d-m-Y H:i:s', $agt->createdate); ?></td>
                                        <td><?php echo date('d-m-Y H:i:s', $agt->lastupdate); ?></td>
                                        <td class="text-center" onclick="javascript : return confirm('Anda yakin menghapus data ini ?')"> <?php echo anchor('medicalrecords/delete/' . $agt->norm, '<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>') ?></td>
                                    </tr>
                        <?php endforeach;
                            }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No. RM</th>
                            <th>Tanggal Create</th>
                            <th>Tanggal Update</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">FORM INPUT ALOKASI REKAM MEDIK</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php echo form_open_multipart('medicalrecords/insert'); ?>
                        <div class="row">
                            <div class="form-group col-sm">
                                <input type="number" name="rm" class="form-control" placeholder="No.RM">
                            </div>
                        </div>

                        <button type="Reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
                        <button type="Submit" class="btn btn-primary">Save changes</button>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>