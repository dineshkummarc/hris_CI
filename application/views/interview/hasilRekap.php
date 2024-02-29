<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Tabel hasil rekap interview</h3>
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-condensed" id="tb_rhi" data-toggle="tb_rhi" data-show-toggle="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-show-search-clear-button="true" data-advanced-search="true" data-show-columns-toggle-all="true" data-show-pagination-switch="true" data-buttons-align="left" data-buttons-class="danger" data-id-table="advancedTable" data-detail-view="true" data-unique-id="id"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  -->
<script async>
    function ambilHasilInterview() {
        axios.get("<?= base_url('interview/datarhi') ?>")
            .then(function(response) {
                $table = $("#tb_rhi")
                $table.bootstrapTable('destroy').bootstrapTable({
                    data: response.data,
                    search: true,
                    pagination: true,
                    filterControl: true,
                    detailFormatter: detailFormatter,
                    columns: [{
                        field: 'tglinterview',
                        title: 'Tgl Interview',
                        valign: 'middle',
                        sortable: true
                    }, {
                        field: 'nama',
                        title: 'Nama Kandidat',
                        valign: 'middle',
                        sortable: true
                    }, {
                        field: 'posisi',
                        title: 'Posisi',
                        filterControl: 'select',
                        valign: 'middle',
                        sortable: true
                    }, {
                        field: 'usia',
                        title: 'Usia',
                        sortable: true,
                        valign: 'middle',
                        align: 'center'
                    }, {
                        field: 'pendidikan',
                        title: 'Pendidikan',
                        valign: 'middle',
                        sortable: true,
                    }, {
                        field: 'jurusan',
                        title: 'Jurusan',
                        valign: 'middle',
                        sortable: true
                    }, {
                        field: 'namaskolah',
                        title: 'Sekolah/ Kampus',
                        valign: 'middle',
                        sortable: true
                    }, {
                        field: 'hasil',
                        title: 'Rekomendasi',
                        sortable: true,
                        valign: 'middle',
                        filterControl: 'select'
                    }, {
                        field: 'id',
                        title: 'Act',
                        valign: 'middle',
                        align: 'center',
                        width: 900,
                        formatter: function(value) {
                            return [
                                '<div class="btn-group">' +
                                '<button class="btn btn-xs btn-warning update" data-id="' + value + '">Update</button> ' +
                                '<button class="btn btn-xs btn-danger delete" data-id="' + value + '">Delete</button>' +
                                '</div>'
                            ]
                        }
                    }]
                });

                function detailFormatter(index, row) {
                    var html = []
                    $.each(row, function(key, value) {
                        html.push('<p><b>' + key + ': </b> ' + value + '</p>')
                    })
                    return html.join('')
                }

                $('body').on('click', '#tb_rhi .delete', async function() {
                    const id = $(this).data("id");
                    const Url = "<?= base_url('interview/actInterview') ?>";
                    try {
                        const hapus = await Swal.fire({
                            title: 'Delete',
                            text: 'Hapus data pelamar ini?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Hapus',
                            cancelButtonText: 'Batal'
                        });
                        if (hapus.isConfirmed) {
                            const response = await fetch(Url, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json", // Ubah header Content-Type
                                },
                                body: JSON.stringify({
                                    id: id,
                                    action: 'delete'
                                })
                            });
                            if (!response.ok) {
                                throw new Error("HTTP error! status: " + response.status);
                            }
                            const resultText = await response.json();
                            // allert
                            if (resultText.status == "success") {
                                swalalertSuccess(resultText.message);
                            } else {
                                swalalertError(resultText.message);
                            }
                        }
                    } catch (error) {
                        Swal.fire({
                            title: 'Error',
                            text: error.message, // Ubah pesan error menjadi error.message
                            icon: 'error'
                        });
                        // console.error("ERROR : ", error);
                    }
                });

                $('body').on('click', '#tb_rhi .update', async function() {
                    const id = $(this).data("id");
                    const Url = "<?= base_url('interview/actInterview') ?>";
                    try {
                        const update = await Swal.fire({
                            title: 'Update Hasil Interview',
                            text: 'Silahkan pilih tombol dibawah untuk action update',
                            icon: 'question',
                            showCancelButton: true,
                            showDenyButton: true,
                            denyButtonText: 'Tolak',
                            confirmButtonText: 'Terima',
                            cancelButtonText: 'Pertimbangkan'
                        });
                        if (update.isConfirmed) {
                            const response = await fetch(Url, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json", // Ubah header Content-Type
                                },
                                body: JSON.stringify({
                                    id: id,
                                    action: 'terima'
                                })
                            });
                            if (!response.ok) {
                                throw new Error("HTTP error! status: " + response.status);
                            }
                            const resultText = await response.json();
                            // allert
                            if (resultText.status == "success") {
                                swalalertSuccess(resultText.message);
                            } else {
                                swalalertError(resultText.message);
                            }
                            // Lakukan sesuatu dengan resultText jika diperlukan
                        } else if (update.isDenied) {
                            // alert('denied'); Tolak
                            const response = await fetch(Url, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json", // Ubah header Content-Type
                                },
                                body: JSON.stringify({
                                    id: id,
                                    action: 'tolak'
                                })
                            });
                            if (!response.ok) {
                                throw new Error("HTTP error! status: " + response.status);
                            }
                            const resultText = await response.json();
                            // allert
                            if (resultText.status == "success") {
                                swalalertSuccess(resultText.message);
                            } else {
                                swalalertError(resultText.message);
                            }
                        } else if (update.dismiss === Swal.DismissReason.cancel) {
                            // alert('cancel');pertimbangkan
                            const response = await fetch(Url, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json", // Ubah header Content-Type
                                },
                                body: JSON.stringify({
                                    id: id,
                                    action: 'pertimbangkan'
                                })
                            });
                            if (!response.ok) {
                                throw new Error("HTTP error! status: " + response.status);
                            }
                            const resultText = await response.json();
                            // allert
                            if (resultText.status == "success") {
                                swalalertSuccess(resultText.message);
                            } else {
                                swalalertError(resultText.message);
                            }
                        }
                    } catch (error) {
                        Swal.fire({
                            title: 'Error',
                            text: error.message, // Ubah pesan error menjadi error.message
                            icon: 'error'
                        });
                        // console.error("ERROR : ", error);
                    }
                });

            })
            .catch(function(error) {
                console.error(error);
            });
    }
    $(document).ready(function() {
        ambilHasilInterview();
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