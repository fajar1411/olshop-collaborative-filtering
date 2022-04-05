<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
        
    }
    

    public function index()
    {
        $data = array(
            'title' =>'Home',
            'barang'=>$this->m_home->get_all_data(),
            'isi'   =>'v_home',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    
    }
    public function kategori($id_kategori)
    {  $this->pelanggan_login->halaman_proteksi();
        $kategori=$this->m_home->kategori($id_kategori);
        $data = array(
            'title' =>''.$kategori->nama_kategori,
            'barang'=>$this->m_home->get_all_data_barang($id_kategori),
            'isi'   =>'v_kategori_barang',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    
    }


public function detail_barang($id_barang)
    {
        $this->pelanggan_login->halaman_proteksi();
        $data = array(
            'title' =>'Detail Barang',
            'gambar'=>$this->m_home->gambar_barang($id_barang),
            'barang'=>$this->m_home->detail_barang($id_barang),
            'isi'   =>'v_detail_barang',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    
    }
}

/* End of file Home.php */

