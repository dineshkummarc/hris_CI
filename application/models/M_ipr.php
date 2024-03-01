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

    public function ambilHasilForm($id, $angka)
    {
        $penilai = "penilai" . $angka;
        $this->db->select('*')
            ->from('tb_nilai_penilaian_karyawan')
            ->where('INT_ID_FORM', $id)
            ->like('TXT_INDIKATOR_NILAI_PENILAI', $penilai);
        $result = $this->db->get();

        return $result;
    }

    public function jumlahPenilai($id)
    {
        $this->db->select('INT_JUMLAH_PENILAI')
            ->from('tb_nilai_penilaian_karyawan')
            ->where('INT_ID_FORM', $id);

        $result = $this->db->get();

        return $result;
    }
}
