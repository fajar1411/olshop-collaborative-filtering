<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model
 {
     public function simpan_transaksi($data){
         $this->db->insert('tbl_transaksi', $data);
         
     }
     public function simpan_rinci_transaksi($data_rinci){
        $this->db->insert('tbl_rinci_transaksi', $data_rinci);
        
    }
    public function belum_bayar()
    {
       $this->db->select('*');
       $this->db->from('tbl_transaksi');
       $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
       $this->db->where('status_order=0');
       $this->db->order_by('id_transaksi', 'desc');
       return $this->db->get()->result();  
       
    }

    public function diproses()
    {
       $this->db->select('*');
       $this->db->from('tbl_transaksi');
       $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
       $this->db->where('status_order=1');
       $this->db->order_by('id_transaksi', 'desc');
       return $this->db->get()->result();  
       
    }
    public function dikirim()
    {
       $this->db->select('*');
       $this->db->from('tbl_transaksi');
       $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
       $this->db->where('status_order=2');
       $this->db->order_by('id_transaksi', 'desc');
       return $this->db->get()->result();  
       
    }
    public function diterima()
    {
       $this->db->select('*');
       $this->db->from('tbl_transaksi');
       $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
       $this->db->where('status_order=3');
       $this->db->where('status_refund=0');
       $this->db->order_by('id_transaksi', 'desc');
       return $this->db->get()->result();  
       
   }
    public function detail_pesanan($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get()->row();
        
        
    }
    public function rekening ()
    {
        $this->db->select('*');
        $this->db->from('tbl_rekening');
        return $this->db->get()->result();

        
        
    }
    public function upload_bukti_bayar($data)
    {
        $this->db->where('id_transaksi',$data['id_transaksi']);
        $this->db->update('tbl_transaksi', $data); 
    }
    public function alamat_toko()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        return $this->db->get()->result();

        
        
    }
    public function belum_upload()
    {
       $this->db->select('*');
       $this->db->from('tbl_transaksi');
       $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
       $this->db->where('status_refund=0');
       $this->db->order_by('id_transaksi', 'desc');
       return $this->db->get()->result();  
       
    }
    public function upload_bukti_refund($data)
    {
        $this->db->where('id_transaksi',$data['id_transaksi']);
        $this->db->update('tbl_transaksi', $data); 
    }
    
    public function diterima_refund()
    {
       $this->db->select('*');
       $this->db->from('tbl_transaksi');
       $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
       $this->db->where('status_order=6');
       $this->db->order_by('id_transaksi', 'desc');
       return $this->db->get()->result();  
       
    }
    public function proses_retur()
    {
       $this->db->select('*');
       $this->db->from('tbl_transaksi');
       $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
       $this->db->where('status_order=4');
       $this->db->order_by('id_transaksi', 'desc');
       return $this->db->get()->result();  
       
    }
    public function bukti_retur()
    {
       $this->db->select('*');
       $this->db->from('tbl_transaksi');
       $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
       $this->db->where('status_order=5');
       $this->db->order_by('id_transaksi', 'desc');
       return $this->db->get()->result();  
       
    }
 
 }
 