<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('namaDivisi')) {
    function namaDivisi($namaKaryawan) {
        $ci = get_instance();

        $row = $ci->db->get_where('tb_user', ['TXT_NAMA'=>$namaKaryawan])->row_array();
        return $row['TXT_DIVISI'];
    }
}