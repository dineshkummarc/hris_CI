<?php
$nilai = array();

foreach ($hasil1->result() as $hasil1_row) {
    // Menggunakan $row bukan $hasil1_row
    $nilai[] = explode('|', $hasil1_row->TXT_INDIKATOR_NILAI_PENILAI);
}

// Menghapus array_push karena sudah tidak diperlukan
// Menggunakan $nilai bukan $hasil1
echo json_encode($nilai);
?>
