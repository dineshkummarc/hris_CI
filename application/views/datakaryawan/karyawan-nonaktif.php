<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Daftar Karyawan Resign</h3>
                    <table id="tb_nonaktif" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Divisi</th>
                                <th>Tgl Bergabung</th>
                                <th>Tgl Resign</th>
                                <th>Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($nonaktif) : ?>
                                <?php $no = 1;
                                foreach ($nonaktif as $row) : ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row['TXT_NAMA'] ?></td>
                                        <td><?= $row['TXT_DIVISI'] ?></td>
                                        <td><?= $row['tgl_mulai_bekerja'] ?></td>
                                        <td><?= $row['DATE_TANGGAL_RESIGN'] ?></td>
                                        <td><?= $row['TXT_TELEPON'] ?></td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td class="text-center" colspan="6">Tidak ada data!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <?php if ($links) : ?>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="pagination">
                                            <?= $links ?>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script async>
    $(document).ready(function() {
        $("#tb_nonaktif").bootstrapTable({
            search:true
        });

    })
</script>