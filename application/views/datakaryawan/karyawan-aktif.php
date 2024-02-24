<style>
    @keyframes blinking {
        0% {
            background-color: transparent;
            /* border: 5px solid #871924; */
        }

        /* YOU CAN ADD MORE COLORS IN THE KEYFRAMES IF YOU WANT */
        30% {
            background-color: #ff6600;
            /* border: 5px solid #126620; */
        }

        100% {
            background-color: red;
            /* border: 5px solid #6565f2; */
        }
    }

    #bahaya {
        color: white;
        width: 40px;
        height: 20px;
        display: float;
        /* NAME | TIME | ITERATION */
        animation: blinking 1s infinite;
    }

    #lewat {
        background-color: #FF0000;
        color: white;
        width: 40px;
        height: 20px;
        display: float;
        /* NAME | TIME | ITERATION */
        /* animation: blinking 1s infinite; */
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <?= form_error('nama-tambah', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('username', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('id-karyawan-tambah', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('username', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('telepon-tambah', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('accl', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('agama-tambah', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('divisi-tambah', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('status-tambah', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('tglmasuk', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <?= form_error('email-tambah', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>
            <div class="ibox animate animated bounceIn">
                <div class="ibox-title">
                    <h5>List karyawan Mr. Kitchen - Aktif</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="toolbar">
                        <?php if ($rar['create'] == '1') : ?>
                            <button class="btn btn-secondary tambah"><i class="fa fa-plus"></i> Data Karyawan</button>
                        <?php endif; ?>
                    </div>
                    <table id="tb_karyawan" data-toggle="tb_karyawan" data-show-refresh="true" data-show-columns="true" data-show-toggle="true" data-show-pagination-switch="true" data-toolbar-align="left" data-advanced-search="true" data-buttons-class="danger"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- form tambah karyawan -->
<div class="modal inmodal" id="tambah_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-database modal-icon"></i>
                <h4 class="modal-title">Form tambah karyawan</h4>
                <small class="font-bold">Isi field dengan lengkap, pastikan data yang diinput adalah data yang sebenarnya.<br />(<sup style="color:red">*</sup>) <b>WAJIB DIISI !</b></small>
            </div>
            <form class="form-horizontal" id="submit" enctype="multipart/form-data" method="post" action="<?= base_url('datakaryawan/aktif') ?>">
                <div class="modal-body">
                    <!-- <sup style="color:red">*</sup><b>WAJIB DIISI !</b> -->
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama<sup style="color:red">*</sup></label>
                        <div class="col-sm-10"><input type="text" name="nama-tambah" id="nama-tambah" class="form-control" value="<?= set_value('nama-tambah') ?>"></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Username<sup style="color:red">*</sup></label>
                        <div class="col-sm-10"><input type="text" name="username" id="username" class="form-control" value="" placeholder="Masukkan nama depan anda"></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">No Absensi<sup style="color:red">*</sup></label>
                        <div class="col-sm-10"><input type="text" name="id-karyawan-tambah" class="form-control" value="<?= set_value('id-karyawan-tambah') ?>"></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">No Telepon<sup style="color:red">*</sup></label>
                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">+62</span>
                                </div>
                                <input type="text" name="telepon-tambah" placeholder="" class="form-control" value="<?= set_value('telepon-tambah') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role<sup style="color:red">*</sup></label>
                        <div class="col-sm-10">
                            <select name="role" id="role" class="form-control">
                                <option value="">~ Pilih ~</option>
                                <?php foreach ($role->result() as $row) : ?>
                                    <option value="<?= $row->role_id ?>"><?= $row->role ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="accl" class="col-sm-2 col-form-label">Access level<sup style="color:red">*</sup></label>
                        <div class="col-sm-10">
                            <select name="accl" id="accl" class="form-control">
                                <option value="">~ Pilih ~</option>
                                <?php foreach ($trar->result() as $row) : ?>
                                    <option value="<?= $row->id ?>"><?= $row->rar_name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small><sup>Access to create, read, upadate, delete data</sup></small>
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Divisi<sup style="color:red">*</sup></label>
                        <div class="col-sm-10">
                            <select name="divisi-tambah" data-placeholder="Pilih Karyawan ..." class="chosen-select form-control" tabindex="2">
                                <option value="">~ Pilih ~</option>
                                <?php foreach ($divisi->result() as $row) : ?>
                                    <option value="<?= $row->nama_divisi ?>"><?= $row->nama_divisi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglmasuk" class="col-sm-3 col-form-label">Tanggal Masuk Kerja<sup style="color:red">*</sup></label>
                        <div class="col-sm-9">
                            <input type="date" name="tglmasuk" id="tglmasuk" class="form-control">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Status<sup style="color:red">*</sup></label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status-tambah">
                                <option value="">~ Pilih Status ~</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Duda/Janda">Duda/ Janda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label">alamat<sup style="color:red">*</sup></label>
                        <div class="col-sm-10">
                            <textarea name="alamat-tambah" class="form-control" value=""></textarea>
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Tempat Lahir<sup style="color:red">*</sup></label>
                        <div class="col-sm-10"><input type="text" name="tempat-lahir-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Hobby</label>
                        <div class="col-sm-10"><input type="text" name="hobby-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Agama<sup style="color:red">*</sup></label>
                        <div class="col-sm-10">
                            <select name="agama-tambah" class="form-control">
                                <option value="">~ Pilih Agama ~</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label">Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kelamin-tambah">
                                <option value="">~ Pilih Jenis Kelamin ~</option>
                                <option value="Laki - Laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Kebangsaan</label>
                        <div class="col-sm-10"><input type="text" name="kebangsaan-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row">
                        <label class="col-sm-2 col-form-label" for="tanggal-lahir-tambah">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal-lahir-tambah" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Kerabat</label>
                        <div class="col-sm-10"><input type="text" name="kerabat-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Hubungan Kerabat</label>
                        <div class="col-sm-10"><input type="text" name="hubungan-kerabat-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Alamat & telepon Kerabat</label>
                        <div class="col-sm-10"><input type="text" name="alamat-telp-kerabat-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Suami / Istri</label>
                        <div class="col-sm-10"><input type="text" name="nama-suami-istri-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Tempat Lahir Suami / Istri</label>
                        <div class="col-sm-10"><input type="text" name="tempat-lahir-suami-istri-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Tanggal Lahir Suami / Istri</label>
                        <div class="col-sm-10"><input type="date" name="date-tanggal-lahir-suami-istri-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Pekerjaan Suami Istri</label>
                        <div class="col-sm-10"><input type="text" name="pekerjaan-suami-istri-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Alamat Pekerjaan Suami / Istri</label>
                        <div class="col-sm-10"><input type="text" name="alamat-pekerjaan-suami-istri-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Telepon Suami / Istri</label>
                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">+62</span>
                                </div>
                                <input type="text" name="telepon-suami-istri-tambah" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 1</label>
                        <div class="col-sm-10"><input type="text" name="anak-1-tambah" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 2</label>
                        <div class="col-sm-10"><input type="text" name="anak-2-tambah" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 3</label>
                        <div class="col-sm-10"><input type="text" name="anak-3-tambah" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 4</label>
                        <div class="col-sm-10"><input type="text" name="anak-4-tambah" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 5</label>
                        <div class="col-sm-10"><input type="text" name="anak-5-tambah" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Email<sup style="color:red">*</sup></label>
                        <div class="col-sm-10"><input type="email" name="email-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10"><input type="text" name="nik-tambah" class="form-control" value=""></div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">NPWP</label>
                        <div class="col-sm-10"><input type="text" name="npwp-tambah" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Photo<br></label>
                        <div class="custom-file col-sm-10">
                            <input type="file" name="photo-tambah" id="photo-tambah" placeholder="Tolong masukkan foto anda dengan format png" class="custom-file-input">
                            <label for="photo-tambah" class="custom-file-label">Choose file...</label>
                            <small>format gambar wajib .jpg/ .jpeg/ .JPG/ .png</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary simpan-tambah">Simpan Data</button>
            </form>
        </div>
        </form>
    </div>
</div>
</div>

<!-- modal detail -->
<div class="modal inmodal" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-body" id="detailModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- modaleditform -->
<div class="modal inmodal" id="formDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-database modal-icon"></i>
                <h4 class="modal-title">Form edit karyawan</h4>
                <small class="font-bold">Isi field dengan lengkap, pastikan data yang diinput adalah data yang sebenarnya.</small>
            </div>
            <form action="<?= base_url('datakaryawan/editKaryawan') ?>">
                <div class="modal-body" id="detailForm">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function ambilDataKaryawanAktif() {
        axios.get("<?= base_url('datakaryawan/ambilAktif') ?>")
            .then(function(response) {
                $table = $("#tb_karyawan");
                $table.bootstrapTable({
                    data: response.data,
                    striped: true,
                    search: true,
                    pagination: true,
                    toolbar: '#toolbar',
                    filterControl: true,
                    columns: [{
                        field: 'nama',
                        title: 'Nama Karyawan',
                        filterControl: 'input',
                        sortable: true
                    }, {
                        field: 'divisi',
                        title: 'Divisi',
                        align: 'center',
                        filterControl: 'select',
                        sortable: true
                    }, {
                        field: 'tlp',
                        title: 'No. Telp'
                    }, {
                        field: 'email',
                        title: 'E-mail'
                    }, {
                        field: 'statusKontrak',
                        title: 'Status Kontrak',
                        align: 'center',
                        filterControl: 'select',
                        sortable: true
                    }, {
                        field: 'act',
                        title: 'Act.',
                        align: 'center',
                        width: 150,
                        formatter: function(value) {
                            return [
                                '<button class="btn btn-xs btn-warning view" data-toggle="modal" data-id="' + value + '"><i class="fa fa-eye"></i></button> ' +
                                '<?php if ($rar['update'] == '1') : ?><button class="btn btn-xs btn-info  edit" data-toggle="modal" data-id="' + value + '"><i class="fa fa-edit"></i></button> <?php endif; ?>' +
                                '<?php if ($rar['delete'] == '1') : ?><button class = "btn btn-xs btn-danger  hapus" data-id = "' + value + '" > <i class = "fa fa-trash" > </i></button ><?php endif; ?>'
                            ]
                        }
                    }]
                });

                $("body").on('click', '#tb_karyawan .view', function() {
                    const id = $(this).data('id');
                    fetch("<?= base_url('datakaryawan/detailKaryawan') ?>", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'id=' + id
                        })
                        .then(function(response) {
                            return response.text();
                            // console.log(response);
                        })
                        .then(function(data) {
                            $('#modalDetail').modal('show');
                            $('#detailModal').html(data);
                            console.log(data);
                        })
                        .catch(function(error) {
                            console.log('Error:', error);
                        });
                });

                $('body').on('click', '#tb_karyawan .hapus', function() {
                    const id = $(this).data('id');
                    const urlHapus = "<?= base_url('datakaryawan/nonaktifkanKaryawan') ?>";
                    Swal.fire({
                        title: "Nonaktifkan",
                        text: 'Silahkan input tgl resign terlebih dahulu',
                        icon: 'question',
                        input: "date",
                        inputAttributes: {
                            autocapitalize: "off"
                        },
                        showCancelButton: true,
                        confirmButtonText: "Nonaktifkan Karyawan",
                        showLoaderOnConfirm: true,
                        preConfirm: async (hapus) => {
                            try {
                                const url = urlHapus; // Ganti URL_ANDA dengan URL yang sesuai
                                const response = await fetch(url, {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json", // Ubah header Content-Type
                                    },
                                    body: JSON.stringify({
                                        id: id,
                                        tgl_resign: hapus
                                    }) // Ubah payload menjadi JSON string
                                });
                                if (!response.ok) {
                                    throw new Error("HTTP error! status: " + response.status);
                                }
                                const resultText = await response.json();
                                // console.log(resultText);
                                if (resultText.status === 'error') {
                                    swal.fire({
                                        title: 'Error',
                                        text: resultText.message,
                                        icon: 'error',
                                        showCancelButton: false,
                                        allowOutsideClick: false
                                    }).then((resulte) => {
                                        if (resulte.isConfirmed) {
                                            window.location.reload();
                                        }
                                    })
                                } else if (resultText.status === 'success') {
                                    swal.fire({
                                        title: 'Success',
                                        text: resultText.message,
                                        icon: 'success',
                                        showCancelButton: false,
                                        allowOutsideClick: false
                                    }).then((resulte) => {
                                        if (resulte.isConfirmed) {
                                            window.location.reload();
                                        }
                                    })
                                }
                            } catch (error) {
                                Swal.fire({
                                    title: 'Error',
                                    text: error,
                                    icon: 'error'
                                })
                                // console.error("ERROR : ", error);
                            }
                        }
                    });
                });

                $('body').on('click', '#tb_karyawan .edit', function() {
                    const id = $(this).data('id');
                    fetch("<?= base_url('datakaryawan/editKaryawan') ?>", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'id=' + id
                        })
                        .then(function(response) {
                            return response.text();
                            // console.log(response);
                        })
                        .then(function(data) {
                            $('#formDetail').modal('show');
                            $('#detailForm').html(data);
                            // console.log(data);
                        })
                        .catch(function(error) {
                            console.log('Error:', error);
                        });
                });

            })
            .catch(function(error) {
                console.error(error);
            });
    }
    $(document).ready(function() {
        ambilDataKaryawanAktif();
        // action button 
        $(".tambah").on('click', function() {
            $('#tambah_modal').modal("show");
        });

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            let extension = fileName.split(".")[1];

            var x = document.getElementById("photo-tambah");
            var ukuran = parseFloat(x.files[0].size / 1024).toFixed(2);

            if (extension == "jpg" || extension == "JPG" || extension == "jpeg" || extension == "png") {
                if (ukuran >= 5120) {
                    swal.fire({
                        title: "File Maks 5120",
                        text: 'Ukuran gambar terlalu besar, ukuran gambar anda ' + ukuran + 'KB',
                        icon: 'error',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#20B2AA'
                    });
                } else {
                    $(this).next('.custom-file-label').addClass("selected").html(fileName);
                }
            } else {
                $('#tambah_modal').modal("hide");
                swal.fire({
                    title: 'Format gambar salah',
                    text: 'File harus .png/.jpg/.jpeg',
                    icon: 'error',
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonColor: '#20B2AA'
                }).then((hsl) => {
                    if (hsl.dismiss === Swal.DismissReason.cancel) {
                        $('#tambah_modal').modal("show");
                    }
                });
                $(this).next('.custom-file-label').removeClass("selected").html("");
            }
        });

        $("#nama-tambah").change(() => {
            const nama = $("#nama-tambah").val();
            const uname = nama.split(' ')[0];

            document.getElementById('username').value = uname;
        })
    })
    var icons = {
        paginationSwitchDown: 'fa fa-angle-double-down',
        paginationSwitchUp: 'fa fa-angle-double-up',
        refresh: 'fa fa-refresh'
    }

    icons.paginationSwitchDown += ' fw-bold icon-size-lg';
    icons.refresh += ' fw-bold icon-size-lg';

    var tabels = document.querySelector('table');
    if (tabels) {
        tabels.setAttribute('data-icons', 'icons');
    }
</script>