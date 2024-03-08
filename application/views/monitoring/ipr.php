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
                <form action="" method="POST">
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="nama-karyawan">Nama Karyawan</label>
                            <select name="nama-karyawan" id="nama-karyawan" class="karyawan form-control">
                            </select>
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
    });
</script>