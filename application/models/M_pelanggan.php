<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {

    public function register($data)
    {
        $this->db->trans_start(); //untuk memulai pengecekan
        $this->db->insert('tbl_pelanggan', $data);
        $id_pelanggan = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        } else {
            /* $buatdireturn = $this->db->get_where('id', $id)->row_array();
            $buatdireturn;*/
            return $id_pelanggan;
        }
    }
    // public function getDataToken($id)
    // {
    //     $this->db->select('u.email, ut.token, ut.tanggal_dibuat, u.nama, u.id'); //u.* -> untuk select semua yg ada di tabel user
    //     //gunakan alias ketika ketemu nama field yang sama. example ut.tanggal_dibuat as td
    //     $this->db->from('user u');
    //     $this->db->join('user_token ut', 'ut.id_user=u.id');
    //     $this->db->where('u.id', $id);
    //     $result = $this->db->get();
    //     return $result->row_array();
    // }
    public function dataUser($number, $offset)
    {
        return $query = $this->db->get('tbl_pelanggan', $number, $offset)->result_array();
    }

    public function jumlah_data()
    {
        return $this->db->get('tbl_pelanggan')->num_rows();
    }

    public function queryUser($id_pelanggan)
    {

        $query = "SELECT * FROM `tbl_pelanggan` WHERE tbl_pelanggan`.`id_pelanggan` = $id_pelanggan";
        return $this->db->query($query)->result_array();
    }
}

/* End of file M_pelanggan.php */
