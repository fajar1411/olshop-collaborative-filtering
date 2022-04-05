<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model
 {
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori = tbl_barang.id_kategori','left' );
        
        $this->db->order_by('id_barang', 'desc');
        return $this->db->get()->result();

    }
    public function get_all_data_kategori()
    {
        $this->db->select('*');
        $this->db->from('tbl_kategori');
        $this->db->order_by('id_kategori', 'desc');
        return $this->db->get()->result();

    } 

    public function detail_barang($id_barang) 
    {
        $this->db->select('*');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori = tbl_barang.id_kategori','left' );
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->row();

    }
    public function gambar_barang($id_barang) 
    {
        $this->db->select('*');
        $this->db->from('tbl_gambar');
        $this->db->where('id_barang', $id_barang);  
        return $this->db->get()->result(); 

    }

    public function kategori($id_kategori) 
    {
        $this->db->select('*');
        $this->db->from('tbl_kategori');
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->get()->row();
    }
    public function get_all_data_barang($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori = tbl_barang.id_kategori','left' );
        $this->db->where('tbl_barang.id_kategori', $id_kategori);
        return $this->db->get()->result();

    }
}
