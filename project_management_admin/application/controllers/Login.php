<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Login_model');
    }

    public function index()
    {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == true) {
            $email = $this->input->post('username');
            $pass = $this->input->post('password');
           
            if ($this->Login_model->validate_user($email, $pass)) {
                // If the user is valid, redirect to the main view
                redirect('home');
            } else {
                
                $this->load->view('admin_login');
            }

        } else {
            // Otherwise show the login screen with an error message.
            $this->load->view('admin_login');
        }

    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}