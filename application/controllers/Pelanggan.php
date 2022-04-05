<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
      $this->load->model('m_pelanggan');
      $this->load->model('m_auth');
        
    
    }
    
    

    public function register()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Costumer', 'required',array('required'=>'%s Harap Di Isi!!!'));
        $this->form_validation->set_rules('email','E-mail','required|trim|valid_email|is_unique[tbl_pelanggan.email]',['required'=> 'Email Akun Wajib di isi','is_unique'=>'Email Sudah Ada',  'valid_email' => 'Anda harus memasukkan email yang valid']);
        $this->form_validation->set_rules('password','Password','required|trim|min_length[6]|matches[ulang_password]',['required'=> 'Password Wajib di isi','matches'=>'Password Tidak Sama',    'min_length' => 'Password terlalu pendek. Minimal 6 karakter.']);
		$this->form_validation->set_rules('ulang_password',' Ulang Password','required|trim|matches[password]',['required'=> ' Ulang Password Akun Wajib di isi','matches'=>'Password ulang Tidak Sama dengan password di atas']);



        if($this->form_validation->run()==FALSE){
            $data = array(
                'title' =>' Register Pelanggan',
                'isi'   =>'v_register',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);

        }else{
            $email = $this->input->post('email', true);
            $data = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'status' => 0,
                'tanggal_buat' => time()
            );

          
            if ($result = $this->m_pelanggan->register($data)) {
                // siapkan token berupa bilangan random
                $token = base64_encode(random_bytes(32)); //base 64 encode biar bisa dibaca token random bytesnya
                $pelanggan_token = [
                    'id_pelanggan' => $result,
                    'token' => $token,
                    'tanggal_buat' => time()
                ];  

                $this->db->insert('tbl_token', $pelanggan_token);

                $this->_sendEmail($token, 'verify', $pelanggan_token['id_pelanggan']); //kalo diawali pake underscore berarti private fungsi, gaharus sih cuma buat biar kita bisa bedain aja hehehe

            } else {
                $this->session->set_flashdata('pesan', '<div class="alert 
                alert-success" role="alert">Insert data gagal</div>');
                redirect('pelanggan/register');
            }

            $this->session->set_flashdata('pesan', '<div class="alert 
            alert-success" role="alert">Selamat! akun berhasil dibuat. Silahkan cek email masuk Anda untuk aktivasi akun ini.</div>');
            redirect('pelanggan/register');
        }
    }
    private function _sendEmail($token, $type, $result)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'collectionindri19@gmail.com',
            'smtp_pass' => 'indri1911',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);  //tambahkan baris ini jika failed connect to mailserver

        $this->email->from('collectionindri19@gmail.com', 'Indri Collection');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Akun Verifikasi');
            $this->email->message('Klik link ini untuk verifikasi akun Anda : <a href="' . base_url() . 'pelanggan/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '&id_pelanggan=' . urlencode($result) . '">Activate</a> <br>Token ini berlaku selama satu hari setelah Anda mendaftar. <br>Jika lebih dari satu hari Anda belum memverifikasi akun Anda, maka Anda harus mendaftar ulang.');
        } else if ($type == 'lupa') {
            $this->email->subject('Lupa Password');
            $this->email->message('Klik link ini untuk reset password akun Anda : <a href="' . base_url() . 'pelanggan/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '&id_pelanggan=' . urlencode($result) . '">Reset Password.</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $result = $this->input->get('id_pelanggan');

        $user = $this->db->get_where('tbl_pelanggan', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tbl_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['tanggal_buat'] < (60 * 60 * 24)) {
                    $this->db->set('status', 1);
                    $this->db->where('email', $email);
                    $this->db->update('tbl_pelanggan');

                    $this->db->delete('tbl_token', ['id_pelanggan' => $result]);

                    $this->session->set_flashdata('pesan', '<div class="alert 
                    alert-success" role="alert">' . $email . ' telah aktif! Silahkan Masuk.</div>');
                    redirect('pelanggan/login');
                } else {
                    $this->db->delete('tbl_pelanggan', ['email' => $email]);
                    $this->db->delete('tbl_token', ['id_pelanggan' => $result]);

                    $this->session->set_flashdata('pesan', '<div class="alert 
                    alert-danger" role="alert">Aktivasi gagal! Token telah kadaluarsa. Silahkan mendaftar ulang!</div>');
                    redirect('pelanggan/login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert 
                alert-danger" role="alert">Aktivasi gagal! Token salah.</div>');
                redirect('pelanggan/login');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert 
            alert-danger" role="alert">Aktivasi gagal! email salah.</div>');
            redirect('pelanggan/login');
        }
    }


    public function login(){
        $this->form_validation->set_rules('email', 'E-mail', 'required',array(
            'required' => '%s  Belum di isi !!!!'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required',array(
            'required' => '%s  belum di isi !!!!'
        ));

        
        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->pelanggan_login->login($email,$password);
            
        }
        $data = array(
            'title' =>' Login Costumer',
            'isi'   =>'v_login_pelanggan',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);

    }
    public function logout()
    {
        $this->pelanggan_login->logout();
    }
    public function akun(){

        //proteksi Halaman ]
        $this->pelanggan_login->halaman_proteksi();
        $data = array(
            'title' =>' Akunku',
            'isi'   =>'v_akun_saya',
    );
    $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }

}