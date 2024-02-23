<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kaizen extends CI_Controller
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

        $this->form_validation->set_rules('title', 'Judul Improvement', 'trim|required', [
            'required' => "Judul harus ada!"
        ]);

        $this->form_validation->set_rules('duedate', 'Due-date', 'trim|required', [
            'required' => "Wajib isi due-date"
        ]);


        if ($this->form_validation->run() == FALSE) {
            # code...
            $data['title']  = "Improvement";
            $data['user']   = $this->db->get_where('tb_user', ['TXT_EMAIL' => $this->session->userdata('email')])->row_array();
            $data['rar']    = $this->db->get_where('role_access_rights', ['id' => $this->session->userdata('rar_id')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/headbar', $data);
            $this->load->view('kaizen/improvement', $data);
            $this->load->view('templates/footer');
        } else {
            # code...
            $title  = $this->input->post('title');
            $pic    = $this->input->post('pic');
            $onweek = $this->input->post('onweek');
            $duedate    = $this->input->post('duedate');
            $beforeImp  = $this->input->post('beforeImp');
            $usul   = $this->input->post('usul');
            $afterImp   = $this->input->post('afterImp');
            $inputby    = $this->input->post('inputby');

            $data = array(
                'judul'     => $title,
                'beforekai' => $beforeImp,
                'recomendkai'   => $usul,
                'afterkai'      => $afterImp,
                'pic'       => $pic,
                'duedate'   => $duedate,
                'onmonth'   => date('Y-m'),
                'onweek'    => $onweek,
                'inputby'   => $inputby,
                'inputdate' => date('Y-m-d H:i:s')
            );

            if ($this->db->insert('tb_kaizen', $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Improvement ditambahkan!</div>');
                redirect('kaizen');
            }
        }
    }

    function mykaizen($id)
    {
        $keys = "G@ruda7577";
        $myToken = decryptData($id, $keys);
        $this->db->order_by('inputdate', 'DESC');
        $myKaizen = $this->db->get_where('tb_kaizen', ['inputby' => $myToken]);
        $data = array();
        $no = 1;
        foreach ($myKaizen->result() as $row) {
            $data[] = array(
                'no'    => $no++,
                'id'    => $row->id_kaizen,
                'judul' => $row->judul,
                'onweek'    => $row->onweek,
                'onmonth'   => $row->onmonth,
                'duedate'   => $row->duedate,
                'inputdate' => $row->inputdate
            );
        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    function detailKaizen()
    {
        $id = $this->input->post('id');
        // echo $id;
        $output = '';
        $dataKaizen = $this->db->get_where('tb_kaizen', ['id_kaizen' => $id])->row_array();

        $output .= '<table class="table table-borderless">
            <tbody>
                <tr>
                    <th>Judul</th>
                    <th>:</th>
                    <th>' . $dataKaizen["judul"] . '</th>
                </tr>
                <tr>
                    <th>PIC</th>
                    <th>:</th>
                    <th>' . $dataKaizen["pic"] . '</th>
                </tr>
                <tr>
                    <th>Due-date</th>
                    <th>:</th>
                    <th>' . $dataKaizen["duedate"] . '</th>
                </tr>
            </tbody>
            </table>
            <br />
            <table class="table table-bordered" width="100%">
            <tbody>
                <tr>
                    <th>Kondisi Sebelum Improve</th>
                    <th>Usul/ Improvement</th>
                    <th>Kondisi Setelah Improve</th>
                </tr>
                <tr>
                    <td>' . $dataKaizen["beforekai"] . '</td>
                    <td>' . $dataKaizen["recomendkai"] . '</td>
                    <td>' . $dataKaizen["afterkai"] . '</td>
                </tr>
            </tbody>
        </table>';

        echo $output;
    }
}
