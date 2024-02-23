<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>List Divisi</h3>
                    <?= $this->session->flashdata('message'); ?>
                    <?php if ($rar['create'] == '1') : ?>
                        <button class="float-right btn btn-sm btn-danger mb-2" id="addNew">Tambah Divisi</button>
                    <?php endif; ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Devisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($devisi as $row) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row['nama_divisi'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-primary btnSee" data-id="<?= $row['id'] ?>" id="btnSee"><i class="fa fa-eye"></i></button>
                                        <?php if ($rar['update'] == '1') : ?>
                                        <button class="btn btn-xs btn-success btnEdit" data-id="<?= $row['id'] ?>" id="btnEdit"><i class="fa fa-edit"></i></button>
                                        <?php endif; ?>
                                        <?php if ($rar['delete'] == '1') : ?>
                                        <button class="btn btn-xs btn-danger btnDelete" data-id="<?= $row['id'] ?>" id="btnDelete"><i class="fa fa-trash"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <div class="pagination">
                                        <?= $links ?>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal window -->
<div class="modal inmodal" id="formNew" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-laptop modal-icon"></i>
                <h4 class="modal-title">From tambah divisi</h4>
                <small class="font-bold">Isi semua field dengan benar</small>
            </div>
            <form action="<?= base_url('datakaryawan/divisi') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namadevisi">Nama Divisi</label>
                        <input type="text" class="form-control" name="namadevisi" id="namadevisi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script async>
    $(document).ready(function() {
        function alerts(act, mess) {
            swal.fire({
                title: act,
                text: mess,
                showConfirmButton: false,
                showCancelButton: true
            }).then((Rest) => {
                if (Rest.dismiss === Swal.DismissReason.cancel) {
                    window.location.reload();
                }
            })
        }
        $(".btnSee").click(function() {
            const id = $(this).data('id');
            alert(id)
        })
        $(".btnEdit").click(function() {
            const id = $(this).data('id');
            alert(id)
        })
        $(".btnDelete").click(function() {
            const id = $(this).data('id');
            // alert(id)
            swal.fire({
                title: 'Hapus Data',
                text: 'Yakin hapus divisi ini ?',
                showCancelButton: true
            }).then((rest) => {
                if (rest.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('datakaryawan/actionDivisi') ?>",
                        method: 'POST',
                        data: {
                            id: id,
                            action: 'delete'
                        },
                        success: function(data) {
                            // console.log(data);
                            alerts(data.title, data.message);
                        }
                    })
                }
            })

        });
        $("#addNew").click(function() {
            $("#formNew").modal('show')
        })
    });
</script>