<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h3 class="h5 mb-0 text-gray-900"><i class="fa fa-list"></i> Rencana Kontrol</h3>
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
                            <th>No.Kartu</th>
                            <th>Nama Pasien</th>
                            <th>Poli Tujuan</th>
                            <th>Hari</th>
                            <th>Nama Dokter</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = json_decode($list);
                        //var_dump($list);
                        if ($data->metadata->code == 200) {
                            if ($data->response != null) {
                                $no = 1;
                                foreach ($data->response as $agt) : ?>
                                    <?php
                                    $nohp = substr_replace($agt->TELP, '62', 0, 1);
                                    $body = "Yth. Ibu/bpk " . $agt->NAMA;
                                    $body .= "%0AHallo, Salam Metta";
                                    $body .= "%0AIngin menginformasikan jadwal kontrol sudah dekat tanggal :" . $agt->TGL_RENCANA_KONTROL;
                                    $body .= "%0AHallo, Salam Metta";
                                    $body .= "%0ADitunggu kedatangannya...";
                                    $body .= "%0ATerimakasih";
                                    $body .= "%0ASalam sehat selalu";
                                    ?>
                                    <tr class="text-truncate text-sm">
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $agt->NO_KARTU; ?></td>
                                        <td><?php echo $agt->NAMA; ?></td>
                                        <td><?php echo $agt->NAMA_POLI_TUJUAN; ?></td>
                                        <td><?php echo $agt->TGL_RENCANA_KONTROL; ?></td>
                                        <td><?php echo $agt->NAMA_DOKTER; ?></td>
                                        <td>
                                            <form action="<?php echo base_url('appointment/sendAlertKontrol') ?>" method="POST">
                                                <input type="text" hidden name="nohp" value="<?php echo $nohp; ?>">
                                                <input type="text" hidden name="pesan" value="<?php echo $body; ?>">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-comments"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                        <?php endforeach;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>