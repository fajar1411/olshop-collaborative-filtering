<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Barang extends CI_Model
 {
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori = tbl_barang.id_kategori','left' );
        
        $this->db->order_by('id_barang', 'desc');
        return $this->db->get()->result();

    }
    public function get_data($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_kategori','tbl_kategori.id_kategori = tbl_barang.id_kategori','left' );
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->row();

    }
    public function add($data){
        $this->db->insert('tbl_barang', $data);
        
    }
    public function edit($data){
        $this->db->where('id_barang',$data['id_barang']);
        $this->db->update('tbl_barang', $data);
        
        
    }
    public function delete($data){
        $this->db->where('id_barang',$data['id_barang']);
        $this->db->delete('tbl_barang', $data); 
    }

    public function getAllRecommend($l_recom){
        $imp = implode(',', $l_recom);
        $this->db->select('AVG(tbl_rating.rating) as avg_rat,tbl_barang.* ');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_rating','tbl_rating.id_barang = tbl_barang.id_barang','left' );
        $this->db->where_in('tbl_barang.id_barang',  $imp );
        $this->db->group_by('tbl_barang.id_barang'); 
        return $this->db->get()->result();
   }
    

}