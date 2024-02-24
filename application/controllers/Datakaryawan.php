<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datakaryawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('Staylogin');
        $this->staylogin->check_and_extend_session();
        // header('Content-Type: application/json');
    }

    private function _urutanIDuser()
    {
        $this->load->model("m_karyawan");
        $durt = $this->m_karyawan->getUrutan();

        foreach ($durt->result() as $row) {
            $urutan = $row->idArr;
            $urutan = (int)$urutan + 1;
            $user_id = "MK-" . date('ymd') . "-" . sprintf("%04s", $urutan);
        }

        return $user_id;
    }

    public function aktif()
    {

        $this->form_validation->set_rules('nama-tambah', 'Nama Karyawan', 'trim|required');
        $this->form_validation->set_rules('telepon-tambah', 'Telp Karyawan', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('id-karyawan-tambah', 'No Absensi', 'trim|required');
        $this->form_validation->set_rules('accl', 'Access Level', 'trim|required');
        $this->form_validation->set_rules('divisi-tambah', 'Divisi', 'trim|required');
        $this->form_validation->set_rules('status-tambah', 'Status', 'trim|required');
        $this->form_validation->set_rules('alamat-tambah', 'Alamat Karyawan', 'trim|required');
        $this->form_validation->set_rules('tempat-lahir-tambah', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('agama-tambah', 'Agama', 'trim|required');
        $this->form_validation->set_rules('email-tambah', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('tglmasuk', 'Tanggal Masuk kerja', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tb_user.username]', [
            'is_unique' => "Username ini sudah ada, mohon berikan username yang berbeda"
        ]);

        if ($this->form_validation->run() == FALSE) {
            # code...
            $data['title']  = "Karyawan Aktif";
            $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
            $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();
            $data['divisi'] = $this->db->get('tb_divisi');
            $data['role']   = $this->db->get('user_role');
            $data['trar']   = $this->db->get('role_access_rights');

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/headbar', $data);
            $this->load->view('datakaryawan/karyawan-aktif', $data);
            $this->load->view('templates/footer');
        } else {
            # code...
            $file_name  = $_FILES['photo-tambah']['name'];
            $ext        = "." . explode(".", $file_name)[1];
            $newName    = $this->_urutanIDuser() . $ext;

            $config['upload_path']          = './uploads/images/';
            $config['allowed_types']        = 'jpg|jpeg|png|JPG|JPEG|PNG';
            $config['file_name']            = $newName;
            $config['overwrite']            = true;
            $config['max_size']             = 5120;
            $config['max_width']            = 3000;
            $config['max_height']           = 3000;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photo-tambah')) {
                $data = array(
                    'user_id'                       => $this->_urutanIDuser(),
                    'username'                      => $this->input->post('username'),
                    'absen_id'                      => $this->input->post('id-karyawan-tambah'),
                    'password'                      => password_hash("garuda75", PASSWORD_DEFAULT),
                    // 'TXT_KONTRAK_PERCOBAAN'         => $this->input->post('kontrak-percobaan-awal-tambah') . " || " . $this->input->post('kontrak-percobaan-akhir-tambah'),
                    // 'TXT_KONTRAK_1'                 => $this->input->post('kontrak-1-awal-tambah') . " || " . $this->input->post('kontrak-1-akhir-tambah'),
                    // 'TXT_KONTRAK_2'                 => $this->input->post('kontrak-2-awal-tambah') . " || " . $this->input->post('kontrak-2-akhir-tambah'),
                    // 'TXT_KONTRAK_3'                 => $this->input->post('kontrak-3-awal-tambah') . " || " . $this->input->post('kontrak-3-akhir-tambah'),
                    // 'TXT_KONTRAK_4'                 => $this->input->post('kontrak-4-awal-tambah') . " || " . $this->input->post('kontrak-4-akhir-tambah'),
                    // 'TXT_KONTRAK_5'                 => $this->input->post('kontrak-5-awal-tambah') . " || " . $this->input->post('kontrak-5-akhir-tambah'),
                    'TXT_DIVISI'                    => $this->input->post('divisi-tambah'),
                    'TXT_NAMA'                      => $this->input->post('nama-tambah'),
                    'TXT_ALAMAT'                    => $this->input->post('alamat-tambah'),
                    'TXT_TELEPON'                   => $this->input->post('telepon-tambah'),
                    'TXT_KELAMIN'                   => $this->input->post('kelamin-tambah'),
                    'TXT_STATUS'                    => $this->input->post('status-tambah'),
                    'TXT_AGAMA'                     => $this->input->post('agama-tambah'),
                    'TXT_KEBANGSAAN'                => $this->input->post('kebangsaan-tambah'),
                    'TXT_HOBBY'                     => $this->input->post('hobby-tambah'),
                    'DATE_TANGGAL_LAHIR'            => $this->input->post('tanggal-lahir-tambah'),
                    'TXT_TEMPAT_LAHIR'              => $this->input->post('tempat-lahir-tambah'),
                    'TXT_NAMA_KERABAT'              => $this->input->post('kerabat-tambah'),
                    'TXT_ALAMAT_TELP_KRBT'          => $this->input->post('alamat-telp-kerabat-tambah'),
                    'TXT_HUBUNGAN_KRBT'             => $this->input->post('hubungan-kerabat-tambah'),
                    'TXT_NAMA_SUAMI_ISTRI'          => $this->input->post('nama-suami-istri-tambah'),
                    'DATE_TANGGAL_LAHIR_SUAMI_ISTRI'             => $this->input->post('nama-suami-istri-tambah'),
                    'TXT_TEMPAT_LAHIR_SUAMI_ISTRI'               => $this->input->post('tempat-lahir-suami-istri-tambah'),
                    'TXT_PEKERJAAN_SUAMI_ISTRI'                  => $this->input->post('pekerjaan-suami-istri-tambah'),
                    'TXT_NAMA_ALAMAT_PEKERJAAN_SUAMI_ISTRI'      => $this->input->post('alamat-pekerjaan-suami-istri-tambah'),
                    'TXT_TELEPON_SUAMI_ISTRI'                    => $this->input->post('telepon-suami-istri-tambah'),
                    'TXT_NAMA_ANAK_1'                            => $this->input->post('anak-1-tambah'),
                    'TXT_NAMA_ANAK_2'                            => $this->input->post('anak-2-tambah'),
                    'TXT_NAMA_ANAK_3'                            => $this->input->post('anak-3-tambah'),
                    'TXT_NAMA_ANAK_4'                            => $this->input->post('anak-4-tambah'),
                    'TXT_NAMA_ANAK_5'                            => $this->input->post('anak-5-tambah'),
                    'TXT_EMAIL'                                  => $this->input->post('email-tambah'),
                    'TXT_NIK'                                    => $this->input->post('nik-tambah'),
                    'TXT_NPWP'                                   => $this->input->post('npwp-tambah'),
                    'TXT_PHOTO'                                  => $newName,
                    'role_id'                                    => $this->input->post('role'),
                    'rar_id'                                     => $this->input->post('accl')
                );

                $this->db->insert('tb_user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User baru ditambahkan!</div>');
                redirect('datakaryawan/aktif');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('datakaryawan/aktif');
            }
            // $image = $_FILES['photo-tambah']['name'];
        }
    }

    public function nonaktif()
    {
        $data['title']  = "Karyawan Nonaktif";
        $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();
        $data['nonaktif']   = $this->db->get_where('tb_user', ['is_active' => '0'])->result_array();

        $config['base_url']     = base_url('datakaryawan/nonaktif');
        $config['total_rows']   = count($data['nonaktif']);
        $config['per_page']     = 15;
        $config['num_links']    = 1;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open']    = '<nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['attributes']   = array('class' => 'page-link');
        $config['first_link']   = 'First';
        $config['last_link']    = 'Last';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $config['next_link']    = '&raquo;';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['prev_link']    = '&laquo;';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);
        $start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

        $data['nonaktif'] = array_slice($data['nonaktif'], $start, $config['per_page']);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('datakaryawan/karyawan-nonaktif', $data);
        $this->load->view('templates/footer');
    }

    private function _cekNumber($string)
    {

        $isThereNumber = false;
        for ($i = 0; $i < strlen($string); $i++) {
            if (ctype_digit($string[$i])) {
                $isThereNumber = true;
                break;
            }
        }
        return $isThereNumber;
    }

    public function ambilAktif()
    {
        $ambilData = $this->db->get_where('tb_user', ['is_active' => '1']);

        $data = array();

        foreach ($ambilData->result() as $row) {
            // echo $row->TXT_NAM

            if ($this->_cekNumber($row->TXT_KONTRAK_PERCOBAAN) == true) {
                // cek apabil tanggal kontrak sudah ada dan membaginya menkadi awal dan akhir lalu menghitung jarak nya
                $kumpulan_tanggal_percobaan = explode("||", $row->TXT_KONTRAK_PERCOBAAN);
                $awal_percobaan = $kumpulan_tanggal_percobaan[0];
                $akhir_percobaan = $kumpulan_tanggal_percobaan[1];
                $start_date_percobaan = strtotime(date("Y-m-d"));
                $end_date_percobaan = strtotime($akhir_percobaan);
                $hasil_jarak_tanggal_percobaan = ($end_date_percobaan - $start_date_percobaan) / 60 / 60 / 24;
                if ($hasil_jarak_tanggal_percobaan >= 0 && $hasil_jarak_tanggal_percobaan <= 30) {
                    $statusPercobaan = "<span id='bahaya' class='label m-1'>(MPH)</span>";
                } else if ($hasil_jarak_tanggal_percobaan < 0) {
                    $statusPercobaan = "<span id='lewat' class='label m-1'>(MPL)</span>";
                }
            } else {
                $statusPercobaan = "";
            }

            if ($this->_cekNumber($row->TXT_KONTRAK_1) == true) {
                // cek apabil tanggal kontrak sudah ada dan membaginya menkadi awal dan akhir lalu menghitung jarak nya
                $kumpulan_tanggal_Kontrak_1 = explode("||", $row->TXT_KONTRAK_1);
                $awal_Kontrak_1 = $kumpulan_tanggal_Kontrak_1[0];
                $akhir_Kontrak_1 = $kumpulan_tanggal_Kontrak_1[1];
                $start_date_Kontrak_1 = strtotime(date("Y-m-d"));
                $end_date_Kontrak_1 = strtotime($akhir_Kontrak_1);
                $hasil_jarak_tanggal_Kontrak_1 = ($end_date_Kontrak_1 - $start_date_Kontrak_1) / 60 / 60 / 24;
                if ($hasil_jarak_tanggal_Kontrak_1 >= 0 && $hasil_jarak_tanggal_Kontrak_1 <= 30) {
                    $statusKontrak1 = "<span id='bahaya' class='label m-1'>(K1H)</span>";
                } else if ($hasil_jarak_tanggal_Kontrak_1 < 0) {
                    $statusKontrak1 = "<span id='lewat' class='label m-1'>(K1L)</span>";
                }
            } else {
                $statusKontrak1 = "";
            }

            if ($this->_cekNumber($row->TXT_KONTRAK_2) == true) {
                // cek apabil tanggal kontrak sudah ada dan membaginya menkadi awal dan akhir lalu menghitung jarak nya
                $kumpulan_tanggal_Kontrak_2 = explode("||", $row->TXT_KONTRAK_2);
                $awal_Kontrak_2 = $kumpulan_tanggal_Kontrak_2[0];
                $akhir_Kontrak_2 = $kumpulan_tanggal_Kontrak_2[1];
                $start_date_Kontrak_2 = strtotime(date("Y-m-d"));
                $end_date_Kontrak_2 = strtotime($akhir_Kontrak_2);
                $hasil_jarak_tanggal_Kontrak_2 = ($end_date_Kontrak_2 - $start_date_Kontrak_2) / 60 / 60 / 24;
                if ($hasil_jarak_tanggal_Kontrak_2 >= 0 && $hasil_jarak_tanggal_Kontrak_2 <= 30) {
                    $statusKontrak2 = "<span id='bahaya' class='label m-1'>(K2H)</span>";
                } else if ($hasil_jarak_tanggal_Kontrak_2 < 0) {
                    $statusKontrak2 = "<span id='lewat' class='label m-1'>(K2L)</span>";
                }
            } else {
                $statusKontrak2 = "";
            }
            // cek Kontrak3 mau habis
            if ($this->_cekNumber($row->TXT_KONTRAK_3) == true) {
                // cek apabil tanggal kontrak sudah ada dan membaginya menkadi awal dan akhir lalu menghitung jarak nya
                $kumpulan_tanggal_Kontrak_3 = explode("||", $row->TXT_KONTRAK_3);
                $awal_Kontrak_3 = $kumpulan_tanggal_Kontrak_3[0];
                $akhir_Kontrak_3 = $kumpulan_tanggal_Kontrak_3[1];
                $start_date_Kontrak_3 = strtotime(date("Y-m-d"));
                $end_date_Kontrak_3 = strtotime($akhir_Kontrak_3);
                $hasil_jarak_tanggal_Kontrak_3 = ($end_date_Kontrak_3 - $start_date_Kontrak_3) / 60 / 60 / 24;
                if ($hasil_jarak_tanggal_Kontrak_3 >= 0 && $hasil_jarak_tanggal_Kontrak_3 <= 30) {
                    $statusKontrak3 = "<span id='bahaya' class='label m-1'>(K3H)</span>";
                } else if ($hasil_jarak_tanggal_Kontrak_3 < 0) {
                    $statusKontrak3 = "<span id='lewat' class='label m-1'>(K3L)</span>";
                }
            } else {
                $statusKontrak3 = "";
            }
            // cek Kontrak4 mau habis
            if ($this->_cekNumber($row->TXT_KONTRAK_4) == true) {
                // cek apabil tanggal kontrak sudah ada dan membaginya menkadi awal dan akhir lalu menghitung jarak nya
                $kumpulan_tanggal_Kontrak_4 = explode("||", $row->TXT_KONTRAK_4);
                $awal_Kontrak_4 = $kumpulan_tanggal_Kontrak_4[0];
                $akhir_Kontrak_4 = $kumpulan_tanggal_Kontrak_4[1];
                $start_date_Kontrak_4 = strtotime(date("Y-m-d"));
                $end_date_Kontrak_4 = strtotime($akhir_Kontrak_4);
                $hasil_jarak_tanggal_Kontrak_4 = ($end_date_Kontrak_4 - $start_date_Kontrak_4) / 60 / 60 / 24;
                if ($hasil_jarak_tanggal_Kontrak_4 >= 0 && $hasil_jarak_tanggal_Kontrak_4 <= 30) {
                    $statusKontrak = "<span id='bahaya' class='label m-1'>(K4H)</span>";
                } else if ($hasil_jarak_tanggal_Kontrak_4 < 0) {
                    $statusKontrak4 = "<span id='lewat' class='label m-1'>(K4L)</span>";
                }
            } else {
                $statusKontrak4 = "";
            }
            // cek Kontrak5 mau habis
            if ($this->_cekNumber($row->TXT_KONTRAK_5) == true) {
                // cek apabil tanggal kontrak sudah ada dan membaginya menkadi awal dan akhir lalu menghitung jarak nya
                $kumpulan_tanggal_Kontrak_5 = explode("||", $row->TXT_KONTRAK_5);
                $awal_Kontrak_5 = $kumpulan_tanggal_Kontrak_5[0];
                $akhir_Kontrak_5 = $kumpulan_tanggal_Kontrak_5[1];
                $start_date_Kontrak_5 = strtotime(date("Y-m-d"));
                $end_date_Kontrak_5 = strtotime($akhir_Kontrak_5);
                $hasil_jarak_tanggal_Kontrak_5 = ($end_date_Kontrak_5 - $start_date_Kontrak_5) / 60 / 60 / 24;
                if ($hasil_jarak_tanggal_Kontrak_5 >= 0 && $hasil_jarak_tanggal_Kontrak_5 <= 30) {
                    $statusKontrak5 = "<span id='bahaya' class='m-1'>(K5H)</span>";
                } else if ($hasil_jarak_tanggal_Kontrak_5 <= 0) {
                    $statusKontrak5 = "<span id='lewat' class='m-1'>(K5L)</span>";
                }
            } else {
                $statusKontrak5 = "";
            }
            // echo $row->TXT_NAMA . "-" . $this->_cekNumber($row->TXT_KONTRAK_PERCOBAAN) . "<br>";
            // echo $row->TXT_NAMA . "-" . $this->_cekNumber($row->TXT_KONTRAK_1) . "<br>";
            // echo $row->TXT_NAMA . "-" . $this->_cekNumber($row->TXT_KONTRAK_2) . "<br>";
            // echo $row->TXT_NAMA . "-" . $this->_cekNumber($row->TXT_KONTRAK_3) . "<br>";
            // echo $row->TXT_NAMA . "-" . $this->_cekNumber($row->TXT_KONTRAK_4) . "<br>";
            // echo $row->TXT_NAMA . "-" . $this->_cekNumber($row->TXT_KONTRAK_5) . "<br>";
            $data[] = array(
                'nama'      => $row->TXT_NAMA,
                'divisi'    => $row->TXT_DIVISI,
                'email'     => $row->TXT_EMAIL,
                'statusKontrak' => $statusPercobaan . " " . $statusKontrak1 . " " . $statusKontrak2 . " " . $statusKontrak3 . " " . $statusKontrak4 . " " . $statusKontrak5,
                'act'       => $row->user_id,
                'tlp'       => $row->TXT_TELEPON
            );
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function divisi()
    {

        $this->form_validation->set_rules('namadevisi', 'Nama Divisi', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            # code...
            $data['title']  = "Divisi";
            $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
            $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();

            $data['devisi'] = $this->db->get('tb_divisi')->result_array();

            $config['base_url']     = base_url('datakaryawan/divisi');
            $config['total_rows']   = count($data['devisi']);
            $config['per_page']     = 10;
            $config['num_links']    = 1;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open']    = '<nav><ul class="pagination">';
            $config['full_tag_close']   = '</ul></nav>';
            $config['attributes']   = array('class' => 'page-link');
            $config['first_link']   = 'First';
            $config['last_link']    = 'Last';
            $config['first_tag_open']   = '<li class="page-item">';
            $config['first_tag_close']  = '</li>';
            $config['last_tag_open']    = '<li class="page-item">';
            $config['last_tag_close']   = '</li>';
            $config['next_link']    = '&raquo;';
            $config['next_tag_open']    = '<li class="page-item">';
            $config['next_tag_close']   = '</li>';
            $config['prev_link']    = '&laquo;';
            $config['prev_tag_open']    = '<li class="page-item">';
            $config['prev_tag_close']   = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><a href="#" class="page-link">';
            $config['cur_tag_close']    = '</a></li>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';

            $this->pagination->initialize($config);
            $start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

            $data['devisi'] = array_slice($data['devisi'], $start, $config['per_page']);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/headbar', $data);
            $this->load->view('datakaryawan/devisi-aktif', $data);
            $this->load->view('templates/footer');
        } else {
            # code...
            $namadivisi = $this->input->post('namadevisi');
            $data = array(
                'nama_divisi' => $namadivisi,
                'date_added'  => time()
            );

            if ($this->db->insert('tb_divisi', $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Divisi baru sudah ditambahkan!</div>');
                redirect('datakaryawan/divisi');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan!</div>');
                redirect('datakaryawan/divisi');
            }
        }
    }

    public function actionDivisi()
    {
        $action = $this->input->post('action');
        $id = $this->input->post('id');

        if ($action == 'delete') {
            $this->db->where('id', $id);
            $this->db->delete('tb_divisi');
            $act    = "DELETE";
            $mess   = "Berhasil dihapus";
        } else if ($action == 'update') {
            $act    = "UPDATE";
            $mess   = "Berhasil diupdate";
        }

        $data = array(
            'title' => $act,
            'message'   => $mess
        );

        header('Content-Type: application/json');
        echo json_encode($data);
    }
    // view detail karyawan di page data karyawan aktif
    function detailKaryawan()
    {
        error_reporting(0);
        $idkaryawan = $this->input->post('id');

        $output = '';
        $kar    = $this->db->get_where('tb_user', ['user_id' => $idkaryawan])->row_array();

        $percobaan_awal     = explode('||', $kar['TXT_KONTRAK_PERCOBAAN'])[0];
        $percobaan_akhir    = explode('||', $kar['TXT_KONTRAK_PERCOBAAN'])[1];

        $kontrak_1_awal     = explode('||', $kar['TXT_KONTRAK_1'])[0];
        $kontrak_1_akhir    = explode('||', $kar['TXT_KONTRAK_1'])[1];

        $kontrak_2_awal     = explode('||', $kar['TXT_KONTRAK_2'])[0];
        $kontrak_2_akhir    = explode('||', $kar['TXT_KONTRAK_2'])[1];

        $kontrak_3_awal     = explode('||', $kar['TXT_KONTRAK_3'])[0];
        $kontrak_3_akhir    = explode('||', $kar['TXT_KONTRAK_3'])[1];

        $kontrak_4_awal     = explode('||', $kar['TXT_KONTRAK_4'])[0];
        $kontrak_4_akhir    = explode('||', $kar['TXT_KONTRAK_4'])[1];

        $kontrak_5_awal     = explode('||', $kar['TXT_KONTRAK_5'])[0];
        $kontrak_5_akhir    = explode('||', $kar['TXT_KONTRAK_5'])[1];

        $output .= '<div class="row m-b-lg m-t-lg">
            <div class="col-md-5">
                <div class="profile-image">
                    <img src="' . base_url('uploads/images/') . $kar['TXT_PHOTO'] . '" class="rounded-circle circle-border m-b-md" alt="profile">
                </div>
                <div class="profile-info">
                    <div>
                        <div>
                            <h3 class="no-margins">' . $kar['TXT_NAMA'] . '</h3>
                            <h5>DIVISI: ' . $kar['TXT_DIVISI'] . '</h5>
                            <small>
                                Mulai Bekerja : ' . $kar['tgl_mulai_bekerja'] . '
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <table class="table small m-b-xs" width="100%">
                    <tbody>
                        <tr>
                            <td>
                                <strong>' . hitungProject($kar['user_id']) . '</strong> Projects
                            </td>
                            <td>
                                <strong>' .  hitungKaizen($kar['user_id'])  . '</strong> Improvement
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>' .  hitungReward($kar['TXT_NAMA'])  . '</strong> Rewards
                            </td>
                            <td>
                                <strong>' .  hitungPenalty($kar['TXT_NAMA'])  . '</strong> Penalty
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2">
                <small><b>POIN</b></small>
                <h3 class="no-margins">' .  $kar['INT_POINT']  . '</h3>
                <div id="sparkline1"></div>
            </div>
        </div>';
        $output .= '<div class="responsive content">
        <table class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th colspan="3" class="text-center"> Kontrak</th>
                </tr>
                <tr>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Awal</th>
                    <th class="text-center">Akhir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="width:20%">Kontrak Percobaan</th>
                    <td class="text-center" id="kontrak-percobaan-awal-view">' . $percobaan_awal . '</td>
                    <td class="text-center" id="kontrak-percobaan-akhir-view">' . $percobaan_akhir . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Kontrak 1</th>
                    <td class="text-center" id="kontrak-1-awal-view">' . $kontrak_1_awal . '</td>
                    <td class="text-center" id="kontrak-1-akhir-view">' . $kontrak_1_akhir . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Kontrak 2</th>
                    <td class="text-center" id="kontrak-2-awal-view">' . $kontrak_2_awal . '</td>
                    <td class="text-center" id="kontrak-2-akhir-view">' . $kontrak_2_akhir . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Kontrak 3</th>
                    <td class="text-center" id="kontrak-3-awal-view">' . $kontrak_3_awal . '</td>
                    <td class="text-center" id="kontrak-3-akhir-view">' . $kontrak_3_akhir . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Kontrak 4</th>
                    <td class="text-center" id="kontrak-4-awal-view">' . $kontrak_4_awal . '</td>
                    <td class="text-center" id="kontrak-4-akhir-view">' . $kontrak_4_akhir . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Kontrak 5</th>
                    <td class="text-center" id="kontrak-5-awal-view">' . $kontrak_5_awal . '</td>
                    <td class="text-center" id="kontrak-5-akhir-view">' . $kontrak_5_akhir . '</td>
                </tr>
                <tr>
                    <th colspan="3" class="text-center gray-bg">Detail</th>
                </tr>
                <tr>
                    <th style="width:20%">ID Karyawan</th>
                    <td colspan="2" id="id-karyawan-view">' . $kar["absen_id"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Tgl Resign</th>
                    <td colspan="2" id="resign-view">' . date_format($kar["DATE_TANGGAL_RESIGN"], "d/m/Y") . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Divisi</th>
                    <td colspan="2" id="divisi-view">' . $kar["TXT_DIVISI"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">No Telepon</th>
                    <td colspan="2" id="telepon-view">' . $kar["TXT_TELEPON"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Status</th>
                    <td colspan="2" id="status-view">' . $kar["TXT_STATUS"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Alamat</th>
                    <td colspan="2" id="alamat-view">' . $kar["TXT_ALAMAT"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Tempat Lahir</th>
                    <td colspan="2" id="tempat-lahir-view">' . $kar["TXT_TEMPAT_LAHIR"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Hobby</th>
                    <td colspan="2" id="hobby-view">' . $kar["TXT_HOBBY"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Agama</th>
                    <td colspan="2" id="agama-view">' . $kar["TXT_AGAMA"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Kelamin</th>
                    <td colspan="2" id="kelamin-view">' . $kar["TXT_KELAMIN"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Kebangsaan</th>
                    <td colspan="2" id="kebangsaan-view">' . $kar["TXT_KEBANGSAAN"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Tanggal Lahir</th>
                    <td colspan="2" id="tanggal-lahir-view">' . $kar["tanggal_lahir"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Nama Kerabat</th>
                    <td colspan="2" id="kerabat-view">' . $kar["TXT_NAMA_KERABAT"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Hubungan Kerabat</th>
                    <td colspan="2" id="hubungan-kerabat-view">' . $kar["TXT_HUBUNGAN_KRBT"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Alamat & Telepon Kerabat</th>
                    <td colspan="2" id="alamat-telp-kerabat-view">' . $kar["TXT_ALAMAT_TELP_KRBT"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Nama Suami / Istri</th>
                    <td colspan="2" id="nama-suami-istri-view">' . $kar["TXT_NAMA_SUAMI_ISTRI"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Tempat lahir Suami / Istri</th>
                    <td colspan="2" id="tempat-lahir-suami-istri-view">' . $kar["TXT_TEMPAT_LAHIR_SUAMI_ISTRI"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Tanggal Lahir Suami / Istri</th>
                    <td colspan="2" id="date-tanggal-lahir-suami-istri-view">' . $kar["DATE_TANGGAL_LAHIR_SUAMI_ISTRI"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Pekerjaan Suami Istri</th>
                    <td colspan="2" id="pekerjaan-suami-istri-view">' . $kar["TXT_PEKERJAAN_SUAMI_ISTRI"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Alamat Pekerjaan Suami / Istri</th>
                    <td colspan="2" id="alamat-pekerjaan-suami-istri-view">' . $kar["TXT_NAMA_ALAMAT_PEKERJAAN_SUAMI_ISTRI"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Telepon Suami / Istri</th>
                    <td colspan="2" id="telepon-suami-istri-view">' . $kar["TXT_TELEPON_SUAMI_ISTRI"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Nama Anak 1</th>
                    <td colspan="2" id="anak-1-view">' . $kar["TXT_NAMA_ANAK_1"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Nama Anak 2</th>
                    <td colspan="2" id="anak-2-view">' . $kar["TXT_NAMA_ANAK_2"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Nama Anak 3</th>
                    <td colspan="2" id="anak-3-view">' . $kar["TXT_NAMA_ANAK_3"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Nama Anak 4</th>
                    <td colspan="2" id="anak-4-view">' . $kar["TXT_NAMA_ANAK_4"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Nama Anak 5</th>
                    <td colspan="2" id="anak-5-view">' . $kar["TXT_NAMA_ANAK_5"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">Email</th>
                    <td colspan="2" id="email-view">' . $kar["TXT_EMAIL"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">NIK</th>
                    <td colspan="2" id="nik-view">' . $kar["TXT_NIK"] . '</td>
                </tr>
                <tr>
                    <th style="width:20%">NPWP</th>
                    <td colspan="2" id="npwp-view">' . $kar["TXT_NPWP"] . '</td>
                </tr>
            </tbody>
        </table>
        </div>';

        echo $output;
    }

    function nonaktifkanKaryawan()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            show_404(); // Atau tindakan lain yang sesuai
        }

        // Ambil data POST dari body request
        $input = json_decode(file_get_contents('php://input'), true);

        // Lakukan validasi data jika diperlukan
        if (!isset($input['id']) || !isset($input['tgl_resign'])) {
            $response = array(
                'status' => 'error',
                'message' => 'Data tidak lengkap. Pastikan id karyawan dan tanggal resign ada dalam request.'
            );
        } else {
            $id_karyawan = $input['id'];
            $tgl_resign = $input['tgl_resign'];

            $data = [
                'DATE_TANGGAL_RESIGN' => $tgl_resign,
                'is_active' => '0'
            ];

            $this->db->where('user_id', $id_karyawan);
            $update = $this->db->update('tb_user', $data);

            if ($update) {
                $response = array(
                    'status' => 'success', // atau 'error' jika gagal
                    'message' => 'Karyawan berhasil dinonaktifkan' // Pesan berhasil atau pesan error
                    // Jika diperlukan, tambahkan data tambahan untuk dikirim ke client
                );
            } else {
                $response = array(
                    'status' => 'error', // atau 'error' jika gagal
                    'message' => 'Gagal nonaktifkan karyawan, kesalahan query' // Pesan berhasil atau pesan error
                    // Jika diperlukan, tambahkan data tambahan untuk dikirim ke client
                );
            }
        }
        header('Content-Type: application/json');

        // Kembalikan respons dalam format JSON
        echo json_encode($response);
    }

    function editKaryawan()
    {

        if ($this->form_validation->run() == FALSE) {
            # code...
            $divs = $this->db->get('tb_divisi');
            $output = '';
            if ($this->input->post('id')) {
                error_reporting(0);
                $idkaryawan = $this->input->post('id');
                // ambil data karyawan 
                $kar = $this->db->get_where('tb_user', ['user_id' => $idkaryawan])->row_array();

                $percobaan_awal     = ($kar['TXT_KONTRAK_PERCOBAAN']) ? strtotime(explode('||', $kar['TXT_KONTRAK_PERCOBAAN'])[0]) : "";
                $percobaan_akhir    = ($kar['TXT_KONTRAK_PERCOBAAN']) ? strtotime(explode('||', $kar['TXT_KONTRAK_PERCOBAAN'])[1]) : "";

                $kontrak_1_awal     = ($kar['TXT_KONTRAK_1']) ? strtotime(explode('||', $kar['TXT_KONTRAK_1'])[0]) : "";
                $kontrak_1_akhir    = ($kar['TXT_KONTRAK_1']) ? strtotime(explode('||', $kar['TXT_KONTRAK_1'])[1]) : "";

                $kontrak_2_awal     = ($kar['TXT_KONTRAK_2']) ? strtotime(explode('||', $kar['TXT_KONTRAK_2'])[0]) : "";
                $kontrak_2_akhir    = ($kar['TXT_KONTRAK_2']) ? strtotime(explode('||', $kar['TXT_KONTRAK_2'])[1]) : "";

                $kontrak_3_awal     = ($kar['TXT_KONTRAK_3']) ? strtotime(explode('||', $kar['TXT_KONTRAK_3'])[0]) : "";
                $kontrak_3_akhir    = ($kar['TXT_KONTRAK_3']) ? strtotime(explode('||', $kar['TXT_KONTRAK_3'])[1]) : "";

                $kontrak_4_awal     = ($kar['TXT_KONTRAK_4']) ? strtotime(explode('||', $kar['TXT_KONTRAK_4'])[0]) : "";
                $kontrak_4_akhir    = ($kar['TXT_KONTRAK_4']) ? strtotime(explode('||', $kar['TXT_KONTRAK_4'])[1]) : "";

                $kontrak_5_awal     = ($kar['TXT_KONTRAK_5']) ? strtotime(explode('||', $kar['TXT_KONTRAK_5'])[0]) : "";
                $kontrak_5_akhir    = ($kar['TXT_KONTRAK_5']) ? strtotime(explode('||', $kar['TXT_KONTRAK_5'])[1]) : "";

                $tglResign          = ($kar['DATE_TANGGAL_RESIGN']) ? strtotime($kar['DATE_TANGGAL_RESIGN']) : "";
                $tglStartKerja      = ($kar['tgl_mulai_bekerja']) ? strtotime($kar['tgl_mulai_bekerja']) : "";

                $output .= '<div class="form-group  row"><label class="col-sm-2 col-form-label"> Percobaan</label>
                <div class="col-sm-4"><input type="date" name="kontrak-percobaan-awal-edit" id="kontrak-percobaan-awal-edit" class="form-control" value="' . date("Y-m-d", $percobaan_awal) . '"></div>
                <div class="col-sm-4"><input type="date" name="kontrak-percobaan-akhir-edit" id="kontrak-percobaan-akhir-edit" class="form-control" value="' . date("Y-m-d", $percobaan_akhir) . '"></div>
                <div class="col-sm-2"><button type="button" class="btn btn-block btn-secondary reset-percobaan">reset</button></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kontrak 1</label>
                <div class="col-sm-4"><input type="date" name="kontrak-1-awal-edit" id="kontrak-1-awal-edit"
                        placeholder="Awal" class="form-control" value="' . date("Y-m-d", $kontrak_1_awal) . '"></div>
                <div class="col-sm-4"><input type="date" name="kontrak-1-akhir-edit" id="kontrak-1-akhir-edit"
                        placeholder="Akhir" class="form-control" value="' . date("Y-m-d", $kontrak_1_akhir) . '"></div>
                <div class="col-sm-2"><button class="btn btn-block btn-secondary reset-kontrak-1">reset</button></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kontrak 2</label>
                <div class="col-sm-4"><input type="date" name="kontrak-2-awal-edit" id="kontrak-2-awal-edit"
                        placeholder="Awal" class="form-control" value="' . date("Y-m-d", $kontrak_2_awal) . '"></div>
                <div class="col-sm-4"><input type="date" name="kontrak-2-akhir-edit" id="kontrak-2-akhir-edit"
                        placeholder="Akhir" class="form-control" value="' . date("Y-m-d", $kontrak_2_akhir) . '"></div>
                <div class="col-sm-2"><button class="btn btn-block btn-secondary reset-kontrak-2">reset</button></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kontrak 3</label>
                <div class="col-sm-4"><input type="date" name="kontrak-3-awal-edit" id="kontrak-3-awal-edit"
                        placeholder="Awal" class="form-control" value="' . date("Y-m-d", $kontrak_3_awal) . '"></div>
                <div class="col-sm-4"><input type="date" name="kontrak-3-akhir-edit" id="kontrak-3-akhir-edit"
                        placeholder="Akhir" class="form-control" value="' . date("Y-m-d", $kontrak_3_akhir) . '"></div>
                <div class="col-sm-2"><button class="btn btn-block btn-secondary reset-kontrak-3">reset</button></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kontrak 4</label>
                <div class="col-sm-4"><input type="date" name="kontrak-4-awal-edit" id="kontrak-4-awal-edit"
                        placeholder="Awal" class="form-control" value="' . date("Y-m-d", $kontrak_4_awal) . '"></div>
                <div class="col-sm-4"><input type="date" name="kontrak-4-akhir-edit" id="kontrak-4-akhir-edit"
                        placeholder="Akhir" class="form-control" value="' . date("Y-m-d", $kontrak_4_akhir) . '"></div>
                <div class="col-sm-2"><button class="btn btn-block btn-secondary reset-kontrak-4">reset</button></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kontrak 5</label>
                <div class="col-sm-4"><input type="date" name="kontrak-5-awal-edit" id="kontrak-5-awal-edit"
                        placeholder="Awal" class="form-control" value="' . date("Y-m-d", $kontrak_5_awal) . '"></div>
                <div class="col-sm-4"><input type="date" name="kontrak-5-akhir-edit" id="kontrak-5-akhir-edit"
                        placeholder="Akhir" class="form-control" value="' . date("Y-m-d", $kontrak_5_akhir) . '"></div>
                <div class="col-sm-2"><button class="btn btn-block btn-secondary reset-kontrak-5">reset</button></div>
            </div>
            <div class="form-group row">
                <label for="tgl-mulai-bekerja" class="col-sm-2">Tgl Mulai Bekerja</label>
                <div class="col-sm-4"><input type="date" class="form-control" name="tgl-mulai-bekerja" id="tgl-mulai-bekerja" value="' . date("Y-m-d", $tglStartKerja) . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10"><input type="text" id="nama-edit" class="form-control" value="' . $kar["TXT_NAMA"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tgl Resign</label>
                <div class="col-sm-8"><input type="date" id="resign-edit" class="form-control" value="' . date("Y-m-d", $tglResign) . '"></div>
                <div class="col-sm-2"><button class="btn btn-block btn-secondary reset-resign">reset</button></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">ID Karyawan</label>
                <div class="col-sm-10"><input type="text" id="id-karyawan-edit" class="form-control" value="' . $kar["absen_id"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10"><input type="text" id="telepon-edit" class="form-control" value="' . $kar["TXT_TELEPON"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Divisi</label>
                <div class="col-sm-10 " id="divisi-edit-val">
                    <select id="divisi-edit" data-placeholder="Pilih Karyawan ..." class="chosen-select form-control" tabindex="2" required>
                        <option value="' . $kar["TXT_DIVISI"] . '">' . $kar["TXT_DIVISI"] . '</option>';
                foreach ($divs->result() as $row) {
                    $output .= '<option value="' . $row->nama_divisi . '">' . $row->nama_divisi . '</option>';
                }
                $output .= '</select>
                </div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10"><input type="text" id="status-edit" class="form-control" value="' . $kar["TXT_STATUS"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10"><input type="text" id="alamat-edit" class="form-control" value="' . $kar["TXT_ALAMAT"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10"><input type="text" id="tempat-lahir-edit" class="form-control" value="' . $kar["TXT_TEMPAT_LAHIR"] . '">
                </div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Hobby</label>
                <div class="col-sm-10"><input type="text" id="hobby-edit" class="form-control" value="' . $kar["TXT_HOBBY"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10"><input type="text" id="agama-edit" class="form-control" value="' . $kar["TXT_AGAMA"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kelamin</label>
                <div class="col-sm-10"><input type="text" id="kelamin-edit" class="form-control" value="' . $kar["TXT_KELAMIN"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kebangsaan</label>
                <div class="col-sm-10"><input type="text" id="kebangsaan-edit" class="form-control" value="' . $kar["TXT_KEBANGSAAN"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10"><input type="date" id="tanggal-lahir-edit" class="form-control" value="' . $kar["DATE_TANGGAL_LAHIR"] . '">
                </div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Kerabat</label>
                <div class="col-sm-10"><input type="text" id="kerabat-edit" class="form-control" value="' . $kar["TXT_NAMA_KERABAT"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Hubungan Kerabat</label>
                <div class="col-sm-10"><input type="text" id="hubungan-kerabat-edit" class="form-control" value="' . $kar["TXT_HUBUNGAN_KRBT"] . '">
                </div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Alamat & telepon Kerabat</label>
                <div class="col-sm-10"><input type="text" id="alamat-telp-kerabat-edit" class="form-control" value="' . $kar["TXT_ALAMAT_TELP_KRBT"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Suami / Istri</label>
                <div class="col-sm-10"><input type="text" id="nama-suami-istri-edit" class="form-control" value="' . $kar["TXT_NAMA_SUAMI_ISTRI"] . '">
                </div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tempat Lahir Suami / Istri</label>
                <div class="col-sm-10"><input type="text" id="tempat-lahir-suami-istri-edit" class="form-control" value="' . $kar["TXT_TEMPAT_LAHIR_SUAMI_ISTRI"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tanggal Lahir Suami / Istri</label>
                <div class="col-sm-10"><input type="text" id="date-tanggal-lahir-suami-istri-edit"
                        class="form-control" value="' . $kar["DATE_TANGGAL_LAHIR_SUAMI_ISTRI"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Pekerjaan Suami Istri</label>
                <div class="col-sm-10"><input type="text" id="pekerjaan-suami-istri-edit" class="form-control"
                        value="' . $kar["TXT_PEKERJAAN_SUAMI_ISTRI"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Alamat Pekerjaan Suami /
                    Istri</label>
                <div class="col-sm-10"><input type="text" id="alamat-pekerjaan-suami-istri-edit"
                        class="form-control" value="' . $kar["TXT_NAMA_ALAMAT_PEKERJAAN_SUAMI_ISTRI"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Telepon Suami / Istri</label>
                <div class="col-sm-10"><input type="text" id="telepon-suami-istri-edit" class="form-control"
                        value="' . $kar["TXT_TELEPON_SUAMI_ISTRI"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 1</label>
                <div class="col-sm-10"><input type="text" id="anak-1-edit" class="form-control" value="' . $kar["TXT_NAMA_ANAK_1"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 2</label>
                <div class="col-sm-10"><input type="text" id="anak-2-edit" class="form-control" value="' . $kar["TXT_NAMA_ANAK_2"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 3</label>
                <div class="col-sm-10"><input type="text" id="anak-3-edit" class="form-control" value="' . $kar["TXT_NAMA_ANAK_3"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 4</label>
                <div class="col-sm-10"><input type="text" id="anak-4-edit" class="form-control" value="' . $kar["TXT_NAMA_ANAK_4"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Anak 5</label>
                <div class="col-sm-10"><input type="text" id="anak-5-edit" class="form-control" value="' . $kar["TXT_NAMA_ANAK_5"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10"><input type="text" id="email-edit" class="form-control" value="' . $kar["TXT_EMAIL"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-10"><input type="text" id="nik-edit" class="form-control" value="' . $kar["TXT_NIK"] . '"></div>
            </div>
            <div class="form-group  row"><label class="col-sm-2 col-form-label">NPWP</label>
                <div class="col-sm-10"><input type="text" id="npwp-edit" class="form-control" value="' . $kar["TXT_NPWP"] . '"></div>
            </div>';
            }
            echo $output;
        } else {
            # code...
        }
    }
}
