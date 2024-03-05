<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12" style="background-color:white; display:block">
            <div id="toolbar">
                <button class="btn btn-flat btn-danger create-form"><i class="fa fa-file"></i> Buat</button>
                <button class="btn btn-flat btn-danger set_penilai_btn"><i class="fa fa-address-card-o"></i> Penilai</button>
                <button class="btn btn-flat btn-danger set_periode"><i class="fa fa-clock-o"></i> Periode</button>
            </div>
            <table id="table" class="table table-striped table-striped-columns" data-toolbar="#toolbar" data-pagination="true" data-toggle="table" data-url="<?= base_url('monitoring/get_ipr') ?>" data-search="true" data-filter-control="true" data-show-toggle="true" data-check-on-init="true" data-show-search-clear-button="true" data-advanced-search="true" data-id-table="advancedTable" data-show-columns-toggle-all="true" data-show-columns="true" data-show-columns-toggle-all="true" data-show-pagination-switch="true" data-buttons-class="danger">
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
    </div>
</div>