<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> Alokasi No. Rekam Medik</h3>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-angle-left fa-sm text-white-50"></i> Back</a>
    </div>
    <hr>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="card mb-1">
        <div class="card-body">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#useredit"><i class="fa fa-plus"></i> New RM</button>
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
                            <th>Nama</th>
                            <th>E-Mail</th>
                            <th>Role</th>
                            <th>Active</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $priv = '';
                        $list = json_decode($userdata);
                        if ($list->response != null) {
                            foreach ($list->response as $user) :
                                if ($user->role == 0) {
                                    $priv = 'Administrator';
                                } elseif ($user->role == 1) {
                                    $priv = 'Anggota';
                                } elseif ($user->role == 2) {
                                    $priv = 'Bendahara';
                                } elseif ($user->role == 3) {
                                    $priv = 'Pengurus';
                                } elseif ($user->role == 4) {
                                    $priv = 'Ketua';
                                }
                        ?>

                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $user->nama; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $priv; ?></td>
                                    <td><?php echo $user->activated; ?></td>
                                    <td class="text-center" )><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#useredit" data-id="<?= $user->id; ?>"><i class="fa fa-edit"></i> </button></td>
                                    <td class="text-center" onclick="javascript : return confirm('Anda yakin menghapus data ini ?')"> <?php echo anchor('admin/users/delUser/' . $user->id, '<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>') ?></td>
                                </tr>
                        <?php endforeach;
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>E-Mail</th>
                            <th>Role</th>
                            <th>Activate</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="useredit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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