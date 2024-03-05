<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <table id="table"
                data-toggle="table"
                data-url="<?= base_url('monitoring/get_ipr') ?>" 
                >
                <thead>
                    <tr>
                        <th rowspan="2" data-field="no">No</th>
                        <th rowspan="2" data-field="nama">Nama Karyawan</th>
                        <th colspan="2">Penilai 1</th>
                        <th colspan="2">Penilai 2</th>
                        <th colspan="2">Penilai 3</th>
                        <th colspan="2">Penilai 4</th>
                        <th colspan="2">Penilai 5</th>
                        <th colspan="2">Periode</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>