<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('Staylogin');
        $this->staylogin->check_and_extend_session();

        $this->load->model("m_ipr");
    }

    public function dataipr()
    {
        $data['title']  = "Data IPR";
        $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('monitoring/ipr', $data);
        $this->load->view('templates/footer');
    }

    public function get_ipr()
    {
        $data = array();
        $dataIpr = $this->db->get('tb_form_penilaian_karyawan');

        $no = 1;

        foreach ($dataIpr->result() as $row) {
            $sudah_menilai = 0;

            if ($row->TXT_SUDAH_MENILAI_1 == "0" || $row->TXT_SUDAH_MENILAI_1 == "-" || $row->TXT_SUDAH_MENILAI_1 == "AUTO") {
                $centang1 = "";
            } else {
                $centang1 = '<i class="fa fa-check text-navy"></i>' . $sudah_menilai += 1;
            }

            if ($row->TXT_SUDAH_MENILAI_2 == "0" || $row->TXT_SUDAH_MENILAI_2 == "-" || $row->TXT_SUDAH_MENILAI_2 == "AUTO") {
                $centang2 = "";
            } else {
                $centang2 = '<i class="fa fa-check text-navy"></i>' . $sudah_menilai += 1;
            }
            if ($row->TXT_SUDAH_MENILAI_3 == "0" || $row->TXT_SUDAH_MENILAI_3 == "-" || $row->TXT_SUDAH_MENILAI_3 == "AUTO") {
                $centang3 = "";
            } else {
                $centang3 = '<i class="fa fa-check text-navy"></i>' . $sudah_menilai += 1;
            }
            if ($row->TXT_SUDAH_MENILAI_4 == "0" || $row->TXT_SUDAH_MENILAI_4 == "-" || $row->TXT_SUDAH_MENILAI_4 == "AUTO") {
                $centang4="";
            } else {
                $centang4 = '<i class="fa fa-check text-navy"></i>' . $sudah_menilai += 1;
            }
            if ($row->TXT_SUDAH_MENILAI_5 == "0" || $row->TXT_SUDAH_MENILAI_5 == "-" || $row->TXT_SUDAH_MENILAI_5 == "AUTO") {
                $centang5="";
            } else {
                $centang5 = '<i class="fa fa-check text-navy"></i>' . $sudah_menilai += 1;
            }
            $data[] = array(
                'no'    => $no++,
                'nama'  => $row->TXT_NAMA_KARYAWAN,
                'penilai1'  => $row->TXT_PENILAI_1,
                'penilai2'  => $row->TXT_PENILAI_2,
                'penilai3'  => $row->TXT_PENILAI_3,
                'penilai4'  => $row->TXT_PENILAI_4,
                'penilai5'  => $row->TXT_PENILAI_5,
                'pdari'     => $row->DATE_DARI,
                'pakhir'    => $row->DATE_PERIODE,
                'progress'  => '<span class="pie">' . $sudah_menilai . "/" . $row->INT_JUMLAH_PENILAI . '</span>',
                'cek1'      => $centang1,
                'cek2'      => $centang2,
                'cek3'      => $centang3,
                'cek4'      => $centang4,
                'cek5'      => $centang5
            );
        }

        echo json_encode($data);
    }
}
