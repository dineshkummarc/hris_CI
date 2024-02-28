<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Interview extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('Staylogin');
        $this->staylogin->check_and_extend_session();
    }

    public function hasil()
    {
        $data['title']      = "Hasil Rekap";
        $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('interview/hasilRekap', $data);
        $this->load->view('templates/footer');
    }

    private function _namaHrd($idhrd)
    {
        $row    = $this->db->get_where('tb_user', ['user_id' => $idhrd])->row_array();

        return $row['TXT_NAMA'];
    }

    private function _urutanIDuser()
    {
        $this->load->model("m_karyawan");
        $durt = $this->m_karyawan->getUrutanPelamar();

        foreach ($durt->result() as $row) {
            $urutan = $row->idArr;
            $urutan = (int)$urutan + 1;
            $user_id = "PL" . date('ymd') . "-" . sprintf("%04s", $urutan);
        }

        return $user_id;
    }

    function datarhi()
    {
        $no = 1;
        $this->db->order_by('tgl_interview', 'DESC');
        $arrdat     = $this->db->get('tb_pelamar');
        $data       = array();

        foreach ($arrdat->result() as $row) {
            if ($row->hasil_intervie == '0') {
                $hasil = "<span class='label label-danger'>Ditolak</span>";
            } elseif ($row->hasil_intervie == '1') {
                $hasil = "<span class='label label-success'>Diterima</span>";
            } elseif ($row->hasil_intervie == '2') {
                $hasil = "<span class='label label-warning'>Dipertimbangkan</span>";
            }
            $tahun_p_1 = "";
            $tahun_p_2 = "";
            $tahun_p_3 = "";
            $tahun_p_4 = "";
            $tahun_p_5 = "";
            $tahun_p_6 = "";

            if (strpos($row->pengalaman_kerja1, "|") !== false) {
                $tahun_p_1  = explode("|", $row->pengalaman_kerja1)[0];
                $posisi_p_1 = explode("|", $row->pengalaman_kerja1)[1];
                $bidang_p_1 = explode("|", $row->pengalaman_kerja1)[2];
            }

            if (strpos($row->pengalaman_kerja2, "|") !== false) {
                $tahun_p_2 = explode("|", $row->pengalaman_kerja2)[0];
                $posisi_p_2 = explode("|", $row->pengalaman_kerja2)[1];
                $bidang_p_2 = explode("|", $row->pengalaman_kerja2)[2];
            }
            if (strpos($row->pengalaman_kerja3, "|") !== false) {
                $tahun_p_3 = explode("|", $row->pengalaman_kerja3)[0];
                $posisi_p_3 = explode("|", $row->pengalaman_kerja3)[1];
                $bidang_p_3 = explode("|", $row->pengalaman_kerja3)[2];
            }
            if (strpos($row->pengalaman_kerja4, "|") !== false) {
                $tahun_p_4 = explode("|", $row->pengalaman_kerja4)[0];
                $posisi_p_4 = explode("|", $row->pengalaman_kerja4)[1];
                $bidang_p_4 = explode("|", $row->pengalaman_kerja4)[2];
            }
            if (strpos($row->pengalaman_kerja5, "|") !== false) {
                $tahun_p_5 = explode("|", $row->pengalaman_kerja5)[0];
                $posisi_p_5 = explode("|", $row->pengalaman_kerja5)[1];
                $bidang_p_5 = explode("|", $row->pengalaman_kerja5)[2];
            }
            if (strpos($row->pengalaman_kerja6, "|") !== false) {
                $tahun_p_6 = explode("|", $row->pengalaman_kerja6)[0];
                $posisi_p_6 = explode("|", $row->pengalaman_kerja6)[1];
                $bidang_p_6 = explode("|", $row->pengalaman_kerja6)[2];
            }

            $ke_vaksin = explode("|", $row->vaksin)[0];
            $nama_vaksin = explode("|", $row->vaksin)[1];
            $data[] = array(
                'no'    => $no++,
                'id'    => $row->id_pelamar,
                'nama'  => $row->nama_pelamar,
                'tglinterview'  => $row->tgl_interview,
                'posisi'        => $row->posisi_yangdilamar,
                'usia'          => $row->usia_pelamar,
                'pendidikan'    => $row->pendidikan_terahir,
                'fakultas'      => $row->fakultas_pelamar,
                'jurusan'       => $row->jurusan_pelamar,
                'namaskolah'    => $row->nama_sekolah,
                'PengalamanKerja_1'   => ($tahun_p_1 == "") ? "" : $tahun_p_1 . " Tahun, " . $posisi_p_1 . ", " . $bidang_p_1,
                'PengalamanKerja_2'   => ($tahun_p_2 == "") ? "" : $tahun_p_2 . " Tahun, " . $posisi_p_2 . ", " . $bidang_p_2,
                'PengalamanKerja_3'   => ($tahun_p_3 == "") ? "" : $tahun_p_3 . " Tahun, " . $posisi_p_3 . ", " . $bidang_p_3,
                'PengalamanKerja_4'   => ($tahun_p_4 == "") ? "" : $tahun_p_4 . " Tahun, " . $posisi_p_4 . ", " . $bidang_p_4,
                'PengalamanKerja_5'   => ($tahun_p_5 == "") ? "" : $tahun_p_5 . " Tahun, " . $posisi_p_5 . ", " . $bidang_p_5,
                'PengalamanKerja_6'   => ($tahun_p_6 == "") ? "" : $tahun_p_6 . " Tahun, " . $posisi_p_6 . ", " . $bidang_p_6,
                'kekurangan'    => $row->kekurangan_pelamar,
                'kelebihan'     => $row->kelebihan_pelamar,
                'vaksin'        => $ke_vaksin . ", vaksin: " . $nama_vaksin,
                'hasil'         => $hasil,
                'alasan'        => $row->alasan_hasil,
                'HRD'       => $this->_namaHrd($row->input_by)
            );
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function add()
    {
        
        $this->form_validation->set_rules('tanggal', 'Tanggal Interview', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama Pelamar', 'trim|required');
        $this->form_validation->set_rules('posisi', 'Posisi yang dilamar', 'trim|required');
        $this->form_validation->set_rules('usia', 'Usia', 'trim|required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan terahir', 'trim|required');
        $this->form_validation->set_rules('fakultas', 'Fakultas', 'trim|required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required');
        $this->form_validation->set_rules('sekolah', 'Sekolah', 'trim|required');
        $this->form_validation->set_rules('alasan', 'Alasan', 'trim|required');
        $this->form_validation->set_rules('rekomendasi', 'Rekomendasi', 'trim|required');
        $this->form_validation->set_rules('salary', 'Permohonan Salary', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $data['title']      = "Tambah Data";
            $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
            $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/headbar', $data);
            $this->load->view('interview/tambahData', $data);
            $this->load->view('templates/footer');
        } else {
            # code...
            $data = [
                'id_pelamar'        => $this->_urutanIDuser(),
                'nama_pelamar'      => $this->input->post('nama'),
                'posisi_yangdilamar'    => $this->input->post('posisi'),
                'usia_pelamar'          => $this->input->post('usia'),
                'pendidikan_terahir'    => $this->input->post('pendidikan'),
                'fakultas_pelamar'      => $this->input->post('fakultas'),
                'jurusan_pelamar'       => $this->input->post('jurusan'),
                'nama_sekolah'        => $this->input->post('sekolah'),
                'tgl_interview'       => $this->input->post('tanggal'),
                'pengalaman_kerja1'       => $this->input->post('tahun_pengalaman_1') . "|" . $this->input->post('jabatan_pengalaman_1') . "|" . $this->input->post('perusahaan_pengalaman_1'),
                'pengalaman_kerja2'       => $this->input->post('tahun_pengalaman_2') . "|" . $this->input->post('jabatan_pengalaman_2') . "|" . $this->input->post('perusahaan_pengalaman_2'),
                'pengalaman_kerja3'       => $this->input->post('tahun_pengalaman_3') . "|" . $this->input->post('jabatan_pengalaman_3') . "|" . $this->input->post('perusahaan_pengalaman_3'),
                'pengalaman_kerja4'       => $this->input->post('tahun_pengalaman_4') . "|" . $this->input->post('jabatan_pengalaman_4') . "|" . $this->input->post('perusahaan_pengalaman_4'),
                'pengalaman_kerja5'       => $this->input->post('tahun_pengalaman_5') . "|" . $this->input->post('jabatan_pengalaman_5') . "|" . $this->input->post('perusahaan_pengalaman_5'),
                'pengalaman_kerja6'       => $this->input->post('tahun_pengalaman_6') . "|" . $this->input->post('jabatan_pengalaman_6') . "|" . $this->input->post('perusahaan_pengalaman_6'),
                'kekurangan_pelamar'      => $this->input->post('kekurangan'),
                'kelebihan_pelamar'       => $this->input->post('kelebihan'),
                'vaksin'        => $this->input->post('jenis_vaksin') . "|" . $this->input->post('nama_vaksin'),
                'req_salary'        => $this->input->post('salary'),
                'hasil_intervie'    => $this->input->post('rekomendasi'),
                'alasan_hasil'      => $this->input->post('alasan'),
                'input_by'      => $this->input->post('uid')
            ];

            if ($this->db->insert('tb_pelamar', $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pelamar ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal input data pelamar!</div>');
                redirect('datakaryawan/aktif');
            }
        }
    }
}
