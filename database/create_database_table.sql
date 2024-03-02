/*
 SQLyog Professional v12.5.1 (64 bit)
 MySQL - 10.4.24-MariaDB : Database - mrkw7566_db_hris
 *********************************************************************
 */
/*!40101 SET NAMES utf8 */
;

/*!40101 SET SQL_MODE=''*/
;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

USE `mrkw7566_db_hris`;

/*Table structure for table `activity_logs` */
DROP TABLE IF EXISTS `activity_logs`;

CREATE TABLE `activity_logs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `ip_address` varchar(100) DEFAULT NULL,
    `page_visited` varchar(128) DEFAULT NULL,
    `visit_time` datetime DEFAULT NULL,
    `visitor_name` varchar(128) DEFAULT NULL,
    `country` varchar(128) DEFAULT NULL,
    `isp` varchar(128) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 678 DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `role_access_rights`;

CREATE TABLE `role_access_rights` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `rar_name` varchar(50) NOT NULL,
    `create` enum('0', '1') NOT NULL DEFAULT '0',
    `read` enum('0', '1') NOT NULL DEFAULT '0',
    `update` enum('0', '1') NOT NULL DEFAULT '0',
    `delete` enum('0', '1') NOT NULL DEFAULT '0',
    `download` enum('0', '1') NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4;

/*Data for the table `role_access_rights` */
insert into
    `role_access_rights`(
        `id`,
        `rar_name`,
        `create`,
        `read`,
        `update`,
        `delete`,
        `download`
    )
values
    (1, 'Superadmin', '1', '1', '1', '1', '1'),
    (2, 'Admin', '0', '1', '1', '0', '1'),
    (3, 'User', '0', '1', '0', '0', '0');

/*Table structure for table `tb_akses_menu` */
DROP TABLE IF EXISTS `tb_akses_menu`;

CREATE TABLE `tb_akses_menu` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `divisi` varchar(50) NOT NULL,
    `menu` varchar(128) NOT NULL,
    `forbiden_status` enum('0', '1') NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_akses_menu` */
insert into
    `tb_akses_menu`(`id`, `divisi`, `menu`, `forbiden_status`)
values
    (1, 'HRD', 'ambilDataIpr', '1');

/*Table structure for table `tb_divisi` */
DROP TABLE IF EXISTS `tb_divisi`;

CREATE TABLE `tb_divisi` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nama_divisi` varchar(128) NOT NULL,
    `date_added` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 15 DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_divisi` */
insert into
    `tb_divisi`(`id`, `nama_divisi`, `date_added`)
values
    (1, 'IT', 1708747684),
    (2, 'HRD', 0),
    (4, 'ADMINISTRASI', 0),
    (5, 'DESIGN', 0),
    (6, 'GUDANG', 0),
    (7, 'MIS', 0),
    (8, 'DIGITAL MARKETING', 0),
    (9, 'SALES & MARKETING FOODPACK', 0),
    (10, 'SHOWROOM', 0),
    (12, 'SALES & MARKETING HOREKA', 1708412613),
    (14, 'Akunting', 1709275846);

/*Table structure for table `tb_form_penilaian_karyawan` */
DROP TABLE IF EXISTS `tb_form_penilaian_karyawan`;

CREATE TABLE `tb_form_penilaian_karyawan` (
    `INT_ID_FORM` int(11) NOT NULL AUTO_INCREMENT,
    `TXT_NAMA_PEMBUAT` varchar(150) NOT NULL,
    `TXT_NAMA_KARYAWAN` varchar(50) NOT NULL,
    `TXT_PENILAI_1` varchar(50) NOT NULL,
    `TXT_PENILAI_2` varchar(50) NOT NULL,
    `TXT_PENILAI_3` varchar(50) NOT NULL,
    `TXT_PENILAI_4` varchar(50) NOT NULL,
    `TXT_PENILAI_5` varchar(60) NOT NULL DEFAULT '-',
    `TXT_SUDAH_MENILAI_1` varchar(50) NOT NULL DEFAULT '0',
    `TXT_SUDAH_MENILAI_2` varchar(50) NOT NULL DEFAULT '0',
    `TXT_SUDAH_MENILAI_3` varchar(50) NOT NULL DEFAULT '0',
    `TXT_SUDAH_MENILAI_4` varchar(50) NOT NULL DEFAULT '0',
    `TXT_SUDAH_MENILAI_5` varchar(50) NOT NULL DEFAULT '0',
    `DATE_PERIODE` date NOT NULL,
    `DATE_DARI` date NOT NULL,
    `INT_JUMLAH_PENILAI` int(11) NOT NULL,
    `id_periode` varchar(25) NOT NULL,
    PRIMARY KEY (`INT_ID_FORM`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `tb_hasil_nilai_tujuh_kk`;

CREATE TABLE `tb_hasil_nilai_tujuh_kk` (
    `INT_ID` int(11) NOT NULL AUTO_INCREMENT,
    `TXT_NAMA_KARYAWAN` varchar(255) NOT NULL,
    `TXT_NILAI_FORM_PENILAIAN` varchar(11) NOT NULL,
    `TXT_NILAI_REWARD_PENALTY` varchar(11) NOT NULL,
    `TXT_NILAI_HAFALAN` varchar(11) NOT NULL,
    PRIMARY KEY (`INT_ID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_hasil_nilai_tujuh_kk` */
/*Table structure for table `tb_indikator_penilaian_karyawan` */
DROP TABLE IF EXISTS `tb_indikator_penilaian_karyawan`;

CREATE TABLE `tb_indikator_penilaian_karyawan` (
    `INT_ID` int(11) NOT NULL AUTO_INCREMENT,
    `TXT_INDIKATOR` varchar(255) NOT NULL,
    PRIMARY KEY (`INT_ID`)
) ENGINE = InnoDB AUTO_INCREMENT = 27 DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_indikator_penilaian_karyawan` */
insert into
    `tb_indikator_penilaian_karyawan`(`INT_ID`, `TXT_INDIKATOR`)
values
    (1, '1.a Memakai Minutes Of Meeting'),
    (2, '1.c Melaksanakan 5S'),
    (
        3,
        '2. Mengerti  dan jalankan Konsep Get Organized, Bisa Membuat Budgeting, Menjalankan Review / Follow Up / Audit'
    ),
    (4, '3. Mengerti dan jalankan PDCA'),
    (5, '5. Monitoring KPI and action'),
    (6, '6. Genchi Genbutsu'),
    (7, '7.b Be Proactive'),
    (8, '7.d Bisa Dipercaya'),
    (9, '7.e Team Work'),
    (10, '7f. Tanggung Jawab'),
    (11, '7h, 7i, 7x, 7ab, 7ac, 7ad, 7.ae7.ah'),
    (12, '7.j Tuntas'),
    (13, '7k Bekerja Dengan Sepenuh Hati & Jujur'),
    (14, '7m. Teliti & Detail'),
    (15, '7n Menarik Perusahaan Maju'),
    (16, '7p Hafal dan jalankan 7 Kerangka Kerja'),
    (17, '7q. Mau Belajar dan Bisa Belajar'),
    (18, '7qMau Berubah dan Bisa Berubah'),
    (19, '7r Automatic Update & review'),
    (
        20,
        '7.t Mindset : ?Sedia Payung Sebelum Hujan? (Prepare in Advance)'
    ),
    (
        21,
        '7aa. Dasar Pemikiran Untuk Perusahaan / Bersama / Team'
    ),
    (22, '7.af. Rasa Memiliki (Ownership)'),
    (23, '7.ag Mindset : What Can I Do For Company'),
    (24, '7.ah Do Your Very Best Everyday'),
    (25, '7.ai GRIT'),
    (26, '7.q. Kaizen, Improvement');

/*Table structure for table `tb_kaizen` */
DROP TABLE IF EXISTS `tb_kaizen`;

CREATE TABLE `tb_kaizen` (
    `id_kaizen` int(11) NOT NULL AUTO_INCREMENT,
    `judul` varchar(250) NOT NULL,
    `beforekai` text NOT NULL COMMENT 'Kondisi sebelum improvement',
    `recomendkai` text NOT NULL COMMENT 'usul improvement',
    `afterkai` text NOT NULL COMMENT 'Kondisi setelah Improvement',
    `pic` varchar(100) NOT NULL,
    `duedate` date NOT NULL COMMENT 'Tanggal Due Date',
    `onmonth` varchar(40) NOT NULL COMMENT 'Improvement untuk bulan ke',
    `onweek` int(2) NOT NULL COMMENT 'Untuk meinggu ke',
    `inputby` varchar(100) NOT NULL COMMENT 'who is writer',
    `inputdate` datetime NOT NULL COMMENT 'when',
    PRIMARY KEY (`id_kaizen`)
) ENGINE = InnoDB AUTO_INCREMENT = 63 DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `tb_nilai_penilaian_karyawan`;

CREATE TABLE `tb_nilai_penilaian_karyawan` (
    `INT_ID` int(11) NOT NULL AUTO_INCREMENT,
    `INT_ID_FORM` int(11) NOT NULL,
    `TXT_INDIKATOR_NILAI_PENILAI` varchar(255) NOT NULL COMMENT 'form_id||nilai||penilai\r\natau form_id||jenis_komen||yangkomen\r\n',
    PRIMARY KEY (`INT_ID`)
) ENGINE = InnoDB AUTO_INCREMENT = 121 DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `tb_pelamar`;

CREATE TABLE `tb_pelamar` (
    `id_pelamar` varchar(50) NOT NULL COMMENT 'PL240224-0001 dst',
    `nama_pelamar` varchar(128) NOT NULL,
    `posisi_yangdilamar` varchar(100) NOT NULL,
    `usia_pelamar` int(11) NOT NULL,
    `pendidikan_terahir` varchar(50) NOT NULL,
    `fakultas_pelamar` varchar(85) DEFAULT NULL,
    `jurusan_pelamar` varchar(100) DEFAULT NULL,
    `nama_sekolah` varchar(128) DEFAULT NULL,
    `tgl_interview` date NOT NULL,
    `pengalaman_kerja1` text DEFAULT NULL,
    `pengalaman_kerja2` text DEFAULT NULL,
    `pengalaman_kerja3` text DEFAULT NULL,
    `pengalaman_kerja4` text DEFAULT NULL,
    `pengalaman_kerja5` text DEFAULT NULL,
    `pengalaman_kerja6` text DEFAULT NULL,
    `kekurangan_pelamar` text DEFAULT NULL,
    `kelebihan_pelamar` text DEFAULT NULL,
    `vaksin` varchar(128) DEFAULT NULL,
    `req_salary` int(11) DEFAULT NULL,
    `hasil_intervie` enum('0', '1', '2') DEFAULT NULL COMMENT '0 tolak, 1 terima, 2 pertimbangkan',
    `alasan_hasil` text DEFAULT NULL,
    `input_by` varchar(128) DEFAULT NULL,
    PRIMARY KEY (`id_pelamar`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `tb_penalty`;

CREATE TABLE `tb_penalty` (
    `INT_ID` int(11) NOT NULL AUTO_INCREMENT,
    `TXT_JENIS` varchar(200) NOT NULL,
    `INT_POINT` int(3) NOT NULL,
    PRIMARY KEY (`INT_ID`)
) ENGINE = InnoDB AUTO_INCREMENT = 35 DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_penalty` */
insert into
    `tb_penalty`(`INT_ID`, `TXT_JENIS`, `INT_POINT`)
values
    (1, 'Mangkir', 50),
    (2, 'Lupa Absen  ', 10),
    (
        3,
        'Ijin telat/tidak masuk tidak melalui call center HRD',
        10
    ),
    (4, 'Telat (seminggu min. 3 kali telat)', 25),
    (5, 'Tidak Jujur / Berbohong ', 25),
    (6, 'Tidak proaktif / harus dipeuncit', 50),
    (
        7,
        'Tidak bertanggung jawab / meng sub con kan tugas',
        100
    ),
    (8, 'Tidak bisa bekerjasa sama secara positif', 15),
    (9, 'Sulit dimintai tolong', 15),
    (10, 'Tidak sopan terhadap karyawan lain', 10),
    (
        11,
        'Tidak menjawab pertanyaan dari rekan kerja',
        10
    ),
    (12, 'Tidak Hemat (pakai listrik, air,kertas)', 10),
    (13, 'Bekerja malas-malasan / Banyak Mengeluh', 15),
    (14, 'Tidak tuntas menyelesaikan tugas', 50),
    (15, 'Tidak menjalankan perintah', 15),
    (16, 'Merubah / melanggar  SOP dan Policy ', 50),
    (17, 'Tidak bisa / tidak mau menerima saran', 10),
    (18, 'No update itis', 100),
    (19, 'No. Ukur Itis', 100),
    (
        20,
        'Menyalahkan orang lain untuk setiap kesalahan yang dibuatnya ',
        25
    ),
    (
        21,
        'Tidak melakukan komunikasi, kordinasi, konfirmasi dengan baik dan tuntas',
        25
    ),
    (22, 'Short cut', 25),
    (23, 'Wasting time', 15),
    (24, 'Menunda-nunda pekerjaan', 15),
    (
        25,
        'Tidak memiliki kepedulian terhadap inventaris perusahaan',
        25
    ),
    (26, 'Bekerja tidak kualitas', 15),
    (27, 'Pembiaran terhadap Masalah', 50),
    (
        28,
        'Tidak melakukan kontrol terhadap pekerjaan / anak buah nya',
        50
    ),
    (
        29,
        'Bekerja dengan pamrih, sehingga menolak dimintai tolong',
        25
    ),
    (30, 'Tidak ada Grit', 15),
    (
        31,
        'Bertingkah laku tiidak sesuai karakter yang baik dan benar',
        10
    ),
    (
        32,
        'Selalu menyepelakan pekerjaan / orang lain',
        10
    ),
    (
        33,
        'Tidak mau belajar/ ikut training / Menyepelekan training',
        10
    ),
    (
        34,
        'sulit berkorban lebih dari segi waktu/tenaga',
        15
    );

/*Table structure for table `tb_pengajuan` */
DROP TABLE IF EXISTS `tb_pengajuan`;

CREATE TABLE `tb_pengajuan` (
    `INT_ID` int(11) NOT NULL AUTO_INCREMENT,
    `TXT_JENIS` text NOT NULL,
    `TXT_NAMA_PENGAJU` varchar(35) NOT NULL,
    `TXT_NAMA_KARYAWAN` varchar(50) NOT NULL,
    `INT_POINT_PERUBAHAN` int(5) NOT NULL,
    `TXT_ALASAN` text NOT NULL,
    `TXT_ALASAN_TAMBAHAN` text NOT NULL,
    `TXT_ALASAN_FEEDBACK` text NOT NULL,
    `INT_STATUS` int(1) NOT NULL DEFAULT 0,
    `INSERTED_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`INT_ID`)
) ENGINE = InnoDB AUTO_INCREMENT = 20 DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_pengajuan` */
/*Table structure for table `tb_periode` */
DROP TABLE IF EXISTS `tb_periode`;

CREATE TABLE `tb_periode` (
    `INT_ID` varchar(25) NOT NULL,
    `TXT_JENIS` varchar(255) NOT NULL,
    `DATE_DARI` date NOT NULL,
    `DATE_SAMPAI` date NOT NULL,
    PRIMARY KEY (`INT_ID`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_periode` */
/*Table structure for table `tb_project` */
DROP TABLE IF EXISTS `tb_project`;

CREATE TABLE `tb_project` (
    `id_project` varchar(25) NOT NULL,
    `judul_project` varchar(500) NOT NULL,
    `tanggal_mulai` datetime NOT NULL,
    `due_date` datetime NOT NULL,
    `pic` varchar(150) NOT NULL COMMENT 'yang mengerjakan tugas',
    `status_project` enum('0', '1') NOT NULL DEFAULT '0' COMMENT '0 = Belum Selesai, On progress; 1 = Selesai',
    `tgl_selesai` datetime DEFAULT NULL,
    `konfirmasi_selesai` enum('0', '1') NOT NULL DEFAULT '0' COMMENT '0 = belum dikonfirmasi; 1 = sudah dikonfirmasi',
    `korfirmasi_by` varchar(150) DEFAULT NULL,
    `tgl_konfirmasi` date DEFAULT NULL,
    `tglcreate` datetime DEFAULT NULL,
    `assignor` varchar(25) NOT NULL COMMENT 'pemberi tugas',
    `keterangan` text DEFAULT NULL,
    `rating` enum('0', '1', '2', '3', '4', '5') DEFAULT NULL COMMENT 'rating dati bintang 1 - 5',
    `rating_feedback` text DEFAULT NULL COMMENT 'isi dari penilaian',
    `kuadran` enum('A', 'B') DEFAULT NULL,
    PRIMARY KEY (`id_project`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `tb_project_comment`;

CREATE TABLE `tb_project_comment` (
    `pn_id` int(25) NOT NULL AUTO_INCREMENT,
    `id_project` varchar(25) NOT NULL COMMENT 'get data from master_project',
    `pn_date` datetime NOT NULL,
    `pn_text` text NOT NULL,
    `pn_create` varchar(150) DEFAULT NULL,
    PRIMARY KEY (`pn_id`),
    KEY `id_project` (`id_project`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_project_comment` */
/*Table structure for table `tb_reward` */
DROP TABLE IF EXISTS `tb_reward`;

CREATE TABLE `tb_reward` (
    `INT_ID` int(11) NOT NULL AUTO_INCREMENT,
    `TXT_JENIS` varchar(255) NOT NULL,
    `INT_POINT` int(3) NOT NULL,
    PRIMARY KEY (`INT_ID`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4;

/*Data for the table `tb_reward` */
insert into
    `tb_reward`(`INT_ID`, `TXT_JENIS`, `INT_POINT`)
values
    (
        1,
        'Disiplin (Absensi 1 bulan Full tanpa pernah terlambat, ijin ijin keperluan pribadi)',
        100
    ),
    (
        2,
        'menarik perusahaan maju dengan banyak memberikan ide yang \"aplicable\"',
        100
    ),
    (
        3,
        'Mampu memberikan improvement & implemented untuk bagiannya ',
        100
    ),
    (
        4,
        'Memberikan Update secara konsisten dan berkualitas',
        100
    ),
    (
        5,
        'Menunjukkan komitment yang tinggi dalam menyelesaikan tugas',
        100
    ),
    (
        6,
        'Menunjukkan Inisiatif yang positif tanpa perlu diminta',
        100
    ),
    (
        7,
        'Membantu menyelesaikan masalah orang lain sampai selesai dan tuntas, walau bukan menjadi tanggung jawab ybs',
        100
    ),
    (
        8,
        'Menunjukkan sikap pantang menyerah dan mau mencoba dalam menghadapi masalah',
        100
    ),
    (
        9,
        'Bersikeras dalam memotivasi orang lain untuk bekerja kualitas',
        100
    ),
    (
        10,
        'Siap berkorban waktu, tenaga tanpa perlu diminta',
        100
    );

/*Table structure for table `tb_user` */
DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
    `user_id` varchar(128) NOT NULL,
    `absen_id` int(11) DEFAULT NULL,
    `TXT_DIVISI` varchar(100) DEFAULT NULL,
    `TXT_NAMA` varchar(128) DEFAULT NULL,
    `username` varchar(50) DEFAULT NULL,
    `password` varchar(128) DEFAULT NULL,
    `TXT_ALAMAT` text DEFAULT NULL,
    `TXT_TELEPON` varchar(25) DEFAULT NULL,
    `TXT_TEMPAT_LAHIR` varchar(100) DEFAULT NULL,
    `DATE_TANGGAL_LAHIR` date DEFAULT NULL,
    `TXT_KELAMIN` enum('Laki - Laki', 'Perempuan') DEFAULT NULL,
    `TXT_STATUS` varchar(50) DEFAULT NULL,
    `TXT_AGAMA` varchar(120) DEFAULT NULL,
    `TXT_KEBANGSAAN` varchar(100) DEFAULT NULL,
    `TXT_HOBBY` text DEFAULT NULL,
    `TXT_NAMA_KERABAT` varchar(128) DEFAULT NULL,
    `TXT_ALAMAT_TELP_KRBT` text DEFAULT NULL,
    `TXT_HUBUNGAN_KRBT` varchar(50) DEFAULT NULL,
    `TXT_NAMA_SUAMI_ISTRI` varchar(128) DEFAULT NULL,
    `TXT_TEMPAT_LAHIR_SUAMI_ISTRI` varchar(120) DEFAULT NULL,
    `DATE_TANGGAL_LAHIR_SUAMI_ISTRI` date DEFAULT NULL,
    `TXT_PEKERJAAN_SUAMI_ISTRI` varchar(100) DEFAULT NULL,
    `TXT_NAMA_ALAMAT_PEKERJAAN_SUAMI_ISTRI` text DEFAULT NULL,
    `TXT_TELEPON_SUAMI_ISTRI` varchar(50) DEFAULT NULL,
    `TXT_NAMA_ANAK_1` varchar(128) DEFAULT NULL,
    `TXT_NAMA_ANAK_2` varchar(128) DEFAULT NULL,
    `TXT_NAMA_ANAK_3` varchar(128) DEFAULT NULL,
    `TXT_NAMA_ANAK_4` varchar(128) DEFAULT NULL,
    `TXT_NAMA_ANAK_5` varchar(128) DEFAULT NULL,
    `TXT_EMAIL` varchar(58) DEFAULT NULL,
    `TXT_NIK` varchar(25) DEFAULT NULL,
    `TXT_NPWP` varchar(25) DEFAULT NULL,
    `TXT_PHOTO` varchar(30) NOT NULL DEFAULT 'default.jpg',
    `is_active` enum('0', '1') NOT NULL DEFAULT '1',
    `DATE_TANGGAL_RESIGN` date DEFAULT NULL,
    `TXT_KONTRAK_PERCOBAAN` varchar(100) DEFAULT NULL,
    `TXT_KONTRAK_1` varchar(100) DEFAULT NULL,
    `TXT_KONTRAK_2` varchar(100) DEFAULT NULL,
    `TXT_KONTRAK_3` varchar(100) DEFAULT NULL,
    `TXT_KONTRAK_4` varchar(100) DEFAULT NULL,
    `TXT_KONTRAK_5` varchar(100) DEFAULT NULL,
    `INT_POINT` int(11) NOT NULL DEFAULT 1000,
    `tgl_mulai_bekerja` date DEFAULT NULL,
    `role_id` int(11) DEFAULT NULL,
    `rar_id` int(11) DEFAULT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `user_access_menu`;

CREATE TABLE `user_access_menu` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `role_id` int(11) NOT NULL,
    `menu_id` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 65 DEFAULT CHARSET = utf8mb4;

/*Data for the table `user_access_menu` */
insert into
    `user_access_menu`(`id`, `role_id`, `menu_id`)
values
    (40, 1, 1),
    (41, 1, 2),
    (42, 1, 3),
    (43, 1, 5),
    (44, 1, 6),
    (45, 12, 1),
    (46, 12, 3),
    (49, 12, 5),
    (51, 12, 6),
    (52, 13, 1),
    (53, 13, 3),
    (54, 13, 5),
    (55, 14, 1),
    (57, 14, 5),
    (58, 14, 8),
    (59, 13, 8),
    (60, 1, 8),
    (61, 12, 8),
    (62, 12, 9),
    (63, 1, 9),
    (64, 13, 6);

/*Table structure for table `user_menu` */
DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `menu` varchar(128) NOT NULL,
    `nourut` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4;

/*Data for the table `user_menu` */
insert into
    `user_menu`(`id`, `menu`, `nourut`)
values
    (1, 'Dashboard', 1),
    (2, 'Administrator', 2),
    (3, 'Interview', 5),
    (5, 'Datakaryawan', 4),
    (6, 'Performance', 3),
    (8, 'Kaizen', 6),
    (9, 'Monitoring', 7);

/*Table structure for table `user_role` */
DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
    `role_id` int(11) NOT NULL AUTO_INCREMENT,
    `role` varchar(128) NOT NULL COMMENT 'Devisi',
    `keterangan` varchar(128) DEFAULT NULL,
    PRIMARY KEY (`role_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 17 DEFAULT CHARSET = utf8mb4;

/*Data for the table `user_role` */
insert into
    `user_role`(`role_id`, `role`, `keterangan`)
values
    (1, 'IT Administrator', 'All IT Team, all access'),
    (12, 'HRD', 'Human resource team'),
    (13, 'Anggota HRD', 'Bagian dari staff HRD'),
    (
        14,
        'IT Helpdesk',
        'bagian dari tim it : support helpdesk'
    ),
    (15, 'Akunting', 'Leaders of accounting team'),
    (
        16,
        'Anggota Akunting',
        'member of accounting team'
    );

/*Table structure for table `user_sub_menu` */
DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `menu_id` int(11) NOT NULL,
    `title` varchar(128) NOT NULL,
    `url` varchar(128) NOT NULL,
    `icon` varchar(128) NOT NULL,
    `is_active` enum('0', '1') NOT NULL COMMENT '0 = Nonaktif, 1 = aktif',
    `created_date` int(11) DEFAULT NULL,
    `created_by` varchar(128) DEFAULT NULL,
    `nourutan` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 32 DEFAULT CHARSET = utf8mb4;

/*Data for the table `user_sub_menu` */
insert into
    `user_sub_menu`(
        `id`,
        `menu_id`,
        `title`,
        `url`,
        `icon`,
        `is_active`,
        `created_date`,
        `created_by`,
        `nourutan`
    )
values
    (
        16,
        2,
        'Menu Management',
        'administrator/menu',
        'fa fa-cog',
        '1',
        NULL,
        NULL,
        1
    ),
    (
        17,
        2,
        'User Role',
        'administrator/role',
        'fa fa-cogs',
        '1',
        1706864824,
        'Paulus Christofel S',
        2
    ),
    (
        18,
        1,
        'Dashboard',
        'dashboard',
        'fa fa-th-large',
        '1',
        NULL,
        NULL,
        NULL
    ),
    (
        19,
        3,
        'Hasil Rekap',
        'interview/hasil',
        'fa fa-handshake-o',
        '1',
        1706865769,
        'Paulus Christofel S',
        NULL
    ),
    (
        20,
        3,
        'Tambah Data',
        'interview/add',
        'fa fa-plus-square',
        '1',
        1706866058,
        'Paulus Christofel S',
        NULL
    ),
    (
        21,
        5,
        'Karyawan Aktif',
        'datakaryawan/aktif',
        'fa fa-user-o',
        '1',
        1706866233,
        'Paulus Christofel S',
        NULL
    ),
    (
        22,
        5,
        'Karyawan Nonaktif',
        'datakaryawan/nonaktif',
        'fa fa-user',
        '1',
        1706866325,
        'Paulus Christofel S',
        NULL
    ),
    (
        23,
        5,
        'Divisi',
        'datakaryawan/divisi',
        'fa fa-users',
        '1',
        1706866394,
        'Paulus Christofel S',
        NULL
    ),
    (
        24,
        6,
        'IPR',
        'performance/ipr',
        'fa fa-check-square-o',
        '1',
        1706867028,
        'Paulus Christofel S',
        NULL
    ),
    (
        25,
        6,
        'Panduan',
        'performance/guide',
        'fa fa-book',
        '1',
        1706867093,
        'Paulus Christofel S',
        NULL
    ),
    (
        26,
        8,
        'Improvement',
        'kaizen',
        'fa fa-grav',
        '1',
        1708419705,
        'Paulus Christofel S',
        NULL
    ),
    (
        27,
        9,
        'Data IPR',
        'monitoring/dataipr',
        'fa fa-book',
        '1',
        1708577739,
        'Paulus Christofel S',
        1
    ),
    (
        28,
        9,
        'Nilai Akhir',
        'monitoring/finalScore',
        'fa  fa-rocket',
        '1',
        1708580078,
        'Paulus Christofel S',
        0
    ),
    (
        29,
        9,
        'Data Improvement',
        'monitoring',
        'fa fa-dot-circle-o',
        '1',
        1708582569,
        'Paulus Christofel S',
        2
    ),
    (
        30,
        9,
        'Data Reward & Penalty',
        'monitoring/allrewardpenalty',
        'fa fa-star',
        '1',
        1708583559,
        'Paulus Christofel S',
        NULL
    ),
    (
        31,
        9,
        'Poin Karyawan',
        'monitoring/allpoin',
        'fa fa-cube',
        '1',
        1708583696,
        'Paulus Christofel S',
        NULL
    );