<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staylogin
{

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('cookie');
    }

    public function check_and_extend_session()
    {
        if (!$this->CI->session->userdata('email') && get_cookie('remember_me')) {
            // Jika tidak ada sesi aktif tetapi ada cookie "remember_me"
            $user_id = get_cookie('remember_me');
            $user = $this->CI->db->get_where('tb_user', ['user_id' => $user_id, 'is_active' => '1'])->row_array();

            if ($user) {
                $data = [
                    'email' => $user['TXT_EMAIL'],
                    'role_id' => $user['role_id'],
                    'nama_lengkap' => $user['TXT_NAMA'],
                    'is_activ' => $user['is_active']
                ];
                $this->CI->session->set_userdata($data);
            }
        }
    }
}
