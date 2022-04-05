<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan_masuk extends CI_Model
 {
     public function pesanan()
     {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('status_order=0');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();  
        
     }
     public function pesanan_diproses()
     {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('status_order=1');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();  
        
     }
     public function pesanan_dikirim()
     {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('status_order=2');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();  
        
     }
     public function pesanan_diterima()
     {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('status_order=3');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();  
        
     }
     public function update_order($data)
     {
            $this->db->where('id_transaksi',$data['id_transaksi']);
            $this->db->update('tbl_transaksi', $data);
     }
     //////////
     public function update_refund($data)
     {
            $this->db->where('id_transaksi',$data['id_transaksi']);
            $this->db->update('tbl_transaksi', $data);
     }
     public function retur_diterima()
     {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('status_order=6');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();  
        
     }
     public function retur_diproses()
     {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('status_order=4');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();  
        
     }
     public function retur_dikirim()
     {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('status_order=5');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();  
        
     }
     public function refund_masuk()
     {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('status_refund=1');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();  
        
     }
     public function upload_bukti_debit($data)
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
    public function detail_pesanan($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get()->row();
        
        
    }
     
 }