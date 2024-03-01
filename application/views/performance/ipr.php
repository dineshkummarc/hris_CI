<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>List form penilaian yg harus diisi apabila ada tombol nilai.</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered table-striped" id="tb_ipr" data-toggle="tb_rhi" data-show-toggle="true" data-mobile-responsive="true" data-check-on-init="true" data-show-search-clear-button="true" data-advanced-search="true" data-show-columns-toggle-all="true" data-show-columns="true" data-show-columns-toggle-all="true" data-detail-view="true" data-detail-formatter="detailFormatter" data-show-pagination-switch="true" data-buttons-align="left" data-buttons-class="danger" data-id-table="advancedTable" data-detail-view="true" data-unique-id="id"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<script async>
    function ambilDataIpr() {
        axios.get("<?= base_url('performance/ambilDataIpr') ?>")
            .then(function(response) {
                var res = response.data;
                $table = $("#tb_ipr")
                $table.bootstrapTable({
                    data: res,
                    search: true,
                    pagination: true,
                    detailFormatter: detailFormatter,
                    filterControl: true,
                    columns: [{
                        field: 'nama_pembuat',
                        title: 'Nama Pembuat',
                        sortable: true,
                        filterControl: 'select'
                    }, {
                        field: 'nama_karyawan',
                        title: 'Karyawan',
                        sortable: true,
                        filterControl: 'select'
                    }, {
                        field: 'penilai1',
                        title: 'Penilai 1',
                        sortable: true
                    }, {
                        field: 'penilai2',
                        title: 'Penilai 2',
                        sortable: true
                    }, {
                        field: 'penilai3',
                        title: 'Penilai 3',
                        sortable: true
                    }, {
                        field: 'penilai4',
                        title: 'Penilai 4',
                        sortable: true
                    }, {
                        field: 'penilai5',
                        title: 'Penilai 5',
                        sortable: true
                    }, {
                        field: 'status',
                        title: 'Status',
                        sortable: true
                    }, {
                        field: 'periods',
                        title: 'Periode',
                        sortable: true,
                        filterControl: 'select'
                    }, {
                        field: 'buttons',
                        title: 'Act'
                    }]
                });

                function detailFormatter(index, row) {
                    var html = []
                    $.each(row, function(key, value) {
                        html.push('<p><b>' + key + ': </b> ' + value + '</p>')
                    })
                    return html.join('')
                }
                $('body').on('click', '#tb_ipr .printPdf', function() {
                    const idForm = $(this).data('idform');
                    const namaKaryawan = $(this).data('name');

                    window.open("<?= base_url('performance/downloadIpr') ?>?id=" + idForm + "&nama=" + namaKaryawan, "_blank");
                });

            })
            .catch(function(error) {
                console.error(error);
            });
    }

    $(document).ready(function() {
        ambilDataIpr();
    });
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