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
        error_reporting(0);
        $data = array();
        $user = $this->session->userdata('nama_lengkap');
        $myData   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $function_name = __FUNCTION__;

        $forb = $this->db->get_where('tb_akses_menu', ['divisi' => $myData['TXT_DIVISI'], 'menu' => $function_name])->row_array();


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
            } else {
                $style = '';
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
                $button1 = '<button class="btn btn-xs btn-primary mt-1 view" data-toggle="modal" data-user="' . $pencocokan_penilai . '" data-penilai="' . $status_penilai . '" data-komen-penilai="' . $komen_penilai . '" data-id="' . $row->INT_ID_FORM . '" style="min-width:50px;' . $style . '">Nilai</button>';
            } else {
                $button1 = "";
            }
            if ($row->TXT_SUDAH_MENILAI_1 == "0" || $row->TXT_SUDAH_MENILAI_2 == "0" || $row->TXT_SUDAH_MENILAI_3 == "0" || $row->TXT_SUDAH_MENILAI_4 == "0" || $row->TXT_SUDAH_MENILAI_5 == "0") {
                if ($user == $row->TXT_SUDAH_MENILAI_1) {
                    $button2 = '<button style="min-width:50px;" data-penilai="' . $status_penilai . '" data-komen-penilai="' . $komen_penilai . '" data-user="' . $pencocokan_penilai . '" data-id="' . $row->INT_ID_FORM . '" class="btn btn-xs btn-default edit">Edit </button>';
                } else {
                    $button2 = "";
                }
                if ($user == $row->TXT_SUDAH_MENILAI_2) {
                    $button2 = '<button style="min-width:50px;" data-penilai="' . $status_penilai . '>" data-komen-penilai="' . $komen_penilai . '" data-user="' . $pencocokan_penilai . '" data-id="' . $row->INT_ID_FORM . '" class="btn  btn-xs btn-default edit">Edit </button>';
                } else {
                    $button2 = "";
                }
                if ($user == $row->TXT_SUDAH_MENILAI_3) {
                    $button2 = '<button style="min-width:50px;" data-penilai="' .  $status_penilai  . '" data-komen-penilai="' . $komen_penilai  . '" data-user="' .  $pencocokan_penilai  . '" data-id="' .  $row->INT_ID_FORM  . '" class="btn btn-xs btn-default edit">Edit </button>';
                } else {
                    $button2 = "";
                }
                if ($user == $row->TXT_SUDAH_MENILAI_4) {
                    $button2 = '<button style="min-width:50px;" data-penilai="' .  $status_penilai  . '" data-komen-penilai="' . $komen_penilai  . '" data-user="' .  $pencocokan_penilai  . '" data-id="' .  $row->INT_ID_FORM  . '" class="btn btn-xs btn-default edit">Edit </button>';
                } else {
                    $button2 = "";
                }
                if ($user == $row->TXT_SUDAH_MENILAI_5) {
                    $button2 = '<button style="min-width:50px;" data-penilai="' .  $status_penilai  . '" data-komen-penilai="' . $komen_penilai . '" data-user="' .  $pencocokan_penilai  . '" data-id="' .  $row->INT_ID_FORM  . '" class="btn btn-xs btn-default edit">Edit </button>';
                } else {
                    $button2 = "";
                }
            }

            if ($user == $row->TXT_NAMA_PEMBUAT) {
                $button3 = '<button style="min-width:50px;" class="btn btn-xs btn-danger mt-1 hapus" data-id="' . $row->INT_ID_FORM . '"><i class="fa fa-trash"></i></button>';
            }

            if ($row->TXT_SUDAH_MENILAI_1 != "0" && $row->TXT_SUDAH_MENILAI_2 != "0" && $row->TXT_SUDAH_MENILAI_3 != "0" && $row->TXT_SUDAH_MENILAI_4 != "0" && $forb['forbiden_status'] == '1') {
                $button4 = '<button style="min-width:50px;" class="printPdf btn btn-default btn-xs mt-1" data-idform="' . $row->INT_ID_FORM . '" data-name="' . $row->TXT_NAMA_KARYAWAN . '"><i class="fa fa-file-pdf-o fa-1x"></i></button>
                <button style="min-width:50px;" class="lihat btn btn-warning btn-xs mt-1" data-idform="' . $row->INT_ID_FORM . '" data-name="' . $row->TXT_NAMA_KARYAWAN . '"><i class="fa fa-eye fa-1x"></i></button>
                <button style="min-width:50px;" class="toExel btn btn-primary btn-xs mt-1" data-idform="' . $row->INT_ID_FORM . '" data-name="' . $row->TXT_NAMA_KARYAWAN . '"><i class="fa fa-file-excel-o fa-1x"></i></button>';
                if ($forb['forbiden_status'] == '1') {
                    $button4 .= '<button  style="min-width:50px;" data-id="' . $row->INT_ID_FORM . '" data-karyawan="' . $row->TXT_NAMA_KARYAWAN . '" class="btn btn-success btn-xs mt-1 kirim_nilai">Kirim</button>';
                }
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
                'buttons'   => $button1 . $button2 . $button3 . $button4,
                'periods'   => $row->DATE_DARI . " s/d " . $row->DATE_PERIODE
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function downloadIpr()
    {

        $id = $this->input->get('id');
        $namaKaryawan = $this->input->get('nama');



        $data['hasil1']     = $this->m_ipr->ambilHasilForm($id, '1');
        $data['hasil2']     = $this->m_ipr->ambilHasilForm($id, '2');
        $data['hasil3']     = $this->m_ipr->ambilHasilForm($id, '3');
        $data['hasil4']     = $this->m_ipr->ambilHasilForm($id, '4');
        $data['hasil5']     = $this->m_ipr->ambilHasilForm($id, '5');
        $data['soal']       = $this->db->get('tb_indikator_penilaian_karyawan');
        $data['jumlah_penilai'] = $this->m_ipr->jumlahPenilai($id)->result();
        $data['perbaikan1'] = $this->m_ipr->ambilKomen($id, 'perbaikan', 'komen-1');
        $data['perbaikan2'] = $this->m_ipr->ambilKomen($id, 'perbaikan', 'komen-2');
        $data['perbaikan3'] = $this->m_ipr->ambilKomen($id, 'perbaikan', 'komen-3');
        $data['perbaikan4'] = $this->m_ipr->ambilKomen($id, 'perbaikan', 'komen-4');
        $data['perbaikan5'] = $this->m_ipr->ambilKomen($id, 'perbaikan', 'komen-5');
        $this->load->library("pdf");

        $this->pdf->setPaper('A4', 'potrai');
        $this->pdf->filename = $namaKaryawan . ".pdf";
        // $this->pdf->load_view('performance/iprDonwload', $data);
        $this->load->view('performance/iprDonwload', $data);
    }
}
