<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12 animate animated bounceInRight">
            <div class="ibox">
                <form action="<?= base_url('interview/add'); ?>" method="post">
                    <div class="ibox-content">
                        <!-- <p>Paulus</p> -->
                        <h3>Form tambah hasil interview</h3>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal interview</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= set_value('tanggal') ?>">
                                <input type="hidden" name="uid" id="uid" class="form-control" value="<?= $user['user_id'] ?>">
                                <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Pelamar</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama pelamar" value="<?= set_value('nama') ?>">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Posisi</label>
                            <div class="col-sm-6">
                                <input type="text" name="posisi" id="posisi" class="form-control" placeholder="Posisi yang dilamat" value="<?= set_value('posisi')  ?>">
                                <?= form_error('posisi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Usia</label>
                            <div class="col-sm-2">
                                <input type="number" name="usia" value="<?= set_value('usia') ?>" id="usia" class="form-control" placeholder="usia">
                                <?= form_error('usia', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                            <div class="col-sm-3">
                                <select name="pendidikan" id="pendidikan" class="form-control">
                                    <option value="">~ Pilih ~</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="SMK">SMK</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">D-IV/ S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                </select>
                                <?= form_error('pendidikan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" placeholder="fakultas" name="fakultas" id="fakultas" class="form-control" value="<?= set_value('fakultas') ?>">
                                <?= form_error('fakultas', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" placeholder="jurusan" name="jurusan" id="jurusan" class="form-control" value="<?= set_value('jurusan') ?>">
                                <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Sekolah</label>
                            <div class="col-sm-9">
                                <input type="text" name="sekolah" id="sekolah" class="form-control" value="<?= set_value('sekolah') ?>">
                                <?= form_error('sekolah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pengalaman Kerja <?= $i ?></label>
                                <div class="col-sm-3">
                                    <input type="number" placeholder="berapa tahun" name="tahun_pengalaman_<?= $i ?>" id="tahun_pengalaman__<?= $i ?>" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" placeholder="posisi" name="jabatan_pengalaman_<?= $i ?>" id="jabatan_pengalaman_<?= $i ?>" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" placeholder="perusahaan / bidang" name="perusahaan_pengalaman_<?= $i ?>" id="perusahaan_pengalaman_<?= $i ?>" class="form-control">
                                </div>
                            </div>
                        <?php endfor; ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kelebihan</label>
                            <div class="col-sm-10">
                                <input type="text" name="kelebihan" id="kelebihan" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kekurangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="kekurangan" id="kekurangan" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vaksin</label>
                            <div class="col-sm-3">
                                <select name="jenis_vaksin" id="" class="form-control">
                                    <option value="belum vaksin">Belum Vaksin</option>
                                    <option value="Ke 1">ke 1</option>
                                    <option value="Ke 2">ke 2</option>
                                    <option value="Booster">booster</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" placeholder="nama vaksin" name="nama_vaksin" id="nama_vaksin" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Permohonan Salary</label>
                            <div class="col-sm-10">
                                <input type="number"  name="salary" id="salary" class="form-control" placeholder="Masukkan angka saja">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Rekomendasi HRD</label>
                            <div class="col-sm-10">
                                <select name="rekomendasi" id="rekomendasi" class="form-control">
                                    <option value="1">terima</option>
                                    <option value="2">dipertimbangkan</option>
                                    <option value="0">tolak</option>
                                </select>
                                <?= form_error('rekomendasi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alasan </label>
                            <div class="col-sm-10">
                                <textarea name="alasan" id="alasan" cols="15" rows="5" class="form-control"></textarea>
                                <?= form_error('alasan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>