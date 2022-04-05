<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rating_model extends CI_Model
{
   
    public function get_data_rating()
    {
        $this->db->select('*');
        $this->db->from('tbl_rating');
        return $this->db->get()->result();
    
    }
    public function get_data_barang($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tbl_rating');
        $this->db->join('tbl_barang','tbl_barang.id_barang = tbl_rating.id_barang','left' );
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->row();

    }

    
    public function add_rating($data){
        $this->db->insert('tbl_rating', $data);
    }
}
