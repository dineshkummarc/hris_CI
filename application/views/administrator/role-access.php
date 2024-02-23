<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= $title ?></h2>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message'); ?>
        <div class="ibox">
            <div class="ibox-title">
                <h5>Role : <?= $role['role']; ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
                            <th scope="col" class="text-center">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($menu as $m) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td scope="row"><?= $m['menu'] ?></td>
                                <td scope="row" class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" <?= check_access($role['role_id'], $m['id']); ?> data-role="<?= $role['role_id']; ?>" data-menu="<?= $m['id']; ?>">
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="ibox-footer">
                <button class="btn btn-info btn-md back"><span class="fa fa-arrow-circle-left"></span> Kembali</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?= $jumlah; ?>" id="jumlah">
<!-- JavaScript -->
<script>
    $(document).ready(function() {
        function encryptData(data, key) {
            // Bangkitkan kunci enkripsi dari kunci acak dengan PBKDF2
            var salt = CryptoJS.lib.WordArray.random(128 / 8); // Salt acak
            var derivedKey = CryptoJS.PBKDF2(key, salt, {
                keySize: 256 / 32,
                iterations: 1000
            }); // Bangkitkan kunci acak

            // Enkripsi data dengan kunci acak dan vektor inisialisasi acak
            var iv = CryptoJS.lib.WordArray.random(128 / 8); // Vektor inisialisasi acak
            var encrypted = CryptoJS.AES.encrypt(data, derivedKey, {
                iv: iv
            });

            // Gabungkan salt, vektor inisialisasi, dan data terenkripsi menjadi satu string
            var saltHex = CryptoJS.enc.Hex.stringify(salt);
            var ivHex = CryptoJS.enc.Hex.stringify(iv);
            var encryptedHex = CryptoJS.enc.Hex.stringify(encrypted.ciphertext);
            return saltHex + ivHex + encryptedHex;
        }

        $(".form-check-input").on('click', function() {
            
            const menuId = $(this).data('menu');
            var roleId = $(this).data('role');

            var key = "G@ruda7577"; // Kunci enkripsi acak, dapat diganti dengan kunci lain
            var encryptedData = encryptData(roleId.toString(), key);

            $.ajax({
                url: "<?= base_url('administrator/changeaccess'); ?>",
                type: 'post',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function() {
                    document.location.href = "<?= base_url('administrator/setAccess/') ?>" + encryptedData;
                }
            });
        });
    });

    $(document).ready(function() {
        $(".back").click(()=> {
            window.history.back();
        })
    })
</script>