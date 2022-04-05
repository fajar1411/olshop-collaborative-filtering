<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_kategori');

    }

    // List all your items
    public function index( )
    {
        $data = array(
            'title' =>'Kategori',
            'kategori'=>$this->m_kategori->get_all_data(),
            'isi'   =>'v_kategori',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function add()
    {
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori'),
            
        );
        $this->m_kategori->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Input');
        redirect('kategori');
        
    }

    public function edit( $id_kategori = NULL )
    {

        $data = array(
            'id_kategori'=> $id_kategori,
            'nama_kategori' => $this->input->post('nama_kategori'),
        );
        $this->m_kategori->edit($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Ubah');
        redirect('kategori');
    }

    //Delete one item
    public function delete( $id_kategori = NULL )
    {
        $data = array('id_kategori' => $id_kategori );
        $this->m_kategori->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('kategori');
    }
}

/* End of file Kategori.php */

