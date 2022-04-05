<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller {
    public function __construct() 
    {
       parent::__construct();
        $this->load->model('m_transaksi');
        $this->load->model('m_pesanan_masuk');
    }

    public function index()
    {
        $data = array(
            'title' =>'',
            'belum_bayar'=>   $this->m_transaksi->belum_bayar(),
            'diproses'=>$this->m_transaksi->diproses(),
            'dikirim'=>$this->m_transaksi->dikirim(),
            'diterima'=>$this->m_transaksi->diterima(),
            'diterima_refund'=>$this->m_transaksi->diterima_refund(),
            'belum_upload'=>   $this->m_transaksi->belum_upload(),
            'proses_retur'=>$this->m_transaksi-> proses_retur(),
            'bukti_retur'=>$this->m_transaksi->bukti_retur(),
            'isi'   =>'v_pesanan_saya',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    
    }
    public function bayar($id_transaksi)
    {
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required',array('required'=>'%s Harap Di Isi!!!'));

       if($this->form_validation->run()==TRUE){
        $config['upload_path'] = './assets/bukti_bayar/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['max_size']     = '2000';
        $this->upload->initialize($config);

        $field_name = 'bukti_bayar';
        if (!$this->upload->do_upload($field_name)) {
            $data = array(
                'title' =>'',
                'pesanan'=>$this->m_transaksi->detail_pesanan($id_transaksi),  
                'rekening'=>  $this->m_transaksi->rekening (),
                'error_upload'=> $this->upload->display_errors(),
                'isi'   =>'v_bayar',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            
        }else{
            $upload_data    = array('uploads'=>$this->upload->data());
            $config['image_library']='gd2';
            $config['source_image']= './assets/bukti_bayar/'.$upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'id_transaksi' => $id_transaksi,
                'atas_nama'       => $this->input->post('atas_nama'),
                'nama_bank'       => $this->input->post('nama_bank'),
                'no_rekening'       => $this->input->post('no_rekening'),
                'status_bayar'       => '1',
                'bukti_bayar' => $upload_data['uploads']['file_name'],
            
             );
             $this->m_transaksi->upload_bukti_bayar($data);
             $this->session->set_flashdata('pesan', 'Bukti Bayar Berhasil Di Upload');
             redirect('pesanan_saya');
        }
       } 
        $data = array(
            'title' =>'',
            'pesanan'=>$this->m_transaksi->detail_pesanan($id_transaksi),  
            'rekening'=>  $this->m_transaksi->rekening (),
            'isi'   =>'v_bayar',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    
    }
public function diterima($id_transaksi)
{
    $data = array(
        'id_transaksi'=>$id_transaksi,
        'status_order'=>'3',
        'status_refund'=>'0',

    );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Terima Kasih Pesanan Sudah Di Terima,Happy Shopping');
        redirect('pesanan_saya');
}
public function pengembalian($id_transaksi)
{
    $this->form_validation->set_rules('komentar_refund', 'Komentar_refund', 'required',array('required'=>'%s Harap Di Isi!!!'));

   if($this->form_validation->run()==TRUE){
    $config['upload_path'] = './assets/bukti_refund/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
    $config['max_size']     = '2000';
    $this->upload->initialize($config);

    $field_name = 'bukti_refund';
    if (!$this->upload->do_upload($field_name)) {
        $data = array(
            'title' =>'',
            'pesanan'=>$this->m_transaksi->detail_pesanan($id_transaksi),  
            'alamat_toko'=>  $this->m_transaksi->alamat_toko(),
            'error_upload'=> $this->upload->display_errors(),
            'isi'   =>'v_upload',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        
    }else{
        $upload_data    = array('uploads'=>$this->upload->data());
        $config['image_library']='gd2';
        $config['source_image']= './assets/bukti_refund/'.$upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);

        $data = array(
            'id_transaksi' => $id_transaksi,
            'Komentar_refund'       => $this->input->post('komentar_refund'),
            'status_refund'       => '1',
            'bukti_refund' => $upload_data['uploads']['file_name'],
        
         );
         $this->m_transaksi->upload_bukti_refund($data);
         $this->session->set_flashdata('pesan', 'Bukti refund Berhasil Di Upload');
         redirect('pesanan_saya/retur');
    }
   } 
    $data = array(
        'title' =>'',
        'pesanan'=>$this->m_transaksi->detail_pesanan($id_transaksi),  
        'alamat_toko'=>  $this->m_transaksi->alamat_toko (),
        'isi'   =>'v_upload',
);
$this->load->view('layout/v_wrapper_frontend', $data, FALSE);

}
public function diterima_refund($id_transaksi)
{
    $data = array(
        'id_transaksi'=>$id_transaksi,
        'status_order'=>'6'

    );
        $this->m_pesanan_masuk->update_refund($data);
        $this->session->set_flashdata('pesan', 'Terima Kasih bukti tranfer sudah dikirim,Happy Shopping');
        redirect('pesanan_saya/retur');
}
public function retur()
    {
        $data = array(
            'title' =>'',
            'proses_retur'=>$this->m_transaksi->proses_retur(),
            'bukti_retur'=>$this->m_transaksi->bukti_retur(),
            'diterima_refund'=>$this->m_transaksi->diterima_refund(),
            'belum_upload'=>   $this->m_transaksi->belum_upload(),
            'isi'   =>'v_retur',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    
    }
}
