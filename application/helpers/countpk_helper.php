<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('hitungProject')) {
    function hitungProject($userid) {
        $ci     = get_instance();
        $query  = "SELECT COUNT(*) AS jumlah FROM tb_project WHERE pic='$userid'";
        $row    = $ci->db->query($query)->row_array();

        return $row['jumlah'];
    }
}

if (!function_exists('hitungKaizen')) {
    function hitungKaizen($userid) {
        $ci     = get_instance();
        $query  = "SELECT COUNT(*) AS jumlah FROM tb_kaizen WHERE inputby='$userid'";
        $row    = $ci->db->query($query)->row_array();

        return $row['jumlah'];
    }
}

if (!function_exists('hitungPenalty')) {
    function hitungPenalty($userid) {
        $ci     = get_instance();
        $query  = "SELECT COUNT(*) AS `jumlah` FROM `tb_pengajuan` WHERE `TXT_JENIS` = 'penalty' AND `TXT_NAMA_KARYAWAN`='$userid'";
        $row    = $ci->db->query($query)->row_array();

        return $row['jumlah'];
    }
}

if (!function_exists('hitungReward')) {
    function hitungReward($userid) {
        $ci     = get_instance();
        $query  = "SELECT COUNT(*) AS `jumlah` FROM `tb_pengajuan` WHERE `TXT_JENIS` = 'reward' AND `TXT_NAMA_KARYAWAN`='$userid'";
        $row    = $ci->db->query($query)->row_array();

        return $row['jumlah'];
    }
}