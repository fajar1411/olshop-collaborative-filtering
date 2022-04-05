<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_barang');
        $this->load->model('m_kategori');
        $this->load->model('rating_model');
        $this->load->library('recommend');
        

    }

    // List all your items
    public function index( )
    {
        $data = array(
            'title' =>'Barang',
            'barang'=>$this->m_barang->get_all_data(),
            'isi'   =>'barang/v_barang',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('harga', 'Harga Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('stok_barang', 'Stok Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('berat', 'Berat Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));

       if($this->form_validation->run()==TRUE){
        $config['upload_path'] = './assets/gambar/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['max_size']     = '2000';
        $this->upload->initialize($config);

        $field_name = "gambar";
        if (!$this->upload->do_upload($field_name)) {
            $data = array(
                'title' =>'Add Barang',
                'kategori'=>$this->m_kategori->get_all_data(),
                'error_upload'=> $this->upload->display_errors(),
                'isi'   =>'barang/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            
        }else{
            $upload_data    = array('uploads'=>$this->upload->data());
            $config['image_library']='gd2';
            $config['source_image']= './assets/gambar/'.$upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'nama_barang' => $this->input->post('nama_barang'),
                'id_kategori' => $this->input->post('id_kategori'),
                'harga'       => $this->input->post('harga'),
                'deskripsi'   => $this->input->post('deskripsi'),
                'gambar'      => $upload_data['uploads']['file_name'],
                'stok_barang'   => $this->input->post('stok_barang'),
                'berat'   => $this->input->post('berat'),
             );
             $this->m_barang->add($data);
             $this->session->set_flashdata('pesan', 'Data Berhasil Di Tambahkan');
             redirect('barang');
        }
       } 
        $data = array(
            'title' =>'Add Barang',
            'kategori'=>$this->m_kategori->get_all_data(),
            'isi'   =>'barang/v_add',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Edit one item
    public function edit( $id_barang)
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('id_kategori', 'Nama Kategori', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('harga', 'Harga Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('stok_barang', 'Stok Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('berat', 'Berat Barang', 'required',array('required'=>'%s Harap Di Isi!!!'));

       if($this->form_validation->run()==TRUE){
        $config['upload_path'] = './assets/gambar/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['max_size']     = '2000';
        $this->upload->initialize($config);

        $field_name = "gambar";
        if (!$this->upload->do_upload($field_name)) {
            $data = array(
                'title' =>'Edit Barang',
                'kategori'=>$this->m_kategori->get_all_data(),
                'barang'=>$this->m_barang->get_data($id_barang),
                'error_upload'=> $this->upload->display_errors(),
                'isi'   =>'barang/v_edit',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            
        }else{
            //hapus gambar
        $barang=$this->m_barang->get_data($id_barang);

        if ($barang->gambar!="") {
            unlink('./assets/gambar/'.$barang->gambar);
        }
        //akhir hapus gambar
            $upload_data    = array('uploads'=>$this->upload->data());
            $config['image_library']='gd2';
            $config['source_image']= './assets/gambar/'.$upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'id_barang'    =>$id_barang,
                'nama_barang' => $this->input->post('nama_barang'),
                'id_kategori' => $this->input->post('id_kategori'),
                'harga'       => $this->input->post('harga'),
                'deskripsi'   => $this->input->post('deskripsi'),
                'stok_barang'  => $this->input->post('stok_barang'),
                'berat'  => $this->input->post('berat'),
                'gambar'      => $upload_data['uploads']['file_name'],
                
             );
             $this->m_barang->edit($data);
             $this->session->set_flashdata('pesan', 'Data Berhasil Di Ubah');
             redirect('barang');
        }
        //tanpa ganti gambar
        $data = array(
            'id_barang'    =>$id_barang,
            'nama_barang' => $this->input->post('nama_barang'),
            'id_kategori' => $this->input->post('id_kategori'),
            'harga'       => $this->input->post('harga'),
            'deskripsi'   => $this->input->post('deskripsi'),
            'stok_barang'  => $this->input->post('stok_barang'),
            'berat'  => $this->input->post('berat'),
         );
         $this->m_barang->edit($data);
         $this->session->set_flashdata('pesan', 'Data Berhasil Di Ubah');
         redirect('barang');
       } 
        $data = array(
            'title' =>'Edit Barang',
            'kategori'=>$this->m_kategori->get_all_data(),
            'barang'=>$this->m_barang->get_data($id_barang),
            'isi'   =>'barang/v_edit',
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Delete one item
    public function delete( $id_barang = NULL )
    {
        //hapus gambar
        $barang=$this->m_barang->get_data($id_barang);

        if ($barang->gambar!="") {
            unlink('./assets/gambar/'.$barang->gambar);
        }

        //
        $data = array('id_barang' => $id_barang );
        $this->m_barang->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('barang');
    }

    public function recommended()
    {
        if(empty($this->session->userdata('id_pelanggan'))) {
          $this->session->set_flashdata('flash_data', 'Please Login First!');
          return redirect('login');
        }

        $matrix=array();
        $rating = $this->rating_model->get_data_rating();
        

        foreach ($rating as $item) {
            
            $matrix[$item->id_pelanggan][$item->id_barang] = $item->rating;
        }

      /*  echo "<pre>";
        print_r($matrix);

        echo "</pre>";
    
        echo "get recommendasi untuk user ".$this->session->userdata('id_pelanggan');

        echo "<pre>";
        print_r($this->recommend->getRecommendations($matrix, $this->session->userdata('id_pelanggan')));
        echo "</pre>";*/
       $l_recom = $this->recommend->getRecommendations($matrix, $this->session->userdata('id_pelanggan'));
       {
        $data=array(   
            'title' =>'rekomendasi',
            'barang' => $this->m_barang->getAllRecommend($l_recom),
            'isi'   =>'v_rekomendasi',
        );
    
        $this->load->view('layout/v_wrapper_frontend', $data);
       }
      
    
}


public function addrating($id_barang)
    {
        $this->form_validation->set_rules('rating', 'Rating', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('komentar', 'Komentar', 'required',array('required'=>'%s Harap Di Isi!!!'));
       if($this->form_validation->run()==TRUE){
        
       
 
            

            $data = array(
                'id_barang' => $id_barang,
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'rating'   => $this->input->post('rating'),
                'komentar'   => $this->input->post('komentar'),
           
               
             );
             $this->rating_model->add_rating($data);
             $this->session->set_flashdata('success', 'Rating Dan Komentar Berhasil Di Tambahkan');
             redirect('home/detail_barang/'.$id_barang);
        }
    }
}




/* End of file Barang.php */

