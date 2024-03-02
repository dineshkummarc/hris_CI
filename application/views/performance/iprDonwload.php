<?php

function encode_img_base64($img_path = false, $img_type = 'png')
{
    if ($img_path) {
        //convert image into Binary data
        $img_data = fopen($img_path, 'rb');
        $img_size = filesize($img_path);
        $binary_image = fread($img_data, $img_size);
        fclose($img_data);

        //Build the src string to place inside your img tag
        $img_src = "data:image/" . $img_type . ";base64," . str_replace("\n", "", base64_encode($binary_image));

        return $img_src;
    }

    return false;
}

$logomwk = encode_img_base64('./assets/images/system/mkc.png');


$komen_perbaikan_1 = '';
foreach ($perbaikan1->result() as $hasil_perbaikan_1_row) {
    $komen_perbaikan_1 = explode('|', $hasil_perbaikan_1_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_perbaikan_1 = $komen_perbaikan_1[3];
}

$komen_perbaikan_2 = '';
foreach ($perbaikan2->result() as $hasil_perbaikan_2_row) {
    $komen_perbaikan_2 = explode('|', $hasil_perbaikan_2_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_perbaikan_2 = $komen_perbaikan_2[3];
}

$komen_perbaikan_3 = '';
foreach ($perbaikan3->result() as $hasil_perbaikan_3_row) {
    $komen_perbaikan_3 = explode('|', $hasil_perbaikan_3_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_perbaikan_3 = $komen_perbaikan_3[3];
}

$komen_perbaikan_4 = '';
foreach ($perbaikan4->result() as $hasil_perbaikan_4_row) {
    $komen_perbaikan_4 = explode('|', $hasil_perbaikan_4_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_perbaikan_4 = $komen_perbaikan_4[3];
}

$komen_perbaikan_5 = '';
foreach ($perbaikan5->result() as $hasil_perbaikan_5_row) {
    $komen_perbaikan_5 = explode('|', $hasil_perbaikan_5_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_perbaikan_5 = $komen_perbaikan_5[3];
}

// kekuatan

$komen_kekuatan_1 = '';
foreach ($kekuatan1->result() as $hasil_kekuatan_1_row) {
    $komen_kekuatan_1 = explode('|', $hasil_kekuatan_1_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kekuatan_1 = $komen_kekuatan_1[3];
}

$komen_kekuatan_2 = '';
foreach ($kekuatan2->result() as $hasil_kekuatan_2_row) {
    $komen_kekuatan_2 = explode('|', $hasil_kekuatan_2_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kekuatan_2 = $komen_kekuatan_2[3];
}

$komen_kekuatan_3 = '';
foreach ($kekuatan3->result() as $hasil_kekuatan_3_row) {
    $komen_kekuatan_3 = explode('|', $hasil_kekuatan_3_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kekuatan_3 = $komen_kekuatan_3[3];
}

$komen_kekuatan_4 = '';
foreach ($kekuatan4->result() as $hasil_kekuatan_4_row) {
    $komen_kekuatan_4 = explode('|', $hasil_kekuatan_4_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kekuatan_4 = $komen_kekuatan_4[3];
}

$komen_kekuatan_5 = '';
foreach ($kekuatan5->result() as $hasil_kekuatan_5_row) {
    $komen_kekuatan_5 = explode('|', $hasil_kekuatan_5_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kekuatan_5 = $komen_kekuatan_5[3];
}

// kelemahan

$komen_kelemahan_1 = '';
foreach ($kelemahan1->result() as $hasil_kelemahan_1_row) {
    $komen_kelemahan_1 = explode('|', $hasil_kelemahan_1_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kelemahan_1 = $komen_kelemahan_1[3];
}

$komen_kelemahan_2 = '';
foreach ($kelemahan2->result() as $hasil_kelemahan_2_row) {
    $komen_kelemahan_2 = explode('|', $hasil_kelemahan_2_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kelemahan_2 = $komen_kelemahan_2[3];
}

$komen_kelemahan_3 = '';
foreach ($kelemahan3->result() as $hasil_kelemahan_3_row) {
    $komen_kelemahan_3 = explode('|', $hasil_kelemahan_3_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kelemahan_3 = $komen_kelemahan_3[3];
}

$komen_kelemahan_4 = '';
foreach ($kelemahan4->result() as $hasil_kelemahan_4_row) {
    $komen_kelemahan_4 = explode('|', $hasil_kelemahan_4_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kelemahan_4 = $komen_kelemahan_4[3];
}

$komen_kelemahan_5 = '';
foreach ($kelemahan5->result() as $hasil_kelemahan_5_row) {
    $komen_kelemahan_5 = explode('|', $hasil_kelemahan_5_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_kelemahan_5 = $komen_kelemahan_5[3];
}

// rekomendasi

$komen_rekomendasi_1 = '';
foreach ($rekomendasi1->result() as $hasil_rekomendasi_1_row) {
    $komen_rekomendasi_1 = explode('|', $hasil_rekomendasi_1_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_rekomendasi_1 = $komen_rekomendasi_1[3];
}

$komen_rekomendasi_2 = '';
foreach ($rekomendasi2->result() as $hasil_rekomendasi_2_row) {
    $komen_rekomendasi_2 = explode('|', $hasil_rekomendasi_2_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_rekomendasi_2 = $komen_rekomendasi_2[3];
}

$komen_rekomendasi_3 = '';
foreach ($rekomendasi3->result() as $hasil_rekomendasi_3_row) {
    $komen_rekomendasi_3 = explode('|', $hasil_rekomendasi_3_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_rekomendasi_3 = $komen_rekomendasi_3[3];
}

$komen_rekomendasi_4 = '';
foreach ($rekomendasi4->result() as $hasil_rekomendasi_4_row) {
    $komen_rekomendasi_4 = explode('|', $hasil_rekomendasi_4_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_rekomendasi_4 = $komen_rekomendasi_4[3];
}

$komen_rekomendasi_5 = '';
foreach ($rekomendasi5->result() as $hasil_rekomendasi_5_row) {
    $komen_rekomendasi_5 = explode('|', $hasil_rekomendasi_5_row->TXT_INDIKATOR_NILAI_PENILAI);
    $komen_rekomendasi_5 = $komen_rekomendasi_5[3];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <style>
        .header .no-border {
            border: 0px;
        }

        .table-soal {
            width: 75%;
            float: left;
        }

        .table-p2 {
            width: 4%;
            float: left;
        }

        .table-no {
            width: 6%;
            float: left;
        }

        .table-p3 {
            width: 4%;
            float: left;
        }

        .table-p4 {
            width: 4%;
            float: left;
        }

        .table-p1 {
            width: 4%;
            float: left;
        }

        .table-p15 {
            width: 4%;
            float: left;
        }

        .table-p5 {
            margin-top: 50%;
            margin-left: 75%;
            table-layout: fixed;
            page-break-after: always;
        }

        .table-p5 td {
            width: 10px;
        }

        .table-komen {
            width: 100%;
            margin-top: 10px;
            table-layout: fixed;
        }

        .table-komen td {
            width: 55px;
            word-wrap: break-word;
            border: 1px solid;
            overflow: auto;
        }

        *,
        body {
            font-family: arial;
            font-size: 10px;
        }

        .header td {
            border: 1px solid;
            height: 18px;
            min-width: 30px;
        }

        .header th {
            border: 1px solid;
        }

        .header {
            margin: 0;
            padding: 0;
            border-spacing: 0;
            border-collapse: collapse;
            margin-bottom: 20px;
            width: 100%;
        }
    </style>
    <table class='header'>
        <tr style='border: solid black;'>
            <td rowspan='4' style='  width: 30%;'><img src='<?= $logomwk ?>' style='width:200px; height:50px'></td>
            <td rowspan='4' style=' width: 40%; text-align:center;'>
                <font style='font-size:20px; '>INDICATOR PERFORMANCE REVIEW</font>
            </td>
            <td style=' width: 30%;'>No. Doc : 010/HRD/2019</td>
        </tr>
        <tr style='border:1px solid black'>
            <td style=' width: 30%;'>No. Edisi/Rev : 01</td>
        </tr>
        <tr style='border:1px solid black'>
            <td style=' width: 30%;'>Tanggal : 09/12/2020</td>
        </tr>
        <tr>
            <td style=' width: 30%;'>Halaman : 1 dari 1 </td>
        </tr>
        <tr>
            <td class='no-border'><br>
                <strong>Divisi : </strong><?= namaDivisi($form_penilaian['TXT_NAMA_KARYAWAN'])  ?><br>
                <strong>Nama Karyawan : </strong><?= $form_penilaian['TXT_NAMA_KARYAWAN'] ?><br>
                <div style='text-align:left'><strong>penilai I : </strong><?= $form_penilaian['TXT_PENILAI_1'] ?><br>
                    <strong>penilai II : </strong><?= $form_penilaian['TXT_PENILAI_2'] ?><br>
                    <strong>penilai III : </strong><?= $form_penilaian['TXT_PENILAI_3'] ?><br>
                    <strong>penilai IV : </strong><?= $form_penilaian['TXT_PENILAI_4'] ?><br>
                    <strong>penilai V : </strong><?= $form_penilaian['TXT_PENILAI_5'] ?><br>
                    <strong>Periode Penilaian : </strong><?= $form_penilaian['DATE_PERIODE'] ?> s/d <?= $form_penilaian['DATE_DARI'] ?><br>
                </div>
            </td>
            <td colspan='2' class='no-border' style='vertical-align:top;'></td>
        </tr>
    </table>
    <div class='row'>
        <div class='table-soal'>
            <table>
                <thead>
                    <tr>
                        <td><strong>No</strong></td>
                        <td><strong>Indikator</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no_soal = 1;
                    foreach ($soal->result() as $row) : ?>
                        <tr>
                            <td><?= $no_soal++ ?></td>
                            <td><?= $row->TXT_INDIKATOR ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class='table-no'>
            <table style='margin:0;padding:0; border-spacing:0;border-collapse:collapse;'>
                <thead>
                    <tr>
                        <td><strong>No</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($soal->result() as $row_no) : ?>
                        <tr>
                            <td><?= $no++ ?>. </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class='table-p1'>
            <table style='margin:0;padding:0; border-spacing:0;border-collapse:collapse;'>
                <thead>
                    <tr>
                        <td><strong>P1</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hasil_p1 = (float)0;
                    foreach ($hasil1->result() as $row) {
                        $nilai = [];
                        $nilai = explode('|', $row->TXT_INDIKATOR_NILAI_PENILAI);
                        $nilai = (float)$nilai[1];
                        $hasil_p1 = $hasil_p1 + $nilai;
                    ?>
                        <tr>
                            <td><?= $nilai ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $hasil_p1 ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='table-p2'>
            <table style='margin:0;padding:0; border-spacing:0;border-collapse:collapse;'>
                <thead>
                    <tr>
                        <td><strong>P2</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hasil_p2 = (float)0;
                    foreach ($hasil2->result() as $hasil2_row) {
                        $nilai2 = [];
                        $nilai2 = explode('|', $hasil2_row->TXT_INDIKATOR_NILAI_PENILAI);
                        $nilai2 = $nilai2[1];
                        $hasil_p2 = $hasil_p2 + $nilai2;
                    ?>
                        <tr>
                            <td><?= $nilai2 ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $hasil_p2 ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='table-p3'>
            <table style='margin:0;padding:0; border-spacing:0;border-collapse:collapse;'>
                <thead>
                    <tr>
                        <td><strong>P3</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hasil_p3 = (float)0;
                    foreach ($hasil3->result() as $hasil3_row) {
                        $nilai3 = [];
                        $nilai3 = explode('|', $hasil3_row->TXT_INDIKATOR_NILAI_PENILAI);
                        $nilai3 = $nilai3[1];
                        $hasil_p3 = (float)$hasil_p3 + $nilai3;
                    ?>
                        <tr>
                            <td><?= $nilai3 ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $hasil_p3 ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='table-p4'>
            <table style='margin:0;padding:0; border-spacing:0;border-collapse:collapse;'>
                <thead>
                    <tr>
                        <td><strong>P4</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hasil_p4 = (float)0;
                    foreach ($hasil4->result() as $hasil4_row) {
                        $nilai4 = [];
                        $nilai4 = explode('|', $hasil4_row->TXT_INDIKATOR_NILAI_PENILAI);
                        $nilai4 = $nilai4[1];
                        $hasil_p4 = (float)$hasil_p4 + $nilai4;
                    ?>
                        <tr>
                            <td><?= $nilai4 ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $hasil_p4 ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='table-p15'>
            <table style='margin:0;padding:0; border-spacing:0;border-collapse:collapse;'>
                <thead>
                    <tr>
                        <td><strong>P5</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $hasil_p5 = (float)0;
                    foreach ($hasil5->result() as $hasil5_row) {
                        $nilai5 = [];
                        $nilai5 = explode('|', $hasil5_row->TXT_INDIKATOR_NILAI_PENILAI);
                        $nilai5 = $nilai5[1];
                        $hasil_p5 = (float)$hasil_p5 + $nilai5;
                    ?>
                        <tr>
                            <td><?= $nilai5 ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $hasil_p5 ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
        $total_jumlah = (float)($hasil_p1 + $hasil_p2 + $hasil_p3 + $hasil_p4 + $hasil_p5);
        $sub_rata = (float)$total_jumlah / (float)$jumlah_penilai['INT_JUMLAH_PENILAI'];
        // echo $sub_rata;
        $rata = (float)$sub_rata / (float)$jumllahSoal;
        $index = "";
        if ($rata < 78) {
            $index = 'tidak cukup, sub Par, Sub Standard, mediocre, incompetent';
        } else if ($rata >= 78 && $rata < 82) {
            $index = 'borderline';
        } else if ($rata >= 82 && $rata < 85) {
            $index = 'Good On Par, Standard, Competent';
        } else if ($rata >= 85 && $rata < 91) {
            $index = 'Very Good';
        } else if ($rata >= 91 && $rata < 95) {
            $index = 'Excellent';
        } else if ($rata >= 95) {
            $index = 'Super Excellent-Black Belt';
        }
        $rata = number_format((float)$rata, 2, '.', '');
        ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class='table-p5'>
            <table style='margin:0;padding:0; border-spacing:0;border-collapse:collapse;' class="table" width="100%">
                <thead>
                    <tr>
                        <td><strong>Total </strong>:<?= $total_jumlah ?></td>
                    </tr>
                    <tr>
                        <td><strong>Rata-rata </strong>:<?= $rata ?></td>
                    </tr>
                    <tr>
                        <td>
                            <p><strong>Batasan nilai</strong> :<?= $index ?></p>
                        </td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <table class='header'>
            <tr style='border: solid black;'>
                <td rowspan='4' style='  width: 30%;'><img src='<?= $logomwk ?>' style='width:200px; height:50px'></td>
                <td rowspan='4' style=' width: 40%; text-align:center;'>
                    <font style='font-size:20px; '>INDICATOR PERFORMANCE REVIEW</font>
                </td>
                <td style=' width: 30%;'> No. Doc : 010/HRD/2019</td>
            </tr>
            <tr style='border:1px solid black'>
                <td style=' width: 30%;'> No. Edisi/Rev : 01</td>
            </tr>
            <tr style='border:1px solid black'>
                <td style=' width: 30%;'> Tanggal : 09/12/2020</td>
            </tr>
            <tr>
                <td style=' width: 30%;'> Halaman : 2 dari 2 </td>
            </tr>
            <tr>
                <td class='no-border'><br>
                </td>
                <td colspan='2' class='no-border' style='vertical-align:top;'></td>
            </tr>
            <tr>
                <td class='no-border'>
                    <strong>Divisi : </strong><?= namaDivisi($form_penilaian['TXT_NAMA_KARYAWAN']) ?><br>
                    <strong>Nama Karyawan : </strong><?= $form_penilaian['TXT_NAMA_KARYAWAN'] ?><br>
                    <div style='text-align:left'>
                        <strong>penilai I : </strong><?= $form_penilaian['TXT_PENILAI_1'] ?><br>
                        <strong>penilai II : </strong><?= $form_penilaian['TXT_PENILAI_2'] ?><br>
                        <strong>penilai III : </strong><?= $form_penilaian['TXT_PENILAI_3'] ?><br>
                        <strong>penilai IV : </strong><?= $form_penilaian['TXT_PENILAI_4'] ?><br>
                        <strong>penilai V : </strong><?= $form_penilaian['TXT_PENILAI_5'] ?><br>
                        <strong>Periode Penilaian : </strong><?= $form_penilaian['DATE_PERIODE'] ?> s/d <?= $form_penilaian['DATE_DARI'] ?><br>
                    </div>
                </td>
                <td colspan='2' class='no-border' style='vertical-align:top;'></td>
            </tr>
        </table>
        <div class='table-komen'>
            <table style='margin:0;padding:0; border-spacing:0;border-collapse:collapse;' width="100%">
                <thead>
                    <tr>
                        <td style='text-align:center'><strong>Kekuatan Karyawan </strong></td>
                        <td style='text-align:center'><strong>Kelemahan Karyawan </strong></td>
                        <td style='text-align:center'><strong>Perbaikan yang harus dilakukan </strong></td>
                        <td style='text-align:center'><strong>Rekomendasi </strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr style='vertical-align:top;'>
                        <td> 1. <?= $komen_kekuatan_1 ?> <br /></td>
                        <td> 1. <?= $komen_kelemahan_1 ?> <br /></td>
                        <td> 1. <?= $komen_perbaikan_1 ?> <br /></td>
                        <td> 1. <?= $komen_rekomendasi_1 ?> <br /></td>
                    </tr>
                    <tr style='vertical-align:top;'>
                        <td> 2. <?= $komen_kekuatan_2 ?> <br /></td>
                        <td> 2. <?= $komen_kelemahan_2 ?> <br /></td>
                        <td> 2. <?= $komen_perbaikan_2 ?> <br /></td>
                        <td> 2.<?= $komen_rekomendasi_2 ?> <br /></td>
                    </tr>
                    <tr style='vertical-align:top;'>
                        <td> 3. <?= $komen_kekuatan_3 ?> <br /></td>
                        <td> 3. <?= $komen_kelemahan_3 ?> <br /></td>
                        <td> 3. <?= $komen_perbaikan_3 ?> <br /></td>
                        <td> 3.<?= $komen_rekomendasi_3 ?> <br /></td>
                    </tr>
                    <tr style='vertical-align:top;'>
                        <td> 4. <?= $komen_kekuatan_4 ?> <br /></td>
                        <td> 4. <?= $komen_kelemahan_4 ?> <br /></td>
                        <td> 4. <?= $komen_perbaikan_4 ?> <br /></td>
                        <td> 4.<?= $komen_rekomendasi_4 ?> <br /></td>
                    </tr>
                    <tr style='vertical-align:top;'>
                        <td> 5. <?= $komen_kekuatan_5 ?> <br /></td>
                        <td> 5. <?= $komen_kelemahan_5 ?> <br /></td>
                        <td> 5. <?= $komen_perbaikan_5 ?> <br /></td>
                        <td> 5.<?= $komen_rekomendasi_5 ?> <br /></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>