<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('Staylogin');
        $this->staylogin->check_and_extend_session();
    }

    public function menu()
    {
        $data['title']  = "Menu Management";
        $data['user'] = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar'] = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();
        $data['menux'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('administrator/menu', $data);
        $this->load->view('templates/footer');
    }

    public function user_menu()
    {
        $this->load->model("m_menu");
        $menus = $this->m_menu->selectMenu();
        $data = array();
        $no = 1;

        foreach ($menus->result() as $mn) {
            $data[] = array(
                'no'    => $no++,
                'id'    => $mn->id,
                'menu'  => $mn->menu
            );
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function user_submenu()
    {
        $this->load->model("m_menu");
        $submenu = $this->m_menu->selectsubMenu();
        $data = array();
        $no = 1;

        foreach ($submenu->result() as $sm) {
            $data[] = array(
                'no'        => $no++,
                'title'     => $sm->title,
                'menu'      => $sm->menu,
                'url'       => $sm->url,
                'icon'      => $sm->icon,
                'active'    => $sm->is_active,
                'id'        => $sm->id
            );
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function disableSubMenu()
    {
        $id = $this->input->post('id');
        $action = $this->input->post('act');

        if ($action == 'disable') {
            $data = array('is_active' => '0');
            $pesan = 'Submenu has been disabled';
        } elseif ($action == 'enable') {
            $data = array('is_active' => '1');
            $pesan = 'Submenu has been enabled';
        }

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);

        $response = array(
            'status'    => 'success',
            'message'   => $pesan
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function role()
    {
        $data['title'] = 'User Role';
        $data['user'] = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar'] = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();
        $data['menux'] = $this->db->get('user_menu')->result_array();
        // echo 'Selamat datang ' . $data['user']['nama_lengkap'] . ' di FP Rewards';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('administrator/user_roles', $data);
        $this->load->view('templates/footer');
    }

    public function getRoles()
    {
        $this->load->model("m_menu");
        $role = $this->m_menu->selectRole();
        $data = array();
        $no = 1;

        foreach ($role->result() as $r) {
            $data[] = array(
                'no'    => $no++,
                'id'    => $r->role_id,
                'role'  => $r->role,
                'ket'   => $r->keterangan
            );
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function setAccess($encryptedData)
    {
        $key = "G@ruda7577";
        $id = decryptData($encryptedData, $key);

        $data['title'] = 'User Role';
        $data['user'] = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
        $data['rar'] = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['role_id' => $id])->row_array();

        $this->db->where('id !=', 2);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['jumlah'] = count($data['menu']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/headbar', $data);
        $this->load->view('administrator/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function simpanMenu()
    {
        $data = [
            'menu' => $this->input->post('namaMenu')
        ];
        $sippan = $this->db->insert('user_menu', $data);

        if ($sippan) {
            $this->load->helper('file');
            $nama_file = "application/controllers/" . $this->input->post('namaMenu') . ".php";

            $isi_file = "<?php
            defined('BASEPATH') or exit('No direct script access allowed');
            
            class " . $this->input->post('namaMenu') . " extends CI_Controller
            {
                public function __construct()
                {
                    parent::__construct();
                    is_logged_in();
                }
            }";
            write_file($nama_file, $isi_file);
        }
    }

    public function simpansubMenu()
    {
        $data = [
            'menu_id'   => $this->input->post('menu_root'),
            'title'     => $this->input->post('title'),
            'url'       => $this->input->post('urls'),
            'icon'      => $this->input->post('icon'),
            'is_active' => $this->input->post('isactive'),
            'created_date'  => time(),
            'created_by'    => $this->input->post('nuser')
        ];
        $this->db->insert('user_sub_menu', $data);
    }

    public function hapusMenu()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->delete('user_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu sudah dihapus!</div>');
    }

    public function simpanRole()
    {
        
        $data = [
            'role' => $this->input->post('nrole'),
            'keterangan' => $this->input->post('nketerangan')
        ];

        $result = $this->db->get_where('user_role', $data);

        if($result->num_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Roles ini sudah ada!</div>');
        } else {
            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role baru ditambahkan!</div>');
        }

    }
}
