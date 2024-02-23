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
}
