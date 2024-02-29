<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Performance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('Staylogin');
        $this->staylogin->check_and_extend_session();

        $this->load->model("m_ipr");
    }

    public function ipr()
    {
        $data['title']  = "IPR";
        $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('performance/ipr', $data);
        $this->load->view('templates/footer');
    }

    public function ambilDataIpr()
    {
        $data = array();
        $user = $this->session->userdata('nama_lengkap');

        $ambilDataIprs = $this->m_ipr->get_ipr_data($user);

        foreach ($ambilDataIprs->result() as $row) {
            if ($row->TXT_SUDAH_MENILAI_1 !== "0" && $row->TXT_SUDAH_MENILAI_2 !== "0" && $row->TXT_SUDAH_MENILAI_3 !== "0" && $row->TXT_SUDAH_MENILAI_4 !== "0" && $row->TXT_SUDAH_MENILAI_5 !== "0") {
                $status = '<span class="label label-success ">Selesai</span>';
            } else {
                $status = '<span class="label label-warning ">On Progress</span>';
            }

            if ($user == $row->TXT_SUDAH_MENILAI_1) {
                $style = "display:none;";
            } else if ($user == $row->TXT_SUDAH_MENILAI_2) {
                $style = "display:none;";
            } else if ($user == $row->TXT_SUDAH_MENILAI_3) {
                $style = "display:none;";
            } else if ($user == $row->TXT_SUDAH_MENILAI_4) {
                $style = "display:none;";
            } else if ($row->TXT_SUDAH_MENILAI_1 != "0" && $row->TXT_SUDAH_MENILAI_2 != "0" && $row->TXT_SUDAH_MENILAI_3 != "0" && $row->TXT_SUDAH_MENILAI_4 != "0") {
            } else if ($user == $row->TXT_SUDAH_MENILAI_5) {
                $style = "display:none;";
            } else if ($row->TXT_SUDAH_MENILAI_1 != "0" && $row->TXT_SUDAH_MENILAI_2 != "0" && $row->TXT_SUDAH_MENILAI_3 != "0" && $row->TXT_SUDAH_MENILAI_4 != "0") {
                // apabila nilai sudah diisi semua
                $style = "display:none;";
            }

            $pencocokan_penilai = "";
            $status_penilai = "";
            $komen_penilai = "";
            if ($row->TXT_PENILAI_1 == $user) {
                $pencocokan_penilai = "penilai1";
                $status_penilai = "TXT_SUDAH_MENILAI_1";
                $komen_penilai = "komen-1";
            }
            if ($row->TXT_PENILAI_2 == $user) {
                $status_penilai = "TXT_SUDAH_MENILAI_2";
                $pencocokan_penilai = "penilai2";
                $komen_penilai = "komen-2";
            }
            if ($row->TXT_PENILAI_3 == $user) {
                $pencocokan_penilai = "penilai3";
                $status_penilai = "TXT_SUDAH_MENILAI_3";
                $komen_penilai = "komen-3";
            }
            if ($row->TXT_PENILAI_4 == $user) {
                $pencocokan_penilai = "penilai4";
                $status_penilai = "TXT_SUDAH_MENILAI_4";
                $komen_penilai = "komen-4";
            }
            if ($row->TXT_PENILAI_5 == $user) {
                $pencocokan_penilai = "penilai5";
                $status_penilai = "TXT_SUDAH_MENILAI_5";
                $komen_penilai = "komen-5";
            }
            if ($pencocokan_penilai != '') {
                $button = '<button class="btn btn-sm btn-primary mt-1 view" data-toggle="modal" data-user="' . $pencocokan_penilai . '" data-penilai="' . $status_penilai . '" data-komen-penilai="' . $komen_penilai . '" data-id="' . $row->INT_ID_FORM . '" style="min-width:50px;' . $style . '">Nilai</button>';
            } else {
                $button = "";
            }



            $data[] = array(
                'id'        => $row->INT_ID_FORM,
                'nama_pembuat'  => $row->TXT_NAMA_PEMBUAT,
                'nama_karyawan' => $row->TXT_NAMA_KARYAWAN,
                'penilai1'      => $row->TXT_PENILAI_1,
                'penilai2'      => $row->TXT_PENILAI_2,
                'penilai3'      => $row->TXT_PENILAI_3,
                'penilai4'      => $row->TXT_PENILAI_4,
                'penilai5'      => $row->TXT_PENILAI_5,
                'sudah_menilai1'    => $row->TXT_SUDAH_MENILAI_1,
                'sudah_menilai2'    => $row->TXT_SUDAH_MENILAI_2,
                'sudah_menilai3'    => $row->TXT_SUDAH_MENILAI_3,
                'sudah_menilai4'    => $row->TXT_SUDAH_MENILAI_4,
                'sudah_menilai5'    => $row->TXT_SUDAH_MENILAI_5,
                'periode'        => $row->DATE_PERIODE,
                'date_dari'      => $row->DATE_DARI,
                'jumlah_penilai'    => $row->INT_JUMLAH_PENILAI,
                'status'    => $status,
                'buttons'   => $button
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
