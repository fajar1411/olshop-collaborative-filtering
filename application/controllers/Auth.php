<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function login_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required',array(
            'required' => '%s  Belum di isi !!!!'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required',array(
            'required' => '%s  belum di isi !!!!'
        ));

        
        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->user_login->login($username,$password);
            
        }
        $data = array(
            'title' =>'Login User',
    );
    $this->load->view('v_login_user', $data, FALSE);
    }
    public function logout_user()
    {
        $this->user_login->logout();
    }

}