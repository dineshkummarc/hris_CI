<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('namaRole')) {
    function namaRole($idrole) {
        $ci = get_instance();

        $nmRole = $ci->db->get_where('user_role', ['role_id' => $idrole])->row_array();
        return $nmRole['role'];
    }
}