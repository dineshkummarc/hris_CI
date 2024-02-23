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
}
