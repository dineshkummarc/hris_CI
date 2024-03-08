<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_karyawan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function getUrutan()
    {
        $sql    = "SELECT MAX(kode) AS idArr
        FROM (SELECT CAST(urutan AS INT) AS kode 
            FROM (SELECT SUBSTRING(user_id, 11) AS urutan 
                FROM tb_user) AS tabel_a) AS table_b;";
        $query  = $this->db->query($sql);

        return $query;
    }

    public function getUrutanPelamar()
    {
        $sql    = "SELECT MAX(kode) AS idArr FROM (SELECT CAST(urutan AS INT) AS kode FROM (SELECT SUBSTRING(id_pelamar, 10) AS urutan FROM tb_pelamar WHERE YEAR(tgl_interview) = '" . date('Y') . "') AS tabel_a) AS table_b;";
        $query  = $this->db->query($sql);

        return $query;
    }

    public function cariNama($key = NULL)
    {
        // Kueri untuk mencari data karyawan berdasarkan nama atau divisi
        $this->db->select('TXT_NAMA');
        $this->db->from('tb_user');
        if ($key != NULL) {
            // Gunakan prepared statements untuk menghindari SQL Injection
            $this->db->group_start();
            $this->db->like('TXT_NAMA', $key);
            $this->db->or_like('TXT_DIVISI', $key);
            $this->db->group_end();
        }
        $this->db->where('is_active', '1');
        $this->db->order_by('TXT_NAMA', 'ASC');

        $result = $this->db->get();
        return $result;
    }
}
