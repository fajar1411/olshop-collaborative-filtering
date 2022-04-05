<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_rating extends CI_Model
 {
    public function count_total_rating($id_barang) 
    {
        $this->db->select('AVG(rating) as average');
        $this->db->where('id_barang', $id_barang);
        $this->db->from('tbl_rating');
        $ratingquery = $this->db->get();
        $postResult = $ratingquery->result_array();
        $rating = $postResult[0]['averageRating'];
        if($rating == ''){
            $rating = 0;
        }

        return $rating;
      }
    
    public function get_rating_user($id_pelanggan,$rating,$id_barang)
    {
        $this->db->select('*');
        $this->db->from('tbl_rating');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $userRatingquery = $this->db->get();

        $userRatingResult = $userRatingquery->result_array();
        if(count($userRatingResult) > 0){
    
          $postRating_id = $userRatingResult[0]['id'];
          // Update
          $value=array('rating'=>$rating);
          $this->db->where('id',$postRating_id);
          $this->db->update('posts_rating',$value);
        }else{
          $userRating = array(
            "id_barang" => $id_barang,
            "id_pelanggan" => $id_pelanggan,
            "rating" => $rating
          );
    
          $this->db->insert('tbl_rating', $userRating);
        }
}
 }