CREATE TABLE `tb_indikator_penilaian_karyawan` (
    `INT_ID` int(11) NOT NULL,
    `TXT_INDIKATOR` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `tb_indikator_penilaian_karyawan` (`INT_ID`, `TXT_INDIKATOR`)
VALUES
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

--
-- Indexes for dumped tables
--
--
-- Indeks untuk tabel `tb_indikator_penilaian_karyawan`
--
ALTER TABLE
    `tb_indikator_penilaian_karyawan`
ADD
    PRIMARY KEY (`INT_ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--
--
-- AUTO_INCREMENT untuk tabel `tb_indikator_penilaian_karyawan`
--
ALTER TABLE
    `tb_indikator_penilaian_karyawan`
MODIFY
    `INT_ID` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 27;

COMMIT;