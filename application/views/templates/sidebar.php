<?php
$tim = $this->db->get_where('user_role', ['role_id' => $user['role_id']])->row_array();
$keys = "G@ruda7577";
$encrypter = encrypt_data($user['user_id'], $keys);
?>
<nav class="navbar-default navbar-static-side " role="navigation">
    <div class="sidebar-collapse">
        <a class="close-canvas-menu"><i class="fa fa-times"></i></a> <!-- 230417 ~ full page -->
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="" src="<?= base_url('assets') ?>/images/system/logo.png" width="68%" />
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold"><?= $tim['role'] ?></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="<?= base_url('dashboard/editProfil/') . $encrypter ?>"><i class="fa fa-user-circle"></i> <?= $user['TXT_NAMA'] ?></a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-envelope-square"></i> <?= $user['TXT_EMAIL'] ?></a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item ubahPassword" data-id="<?= $user['user_id'] ?>" href="#">Change Password</a>
                    </ul>
                </div>
                <div class="logo-element">
                    HR
                </div>
            </li>
            <hr class="hr-line-solid divider">
            <!-- query menu -->
            <?php
            $roleID = $this->session->userdata('role_id');
            $queryMenu = "SELECT `user_menu`.`id`, `menu`
                FROM `user_menu` JOIN `user_access_menu`
                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
            WHERE `user_access_menu`.`role_id` = $roleID
            ORDER BY `user_menu`.`nourut` ASC";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>
            <!-- Looping data Menu -->
            <?php foreach ($menu as $m) : ?>
                <div class="nav-label ml-2 text-danger">
                    <?= $m['menu'] ?>
                </div>
                <!-- submenu -->
                <?php
                $menuID = $m['id'];
                $querySubMenu = "SELECT * FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                WHERE `user_sub_menu`.`menu_id` = $menuID
                AND `user_sub_menu`.`is_active` = '1' ORDER BY nourutan ASC";

                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>
                <?php foreach ($subMenu as $sm) : ?>
                    <?php if ($title == $sm['title']) : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li>
                        <?php endif; ?>
                        <a href="<?= base_url($sm['url']) ?>">
                            <i class="<?= $sm['icon'] ?>"></i>
                            <span class="nav-label"><?= $sm['title'] ?></span>
                        </a>
                        </li>
                    <?php endforeach; ?>
                    <hr class="nav-divider nav-fill">
                <?php endforeach; ?>
        </ul>

    </div>
</nav>