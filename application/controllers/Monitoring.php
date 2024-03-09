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
        $this->load->model("m_karyawan");
    }

    public function dataipr()
    {
        $data['title']  = "Data IPR";
        $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();

        $data['periode'] = $this->db->get_where('tb_periode', ['is_active' => '1']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('monitoring/ipr', $data);
        $this->load->view('templates/footer');
    }

    public function dataKar()
    {
        $katakunci = $this->input->post('cariNamaDevisi');
        $dataCari = $this->m_karyawan->cariNama($katakunci);

        $data = array();
        foreach ($dataCari->result() as $row) {
            $data[] = array(
                'id'    => $row->TXT_NAMA,
                'text' => $row->TXT_NAMA
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
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
                $centang4 = "";
            } else {
                $centang4 = '<i class="fa fa-check text-navy"></i>' . $sudah_menilai += 1;
            }
            if ($row->TXT_SUDAH_MENILAI_5 == "0" || $row->TXT_SUDAH_MENILAI_5 == "-" || $row->TXT_SUDAH_MENILAI_5 == "AUTO") {
                $centang5 = "";
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

    public function cekPenilai()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            show_404(); // Atau tindakan lain yang sesuai
        }

        $input      = json_decode(file_get_contents('php://input'), true);
        $response   = array();

        if (!isset($input['namaKar'])) {
            $response = array(
                'status'    => 'error',
                'message'   => 'Pastikan nama karyawan ada dalam request.'
            );
        } else {
            $namaKaryawan   = $input['namaKar'];

            $dataPenilai    = $this->db->get_where('tb_penilai', ['TXT_NAMA_KARYAWAN' => $namaKaryawan]);
            foreach ($dataPenilai->result() as $row) {
                $response[] = array(
                    'penilai1'  => $row->TXT_PENILAI_1,
                    'penilai2'  => $row->TXT_PENILAI_2,
                    'penilai3'  => $row->TXT_PENILAI_3,
                    'penilai4'  => $row->TXT_PENILAI_4,
                    'penilai5'  => $row->TXT_PENILAI_5
                );
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function cekPeriode()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            show_404(); // Atau tindakan lain yang sesuai
        }

        $input      = json_decode(file_get_contents('php://input'), true);
        $response   = array();
        if (!isset($input['id'])) {
            $response = array(
                'status'    => 'error',
                'message'   => 'Pastikan nama karyawan ada dalam request.'
            );
        } else {
            $idPeriode = $input['id'];

            $dataPeriode = $this->db->get_where('tb_periode', ['INT_ID' => $idPeriode]);
            foreach ($dataPeriode->result() as $row) {
                $response[] = array(
                    'awal'  => $row->DATE_DARI,
                    'akhir' => $row->DATE_SAMPAI
                );
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function formPenilaian_save()
    {
        $this->form_validation->set_rules('penilai-1', 'Penilai-1', 'trim|required');
        $this->form_validation->set_rules('penilai-2', 'Penilai-2', 'trim|required');
        $this->form_validation->set_rules('penilai-3', 'Penilai-3', 'trim|required');
        $this->form_validation->set_rules('nama-karyawan', 'Karyawan', 'trim|required');
        $this->form_validation->set_rules('dari', 'Periode awal', 'trim|required');
        $this->form_validation->set_rules('sampai', 'Periode akhir', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            # code...
            $penilai1s = $this->input->post('penilai-1');
            $penilai2s = $this->input->post('penilai-2');
            $penilai3s = $this->input->post('penilai-3');
            $penilai4s = $this->input->post('penilai-4');
            $penilai5s = $this->input->post('penilai-5');

            $jumlahPenilai = 0;

            // Memeriksa setiap input penilai
            if (isset($penilai1s) && $penilai1s !== '') {
                $jumlahPenilai++;
            }
            if (isset($penilai2s) && $penilai2s !== '') {
                $jumlahPenilai++;
            }
            if (isset($penilai3s) && $penilai3s !== '') {
                $jumlahPenilai++;
            }
            if (isset($penilai4s) && $penilai4s !== '') {
                $jumlahPenilai++;
            }
            if (isset($penilai5s) && $penilai5s !== '') {
                $jumlahPenilai++;
            }


            if ($this->input->post('penilai-1') == "") {
                $sudah_menilai_1 = "AUTO";
                $penilai1 = "-";
            } else {
                $sudah_menilai_1 = "0";
                $penilai1 = $this->input->post('penilai-1');
            }
            if ($this->input->post('penilai-2') == "") {
                $sudah_menilai_2 = "AUTO";
                $penilai2 = "-";
            } else {
                $sudah_menilai_2 = "0";
                $penilai2 = $this->input->post('penilai-2');
            }
            if ($this->input->post('penilai-3') == "") {
                $sudah_menilai_3 = "AUTO";
                $penilai3 = "-";
            } else {
                $sudah_menilai_3 = "0";
                $penilai3 = $this->input->post('penilai-3');
            }
            if ($this->input->post('penilai-4') == "") {
                $sudah_menilai_4 = "AUTO";
                $penilai4 = "-";
            } else {
                $sudah_menilai_4 = "0";
                $penilai4 = $this->input->post('penilai-4');
            }
            if ($this->input->post('penilai-5') == "") {
                $sudah_menilai_5 = "AUTO";
                $penilai5 = "-";
            } else {
                $sudah_menilai_5 = "0";
                $penilai5 = $this->input->post('penilai-5');
            }

            // echo $jumlahPenilai; die();

            $data = array(
                'TXT_NAMA_PEMBUAT' => $this->session->userdata('nama_lengkap'),
                'TXT_NAMA_KARYAWAN' => $this->input->post('nama-karyawan'),
                'TXT_PENILAI_1' => $penilai1,
                'TXT_PENILAI_2' => $penilai2,
                'TXT_PENILAI_3' => $penilai3,
                'TXT_PENILAI_4' => $penilai4,
                'TXT_PENILAI_5' => $penilai5,
                'INT_JUMLAH_PENILAI' => $jumlahPenilai,
                'TXT_SUDAH_MENILAI_1' => $sudah_menilai_1,
                'TXT_SUDAH_MENILAI_2' => $sudah_menilai_2,
                'TXT_SUDAH_MENILAI_3' => $sudah_menilai_3,
                'TXT_SUDAH_MENILAI_4' => $sudah_menilai_4,
                'TXT_SUDAH_MENILAI_5' => $sudah_menilai_5,
                'DATE_PERIODE' => $this->input->post('sampai'),
                'DATE_DARI' => $this->input->post('dari'),
                'id_periode'    => $this->input->post('periode_select')
            );

            $this->db->insert('tb_form_penilaian_karyawan', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Penilai untuk karyawan ' . $this->input->post('nama-karyawan') . ' telah dibuat!</div>');
            redirect('monitoring/dataipr');
        } else {
            # code...
            redirect('monitoring/dataipr');
        }
    }

    private function _urutanPeriode()
    {
        $this->load->model("m_ipr");
        $durt = $this->m_ipr->getUrutanPeriode();

        foreach ($durt->result() as $row) {
            $urutan = $row->idArr;
            $urutan = (int)$urutan + 1;
            $user_id = "PR" . date('ym') . "-" . sprintf("%04s", $urutan);
        }

        return $user_id;
    }

    public function newPeriod()
    {
        
        $this->form_validation->set_rules('jenis_periode', 'Nama Periode', 'trim|required|min_length[12]', [
            'min_length'    => "Nama periode terlalu pendek"
        ]);
        
        $this->form_validation->set_rules('dari_set', 'Awal Periode', 'trim|required');
        $this->form_validation->set_rules('sampai_set', 'Akhir Periode', 'trim|required');
        
        
        if ($this->form_validation->run() == TRUE) {
            # code...
            $namaPeriode    = $this->input->post('jenis_periode');
            $dari           = date("Y-m-d",strtotime($this->input->post('dari_set')));
            $sampai         = date("Y-m-d",strtotime($this->input->post('sampai_set')));
            // var_dump($sampai);

            $data = [
                'INT_ID'    => $this->_urutanPeriode(),
                'TXT_JENIS' => $namaPeriode,
                'DATE_DARI' => $dari,
                'DATE_SAMPAI'   => $sampai
            ];

            $this->db->insert('tb_periode', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Periode baru telah dibuat!</div>');
            redirect('monitoring/dataipr');

        } else {
            # code...
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Periode baru yang telah dibuat!</div>');
            redirect('monitoring/dataipr');
        }
        
    }

    public function periodeAction()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            show_404(); // Atau tindakan lain yang sesuai
        }

        $input  = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['id']) && !isset($input['action'])) {
            $response = array(
                'status'    => 'error',
                'message'   => 'Pastikan ID dan Action ada dalam request.'
            );
        } else {
            if ($input['action'] == 'redup') {
                $this->db->where('INT_ID', $input['id']);
                $this->db->set('is_active', '0');
                if ($this->db->update('tb_periode')) {
                    $response = array(
                        'status'    => 'success',
                        'message'   => 'Periode ini sudah dinonaktifkan.'
                    );
                } else {
                    $response = array(
                        'status'    => 'error',
                        'message'   => 'Kesalahan pada system, hubungi IT.'
                    );
                }
            } elseif ($input['action'] == 'menyala') {
                $username = $this->session->userdata('username');
                $cekAuth = $this->db->get_where('tb_user', ['username' => $username])->row_array();

                if (password_verify($input['pass'], $cekAuth['password'])) {

                    $this->db->where('INT_ID', $input['id']);
                    $this->db->set('is_active', '1');
                    if ($this->db->update('tb_periode')) {
                        $response = array(
                            'status'    => 'success',
                            'message'   => 'Periode ini sudah diaktifkan kembali.'
                        );
                    } else {
                        $response = array(
                            'status'    => 'error',
                            'message'   => 'Kesalahan pada system, hubungi IT.'
                        );
                    }
                } else {
                    $response = array(
                        'status'    => 'error',
                        'message'   => 'Salah password, anda tidak punya akses!.'
                    );
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function ambilPeriode()
    {
        $data = array();

        $this->db->order_by('DATE_DARI', "DESC");
        $dataPeriode = $this->db->get('tb_periode');

        foreach ($dataPeriode->result() as $row) {
            if ($row->is_active == '1') {
                $status = '<span class="label label-info">Aktif</span>';
            } else {
                $status = '<span class="label label-warning">Non-aktif</span>';
            }
            $data[] = array(
                'id'    => $row->INT_ID,
                'nama'  => $row->TXT_JENIS,
                'awal'  => $row->DATE_DARI,
                'akhir' => $row->DATE_SAMPAI,
                'status' => $status,
                'active' => $row->is_active
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function setPenilai()
    {
        
        $this->form_validation->set_rules('karyawan-set', 'Nama Karyawan', 'trim|required');
        $this->form_validation->set_rules('penilai1-set', 'Penilai - 1', 'trim|required');
        $this->form_validation->set_rules('penilai2-set', 'Penilai - 2', 'trim|required');
        $this->form_validation->set_rules('penilai3-set', 'Penilai - 3', 'trim|required');
        
        if ($this->form_validation->run() == TRUE ) {
            # code...
            $karyawan = $this->input->post('karyawan-set');
            $penilai1 = $this->input->post('penilai1-set');
            $penilai2 = $this->input->post('penilai2-set');
            $penilai3 = $this->input->post('penilai3-set');
            $penilai4 = $this->input->post('penilai4-set');
            $penilai5 = $this->input->post('penilai5-set');

            $data = [
                'TXT_NAMA_KARYAWAN';
            ];
        } 
        
    }
}
