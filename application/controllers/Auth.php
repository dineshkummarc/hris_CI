<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
* Develope by: Paulus Christofel Situmorang
* email: pchristofels@gmail.com
* Whatsapp: +62 812 1409 8020
*/
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if ($this->input->cookie('remember_me', true)) {
            // Redirect langsung ke halaman dashboard jika cookie ada
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password Required'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'LOGIN';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi ketika sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_user', ['username' => $username, 'is_active' => '1'])->row_array();

        //jika user ada
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email'         => $user['TXT_EMAIL'],
                    'username'      => $user['username'],
                    'role_id'       => $user['role_id'],
                    'rar_id'        => $user['rar_id'],
                    'nama_lengkap'  => $user['TXT_NAMA'],
                    'is_activ'      => $user['is_active']
                ];
                $this->session->set_userdata($data);

                $this->load->helper('cookie');

                // Cek apakah cookie 'remember_me' telah diset
                if ($this->input->cookie('remember_me')) {
                    // Jika sudah 6 jam, hapus cookie
                    if (time() - $this->input->cookie('remember_me') >= 21600) {
                        delete_cookie('remember_me');
                    }
                } else {
                    // Set cookie 'remember_me'
                    $cookie = array(
                        'name'   => 'remember_me',
                        'value'  => $user['user_id'], // Simpan identifikasi pengguna
                        'expire' => 21600, // 6 jam
                    );
                    set_cookie($cookie);
                }


                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Email or Password!</div>');
                redirect('auth');
            }
        } else {
            //tidak user
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Wrong Email or Password!</div>'
            );
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('user_nama');
        $this->session->unset_userdata('is_active');

        $this->session->sess_destroy();
        setcookie('remember_me', '', time() - 3600, '/');

        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">You are logged out!</div>');
        redirect('/');
    }

    public function blocked()
    {
        delete_cookie('remember_me');

        $this->load->view('auth/blocked');
    }

    public function changepassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            show_404(); // Atau tindakan lain yang sesuai
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input["id"]) && isset($input["karyawan"])) {
            $id = htmlspecialchars($input["id"]);
            $newPassword = password_hash($input['karyawan'], PASSWORD_DEFAULT);

            $this->db->set('password', $newPassword);
            $this->db->where('user_id', $id);
            if ($this->db->update('tb_user')) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Password anda telah diperbaharui!'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Gagal eksekusi query, hubungi pihak IT'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data tidak lengkap. Pastikan anda memasukkan data dalam request.'
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
