<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_logger
{
    function log_user()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        if ($CI->session->userdata('email')) {
            $user_email = $CI->session->userdata('nama_lengkap');
        } else {
            $user_email = '';
        }
        
        // cari lokasi 
        $ip_address = $CI->input->ip_address();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.iplocation.net/?ip=' . $ip_address);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $location_info = json_decode($response);
        
        if ($location_info && isset($location_info->country_name)) {
            $country_name = $location_info->country_name;
            $isp = $location_info->isp;
        } else {
            // Handle error case when the response is not in the expected format
            $country_name = 'Unknown';
            $isp = 'Unknown';
        }
        
        // Simpan informasi dasar pengunjung ke dalam database
        if($user_email != 'Paulus Christofel Situmorang') {
            $data = array(
                'ip_address'   => $CI->input->ip_address(),
                'page_visited' => $CI->uri->uri_string(),
                'visit_time'   => date('Y-m-d H:i:s'),
                'visitor_name' => $user_email,
                'country'      => $country_name,
                'isp'          => $isp
            );
            $CI->db->insert('activity_logs', $data);
        }
    }
}