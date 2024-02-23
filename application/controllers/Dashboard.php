<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('Staylogin');
        $this->staylogin->check_and_extend_session();
    }

    public function index()
    {
        $data['title']  = "Dashboard";
        $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    public function editProfil($id)
    {
        $keys   = "G@ruda7577";
        $myID   = decryptData($id, $keys);

        $data['title']  = "My Profile";
        $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();
        $data['myprofile']  = $this->db->get_where('tb_user', ['user_id' => $myID])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('dashboard/profile', $data);
        $this->load->view('templates/footer');
    }

    function dataProject($id)
    {
        $keys   = "G@ruda7577";
        $myID   = decryptData($id, $keys);

        $this->db->order_by('tglcreate', 'DESC');
        $dataProject = $this->db->get_where('tb_project', ['pic' => $myID]);

        $data = array();

        foreach ($dataProject->result() as $row) {
            if ($row->status_project == '0') {
                $status = "Belum selesai";
            } else {
                $status = "Selesai";
            }
            $data[] = array(
                'judul'     => $row->judul_project,
                'duedate'   => $row->due_date,
                'status'    => $status
            );
        }

        echo json_encode($data);
    }
}
