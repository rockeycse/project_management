<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('login_model');
        //$this->output->enable_profiler(TRUE);
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    public function profile()
    {

        $this->form_validation->set_rules('name', 'নাম ', 'required');
        $this->form_validation->set_rules('email', 'ইমেইল আইডি', 'required');
        $this->form_validation->set_rules('password', 'পাসওয়ার্ড', 'required');


        if ($this->form_validation->run() == true) {

            $name = $this->input->post('name');
            $designation = $this->input->post('designation');
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $nid = $this->input->post('nid');
            $password = $this->input->post('password');

            $data = array(
                    'name' =>$name,
                    'designation' =>$designation,
                    'mobile' =>$mobile,
                    'email' => $email,
                    'nid' => $nid,
                    'password' => $password,
                );

            $this->login_model->update_profile($this->session->userdata('id'),$data);

            $session_data=$this->session->all_userdata();
            $data['profile']=$session_data;
            $this->load->view('profile', $data);

        }
        else {
            $session_data=$this->session->all_userdata();
            $data['profile']=$session_data;
            $this->load->view('profile', $data);
        }

    }


    public function upload_picture()
    {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/' . $this->session->userdata['id'] . '.png');//' . $this->session->userdata['id'] . '
       // redirect(base_url() . 'index.php/pages/profile', 'refresh');

    }


}
