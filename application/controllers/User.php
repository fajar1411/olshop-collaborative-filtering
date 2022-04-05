<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
       $this->load->model('m_user');
       

    }

    // List all your items
    public function index( $offset = 0 )
    {
            $data = array(
                'title' =>'User',
                'user'  => $this->m_user->get_all_data(),
                'isi'   =>'v_user',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        
    }

    // Add a new item
    public function add()
    {
        $data = array(
            'nama_user' => $this->input->post('nama_user'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level_user' => $this->input->post('level_user'),
        );
        $this->m_user->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Input');
        redirect('user');
        
    }

    //Update one item
    public function edit( $id_user = NULL )
    {

        $data = array(
            'id_user'=> $id_user,
            'nama_user' => $this->input->post('nama_user'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level_user' => $this->input->post('level_user'),
        );
        $this->m_user->edit($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Ubah');
        redirect('user');
    }

    //Delete one item
    public function delete( $id_user = NULL )
    {
        $data = array('id_user' => $id_user );
        $this->m_user->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('user');
    }
}

/* End of file User.php */

