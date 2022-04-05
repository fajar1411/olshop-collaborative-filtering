<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_pesanan_masuk');
        
    }
    

    public function index()
    {
        $data = array(
            'title' =>'Dashboard',
            'total_barang'=>$this->m_admin->total_barang(),
            'total_kategori'=>$this->m_admin->total_kategori(),
            'total_user'=>$this->m_admin->total_user(),
            'isi'   =>'v_admin',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    
    }

    public function setting()
    {
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('kota', 'Kota Toko', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('alamat_toko', 'Alamat Toko', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('no_telpon', 'No Telpon', 'required',array('required'=>'%s Harap Di Isi!!!'));

        if($this->form_validation->run()==FALSE){
            $data = array(
                'title' =>'Setting',
                'setting'=> $this->m_admin->data_setting(),
                'isi'   =>'v_setting',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);


        }else{

            $data = array(
                'id'=> 1,
                'lokasi' => $this->input->post('kota'),
                'nama_toko' => $this->input->post('nama_toko'),
                'alamat_toko' => $this->input->post('alamat_toko'),
                'no_telpon' => $this->input->post('no_telpon'),

            );

            $this->m_admin->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Di Ubah');
            redirect('admin/setting');

        }
    
    }
    public function pesanan_masuk()
    {
        $data = array(
            'title' =>'',
            'pesanan'=>$this->m_pesanan_masuk->pesanan(),
            'pesanan_diproses'=>$this->m_pesanan_masuk->pesanan_diproses(),
            'pesanan_dikirim'=>$this->m_pesanan_masuk->pesanan_dikirim(),
            'pesanan_diterima'=>$this->m_pesanan_masuk->pesanan_diterima(),
            'isi'   =>'v_pesanan_masuk',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function proses($id_transaksi)
    {
        $data = array('id_transaksi'=>$id_transaksi,
        'status_order'=>'1'

    );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesananan Pelanggan Berhasil di proses dan sedang dalam pengemasan');
        redirect('admin/pesanan_masuk');
        
    }
    public function kirim($id_transaksi)
    {
        $data = array(
        'id_transaksi'=>$id_transaksi,
        'no_resi'=> $this->input->post('no_resi'),
        'status_order'=>'2'

    );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesananan Pelanggan Berhasil Di Kirim');
        redirect('admin/pesanan_masuk');
        
    }
    public function proses_refund($id_transaksi)
    {
        $data = array('id_transaksi'=>$id_transaksi,
        'status_order'=>'4'

    );
        $this->m_pesanan_masuk-> update_refund($data);
        $this->session->set_flashdata('pesan', 'Pesananan Pelanggan Berhasil di proses dan sedang dalam pengemasan');
        redirect('admin/retur_masuk');
        
    }
    public function kirim_bukti($id_transaksi)
    {
        $this->form_validation->set_rules('komentar_balasan', 'Komentar_balasan', 'required',array('required'=>'%s Harap Di Isi!!!'));

        if($this->form_validation->run()==TRUE){
         $config['upload_path'] = './assets/bukti_debit/';
         $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
         $config['max_size']     = '2000';
         $this->upload->initialize($config);
     
         $field_name = 'bukti_debit';
         if (!$this->upload->do_upload($field_name)) {
             $data = array(
                 'title' =>'',
                 'error_upload'=> $this->upload->display_errors(),
                 'isi'   =>'v_bukti',
         );
         $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
             
         }else{
             $upload_data    = array('uploads'=>$this->upload->data());
             $config['image_library']='gd2';
             $config['source_image']= './assets/bukti_debit/'.$upload_data['uploads']['file_name'];
             $this->load->library('image_lib', $config);
     
             $data = array(
                 'id_transaksi' => $id_transaksi,
                 'Komentar_balasan'       => $this->input->post('komentar_balasan'),
                 'status_order'       => '5',
                 'bukti_debit' => $upload_data['uploads']['file_name'],
             
              );
              $this->m_pesanan_masuk->update_refund($data);
              $this->session->set_flashdata('pesan', 'Bukti Transfer Berhasil Di Upload');
              redirect('admin/retur_masuk');
         }
        } 
         $data = array(
             'title' =>'',
             'pesanan'=>$this->m_pesanan_masuk->detail_pesanan($id_transaksi),  
             'alamat_toko'=>  $this->m_pesanan_masuk->alamat_toko (),
             'isi'   =>'v_bukti',
     );
     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
     
        
    }
    public function retur_masuk()
    {
        $data = array(
            'title' =>'',
            'retur'=>$this->m_pesanan_masuk->refund_masuk(),
            'retur_diproses'=>$this->m_pesanan_masuk-> retur_diproses(),
            'retur_dikirim'=>$this->m_pesanan_masuk->retur_dikirim(),
            'retur_diterima'=>$this->m_pesanan_masuk-> retur_diterima(),
            'isi'   =>'v_retur_masuk',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }


}