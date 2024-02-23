<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<?php
$keys = "G@ruda7577";
$myToken = encrypt_data($user['user_id'], $keys);
$url = base_url('kaizen/mykaizen/') . $myToken;

date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d');
// $date = '2023-06-06';
$tgl = explode('-', $date); //explode untuk pemisah kata,  variable $date dengan batas - ke array
$bln = $tgl[1]; //mengambil array $tgl[1] yang isinya 03
$thn = $tgl[0]; //mengambil array $tgl[0] yang isinya 2015
$ref_date = strtotime("$date"); //strtotime ini mengubah varchar menjadi format time
$week_of_year = date('W', $ref_date); //mengetahui minggu ke berapa dari tahun
$week_of_month = $week_of_year - date('W', strtotime("$bln/1/$thn")); //mengetahui minggu ke berapa dari bulan  

// test penambahan minggu ke alif
$weekNumber = ceil(date('j', strtotime($date)) / 7);
$test = min(5, $weekNumber);
// var_dump($test);
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <?= $this->session->flashdata('message'); ?>
                    <div id="toolbar">
                        <button class="btn btn-secondary newKaizen" id="newKaizen" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Improvement</button>
                    </div>
                    <table id="tb_kaizen" class="table table-bordered"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal window -->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-laptop modal-icon"></i>
                <h4 class="modal-title">Form new improvement</h4>
                <small class="font-bold">Silahkan input data improvement anda, pastikan form terisi dengan benar dan lengkap</small>
            </div>
            <form method="POST" action="<?= base_url('kaizen') ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title') ?>">
                                <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">PIC</label>
                                <input type="text" name="pic" id="pic" class="form-control" value="<?= $user['TXT_NAMA'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="onweek">Minggu Ke</label>
                                <input type="number" name="onweek" id="onweek" class="form-control" value="<?= $test ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="duedate">Due-date</label>
                                <input type="date" name="duedate" id="duedate" class="form-control" require>
                                <?= form_error('duedate', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <hr style="background-color: red">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="beforImp">Kondisi sebelum improvement</label>
                                <textarea name="beforeImp" id="beforeImp" cols="15" rows="5" class="form-control beforeImp" placeholder="isi kondisi kebelum improvement . . ." require></textarea>
                            </div>
                        </div>
                        <div class="col sm-12">
                            <div class="form-group">
                                <label for="usul">Usul</label>
                                <textarea name="usul" id="usul" cols="15" rows="5" class="form-control usul" placeholder="isi bagian usul disini . . ." require></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Kondisi setelah improvement</label>
                                <textarea name="afterImp" id="afterImp" cols="15" rows="5" class="form-control afterImp" require></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="inputby" id="inputby" value="<?= $user['user_id'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal inmodal" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail Improvement</h4>
            </div>
            <div class="modal-body" id="detailModal">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- exit modal -->
<script>
    $(document).ready(function() {
        <?php if (validation_errors()) { ?>
            $('#myModal').modal('show');
        <?php } ?>
    });
</script>
<script async>
    function ambilKaizenku() {
        axios.get("<?= $url ?>")
            .then(function(response) {
                const data = response.data;
                $table = $("#tb_kaizen")
                $table.bootstrapTable({
                    data: data,
                    pagination: true,
                    search: true,
                    toolbar: '#toolbar',
                    filterControl: true,
                    columns: [{
                        field: 'no',
                        title: '#'
                    }, {
                        field: 'judul',
                        title: 'Judul Improvement',
                        sortable: 'true',
                        filterControl: 'input'
                    }, {
                        field: 'onmonth',
                        title: 'On Year/Month',
                        sortable: true,
                        filterControl: 'select'
                    }, {
                        field: 'onweek',
                        title: 'On Week',
                        sortable: true,
                        align: 'center'
                    }, {
                        field: 'duedate',
                        title: 'Due-date',
                        sortable: true,
                        filterControl: 'input'
                    }, {
                        field: 'inputdate',
                        title: 'Tanggal Input',
                        sortable: true
                    }, {
                        field: 'id',
                        title: 'Act.',
                        align: 'center',
                        formatter: function(value) {
                            return [
                                '<button class="btn btn-xs btn-success seeData" data-id="' + value + '"><i class="fa fa-eye"></i> Lihat</button>'
                            ]
                        }
                    }]
                });

                $("body").on('click', '#tb_kaizen .seeData', function() {
                    const id = $(this).data('id');
                    const formData = new FormData();
                    formData.append('id', id);
                    // alert(id)
                    fetch("<?= base_url('kaizen/detailKaizen') ?>", {
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
                            // console.log(data);
                        })
                        .catch(function(error) {
                            console.log('Error:', error);
                        });

                })
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    $(document).ready(function() {
        ambilKaizenku();

        $(".usul").summernote({
            height: 100,
            placeholder: 'Isi usul anda disini',
            tabsize: 2,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']]
            ]
        });

        $("#beforeImp").summernote({
            height: 100,
            placeholder: 'Isi kondisi sebelum improvement disini',
            tabsize: 2,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']]
            ]
        });

        $("#afterImp").summernote({
            height: 100,
            placeholder: 'Isi kondisi setelah improvement disini',
            tabsize: 2,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']]
            ]
        });
    })
</script>