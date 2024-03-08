<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <button class="btn btn-xs btn-flat btn-default create-form"><i class="fa fa-file"></i> Buat</button>
            <button class="btn btn-xs btn-flat btn-default set_penilai_btn"><i class="fa fa-address-card-o"></i> Penilai</button>
            <button class="btn btn-xs btn-flat btn-default set_periode"><i class="fa fa-clock-o"></i> Periode</button>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <?= $this->session->flashdata('message'); ?>
        <div class="col-lg-12 animated animate fadeIn" style="background-color:white; display:block" id="monitor">
            <table id="table" class="table table-striped table-striped-columns animated fadeInRightBig" data-pagination="true" data-toggle="table" data-url="<?= base_url('monitoring/get_ipr') ?>" data-search="true" data-filter-control="true" data-show-toggle="true" data-check-on-init="true" data-show-search-clear-button="true" data-advanced-search="true" data-id-table="advancedTable" data-show-columns-toggle-all="true" data-show-columns="true" data-show-columns-toggle-all="true" data-show-pagination-switch="true" data-buttons-class="danger">
                <thead class=" table-light">
                    <tr data-valign="midle">
                        <th rowspan="2" data-field="nama" data-filter-control="select">Nama Karyawan</th>
                        <th colspan="2">Penilai 1</th>
                        <th colspan="2">Penilai 2</th>
                        <th colspan="2">Penilai 3</th>
                        <th colspan="2">Penilai 4</th>
                        <th colspan="2">Penilai 5</th>
                        <th colspan="2">Periode</th>
                        <th rowspan="2" data-field="progress">Progress</th>
                    </tr>
                    <tr>
                        <th data-field="penilai1"></th>
                        <th data-field="cek1"></th>
                        <th data-field="penilai2"></th>
                        <th data-field="cek2"></th>
                        <th data-field="penilai3"></th>
                        <th data-field="cek3"></th>
                        <th data-field="penilai4"></th>
                        <th data-field="cek4"></th>
                        <th data-field="penilai5"></th>
                        <th data-field="cek5"></th>
                        <th data-field="pdari" data-filter-control="select"></th>
                        <th data-field="pakhir"></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-md-6 d-none animated fadeIn" id="form-penilai">
            <div class="ibox animated fadeInRightBig">
                <div class="ibox-title">
                    <h5>Pilih karyawan yang akan dinilai.</h5>
                    <p><small class="text-center mb-5">Memilih karyawan yg akan dilakukan penilaian & mengisikan periode penilaian.</small></p>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a id="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <form action="<?= base_url('monitoring/formPenilaian_save') ?>" method="POST">
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="nama-karyawan">Nama Karyawan</label>
                            <select name="nama-karyawan" id="nama-karyawan" class="karyawan form-control">
                                <option value="<?= set_value('nama-karyawan') ?>" <?php if (set_value('nama-karyawan') != NULL) : ?> selected <?php endif ?>><?= set_value('nama-karyawan') ?></option>
                            </select>
                            <?= form_error('nama-karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="penilai-1" class="font-normal">Penilai 1</label>
                            <input type="text" name="penilai-1" id="penilai-1" class="form-control" readonly>
                            <?= form_error('penilai-1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="penilai-2" class="font-normal">Penilai 2</label>
                            <input type="text" name="penilai-2" id="penilai-2" class="form-control" readonly>
                            <?= form_error('penilai-2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="penilai-3" class="font-normal">Penilai 3</label>
                            <input type="text" name="penilai-3" id="penilai-3" class="form-control" readonly>
                            <?= form_error('penilai-3', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="penilai-4" class="font-normal">Penilai 4</label>
                            <input type="text" name="penilai-4" id="penilai-4" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="penilai-5" class="font-normal">Penilai 5</label>
                            <input type="text" value='' name="penilai-5" id="penilai-5" class="form-control" readonly>
                        </div>
                        <div class="form-group" id="data_1">
                            <label for="periode_select" class="font-normal">Periode </label>
                            <select id="periode_select" name="periode_select" data-placeholder="Pilih periode" class="chosen-select from-control" tabindex="2" required>
                                <option value="">Pilih</option>
                                <?php foreach ($periode->result() as $row) : ?>
                                    <option value="<?= $row->INT_ID ?>"><?= $row->TXT_JENIS ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('periode_select', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="font-normal"> Dari </label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="dari" name="dari" type="text" class="form-control" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group" id="data_2">
                            <label class="font-normal"> Sampai </label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="sampai" type="text" name="sampai" class="form-control" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-footer">
                        <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script async>
    $(document).ready(function() {
        const viewTable = $("#monitor");
        const viewFormPenilai = $("#form-penilai");

        $(".create-form").on('click', function() {
            viewTable.addClass("d-none");
            viewFormPenilai.removeClass("d-none");
        });

        $("#close-link").on('click', function() {
            viewTable.removeClass("d-none");
            viewFormPenilai.addClass("d-none");
        });

        $(".karyawan").select2({
            allowClear: true,
            width: '100%',
            placeholder: "--Silahkan Nama Karyawan --",
            width: 'resolve',
            ajax: {
                url: "<?= base_url('monitoring/dataKar') ?>",
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        cariNamaDevisi: params.term // search term
                    };
                },
                processResults: function(response) {
                    // console.log(response);
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $('.chosen-select').chosen({
            width: "100%"
        });

        $("#nama-karyawan").on('change', async function() {
            const namaKaryawan = $(this).val();
            try {
                const Url = "<?= base_url('monitoring/cekPenilai') ?>";
                const response = await fetch(Url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json", // Ubah header Content-Type
                    },
                    body: JSON.stringify({
                        namaKar: namaKaryawan
                    })
                })
                if (!response.ok) {
                    throw new Error("HTTP error! status: " + response.status);
                }
                const resultText = await response.json();
                if (resultText.status != 'error') {
                    var res = resultText[0];
                    $("#penilai-1").val(res.penilai1);
                    $("#penilai-2").val(res.penilai2);
                    $("#penilai-3").val(res.penilai3);
                    $("#penilai-4").val(res.penilai4);
                    $("#penilai-5").val(res.penilai5);
                }
            } catch (error) {
                Swal.fire({
                    title: 'Error',
                    text: error,
                    icon: 'error'
                });
            }
        });

        $("#periode_select").on('change', function() {
            const id = $(this).val();
            const dataSend = {
                id: id
            };

            axios.post("<?= base_url('monitoring/cekPeriode') ?>", dataSend)
                .then(function(response) {
                    var result = response.data[0];
                    $("#dari").val(result.awal);
                    $("#sampai").val(result.akhir);
                })
                .catch(function(error) {
                    console.error(error);
                });
        });
    });
</script>