<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-6">
            <div class="profile-image">
                <img src="<?= base_url('uploads/images/') . $myprofile['TXT_PHOTO'] ?>" class="rounded-circle circle-border m-b-md" alt="profile" id="ubahPhoto">
            </div>
            <div class="profile-info">
                <div>
                    <div>
                        <h2 class="no-margins">
                            <?= $myprofile['TXT_NAMA'] ?>
                        </h2>
                        <!-- <small id="editNama">Ubah</small> -->
                        <h4>DIVISI: <?= $myprofile['TXT_DIVISI'] ?></h4>
                        <small>
                            Mulai Bekerja : <?= $myprofile['tgl_mulai_bekerja'] ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <table class="table small m-b-xs">
                <tbody>
                    <tr>
                        <td>
                            <strong><?= hitungProject($myprofile['user_id']) ?></strong> Projects
                        </td>
                        <td>
                            <strong><?= hitungKaizen($myprofile['user_id']) ?></strong> Improvement
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong><?= hitungReward($myprofile['TXT_NAMA']) ?></strong> Rewards
                        </td>
                        <td>
                            <strong><?= hitungPenalty($myprofile['TXT_NAMA']) ?></strong> Penalty
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <small><b>POIN</b></small>
            <h2 class="no-margins"><?= $myprofile['INT_POINT'] ?></h2>
            <div id="sparkline1"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>About <?= $myprofile['TXT_NAMA'] ?></h3>
                    <table class="table table-borderless" width="100%">
                        <tbody>
                            <tr>
                                <th>Tempat/ Tgl. Lahir</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_TEMPAT_LAHIR'] ?>/ <?= $myprofile['DATE_TANGGAL_LAHIR'] ?> </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_STATUS'] ?> </td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_AGAMA'] ?> </td>
                            </tr>
                            <tr>
                                <th>Divisi</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_DIVISI'] ?> </td>
                            </tr>
                            <tr>
                                <th>TELP</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_TELEPON'] ?> </td>
                            </tr>
                            <tr>
                                <th>E-MAIL</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_EMAIL'] ?> </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_ALAMAT'] ?> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="ibox-footer">
                    <button class="btn btn-danger btn-sm" id="editBasic" data-id="<?= $myprofile['user_id'] ?>"><i class="fa fa-edit"></i> Edit</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Data kerabat</h3>
                    <table class="table table-borderless" width="100%">
                        <tbody>
                            <tr>
                                <th>Istri/ Suami</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_NAMA_SUAMI_ISTRI'] ?></td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Istri/ Suami</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_PEKERJAAN_SUAMI_ISTRI'] ?></td>
                            </tr>
                            <tr>
                                <th>Tempat/ Tgl. lahir Istri/ Suami</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_TEMPAT_LAHIR_SUAMI_ISTRI'] ?> / <?= $myprofile['DATE_TANGGAL_LAHIR_SUAMI_ISTRI'] ?></td>
                            </tr>
                            <tr>
                                <th>Nama Kerabat</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_NAMA_KERABAT'] ?></td>
                            </tr>
                            <tr>
                                <th>Alamat/ Telp</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_ALAMAT_TELP_KRBT'] ?></td>
                            </tr>
                            <tr>
                                <th>Hubungan</th>
                                <td>:</td>
                                <td><?= $myprofile['TXT_HUBUNGAN_KRBT'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="ibox-footer">
                    <button class="btn btn-danger btn-sm" data-id="<?= $myprofile['user_id'] ?>"><i class="fa fa-edit"></i> Edit</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>List Project</h3>
                    <table id="tb_projects" data-show-toggle="true" data-toolbar-align="left" data-buttons-class="danger"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<script async>
    $(document).ready(function() {
        $("#ubahPhoto").click(() => {
            alert('ubah photo');
        });

        $("#editBasic").click(function() {
            const id = $(this).data('id');
            alert(id)
        });

        $table = $("#tb_projects")
        $table.bootstrapTable({
            url: "<?= base_url('dashboard/dataProject/') . $this->uri->segment(3) ?>",
            pagination: true,
            columns: [{
                field: 'judul',
                title: 'Project'
            }, {
                field: 'duedate',
                title: 'Due-date'
            }, {
                field: 'status',
                title: 'Status'
            }]
        })
    });
</script>