<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ipr extends CI_Model
{
    public function get_ipr_data($user)
    {
        $this->db->where('TXT_PENILAI_2', $user);
        $this->db->or_where('TXT_PENILAI_1', $user);
        $this->db->or_where('TXT_PENILAI_3', $user);
        $this->db->or_where('TXT_PENILAI_4', $user);
        $this->db->or_where('TXT_NAMA_PEMBUAT', $user);
        $this->db->or_where('TXT_NAMA_KARYAWAN', $user);

        $this->db->order_by('INT_ID_FORM', 'DESC');
        $this->db->order_by('DATE_PERIODE', 'DESC');
        $query = $this->db->get('tb_form_penilaian_karyawan');
        return $query;
    }
}
