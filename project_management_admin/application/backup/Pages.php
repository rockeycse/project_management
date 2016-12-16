<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public $i=1;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('project_model');
        $this->load->library('pagination');
       // $this->output->enable_profiler(TRUE);
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }
    }

    public function index()
    {

        $this->load->view('home');

    }



    function login_user()
    {
        // Create an instance of the user model
        $this->load->model('user_m');

        // Grab the email and password from the form POST
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        //Ensure values exist for email and pass, and validate the user's credentials
        if ($email && $pass && $this->user_m->validate_user($email, $pass)) {
            // If the user is valid, redirect to the main view
            redirect('/main/show_main');
        } else {
            // Otherwise show the login screen with an error message.
            $this->show_login(true);
        }
    }


    public function add_administrative_area()
    {
        $this->form_validation->set_rules('union_pouroshova', 'Union/Pouroshova', 'required');
        $this->form_validation->set_rules('word', 'Word ', 'required');
        if ($this->form_validation->run() == true) {
            $union_pouroshova = $this->input->post('union_pouroshova');
            $word = $this->input->post('word');
            $administration_table_reference = $this->project_model->get_administration_table_reference($union_pouroshova, $word);
            if ($administration_table_reference != null)
                echo "Already exists in row $administration_table_reference";
            else {
                $data = array(

                    'union_pouroshova' => $this->input->post('union_pouroshova'),
                    'word' => $this->input->post('word'),

                );

                $this->project_model->insert_administrative_area($data);
                $this->session->set_flashdata('message', "<p>Union/Pouroshova added successfully.</p>");

               //redirect('home');
               $this->load->view('add_administrative_area');
            }
        } else {
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            $this->load->view('add_administrative_area', $this->data);
        }

    }

    public function add_sector()
    {
        $this->form_validation->set_rules('sector', 'খাত', 'required');
        if ($this->form_validation->run() == true) {
            $data = array(
                'sector' => $this->input->post('sector'),
            );
            $this->project_model->add_sector($data);
            redirect('pages/add_sector');
        }
        else {
            $this->load->view('add_sectors');
        }
    }
    public function add_implementary_panel()
    {
        $this->form_validation->set_rules('implementar', 'বাস্তবায়নকারি কর্তৃপক্ষ', 'required');
        if ($this->form_validation->run() == true) {
            $data = array(
                'implementar' => $this->input->post('implementar'),
            );
            $this->project_model->add_implementary_panel($data);
            redirect('pages/add_implementary_panel');
        }
        else {
            $this->load->view('add_implementary_panel');
        }
    }


    public function create_new_project()
    {

        //validate form input

        $this->form_validation->set_rules('project_name', 'প্রকল্পের নাম ', 'required');
        $this->form_validation->set_rules('executive_authority', 'বাস্তবায়নকারী কর্তৃপক্ষ ', 'required');
        $this->form_validation->set_rules('sector', 'খাত   ', 'required');
        $this->form_validation->set_rules('economical_year', 'অর্থ বছর  ', 'required');


        if ($this->form_validation->run() == true) {
            $union_pouroshova = $this->input->post('union_pouroshova');
            $word = $this->input->post('word');
            echo "union_pouroshova:$union_pouroshova word: $word<br>";
            $administration_table_reference = $this->project_model->get_administration_table_reference($union_pouroshova, $word);
            if ($administration_table_reference == null) {
                echo "No such administration area found<br>";
                echo "<script type='text/javascript'>console.log('No such administration area found');</script>";
            } else {
                $data = array(
                    'project_name' => $this->input->post('project_name'),
                    'alloted_taka' => $this->input->post('alloted_taka'),
                    'alloted_food' => $this->input->post('alloted_food'),
                    'executive_authority' => $this->input->post('executive_authority'),
                    'sector' => $this->input->post('sector'),
                    'rate' => $this->input->post('rate'),
                    'economical_year' => $this->input->post('economical_year'),
                    'administrative_area_reference' => $administration_table_reference
                );

                $this->project_model->insert_project($data);
                $this->session->set_flashdata('message', "<p>project added successfully.</p>");
                redirect('home');
            }
        } else {
            $data = array(
                'action' => site_url('pages/create_new_project') . '/',
                'project' => array('union_pouroshova'=>'','word'=>'','project_name' => '', 'alloted_taka' => '', 'alloted_food' => '', 'executive_authority' => '', 'sector' => '', 'rate' => '', 'economical_year' => '')
            );

            $this->load->view('create_new_project', $data);
        }
    }

    public function search_project()
    {

        $union_pouroshova = urldecode( $this->uri->segment(3));
        $economical_year  = urldecode($this->uri->segment(4));
        $implementar      = urldecode($this->uri->segment(5));
        $sector           = urldecode($this->uri->segment(6));


       // echo "<br>Search_Project Called with $union_pouroshova/$economical_year/$implementar/$sector";

        $data['title'] = 'Search Result';

        if( $union_pouroshova ==''&&$economical_year == ''&&$implementar ==''&&$sector =='') {  //come from submit button
            //echo "  All empty";
            $union_pouroshova =  $this->input->post('union_pouroshova');
            $economical_year  =  $this->input->post('economical_year');
            $implementar      =  $this->input->post('implementar');
            $sector           =  $this->input->post('sector');
           // echo "<br>From input $union_pouroshova/$economical_year/$implementar/$sector";
        }
        if ($union_pouroshova =='')$union_pouroshova='default';
        if ($economical_year=='')$economical_year='default';
        if ($implementar =='')$implementar='default';
        if ($sector =='')$sector='default';

        //echo "<br>After re evaluate: $union_pouroshova/$economical_year/$implementar/$sector";



        $config = array();
        $config['base_url']    =  site_url("pages/search_project/$union_pouroshova/$economical_year/$implementar/$sector/");
        $config['total_rows']  = $this->project_model->search_result_count($union_pouroshova, $economical_year, $implementar,$sector);
        $config['per_page']    = 5;
        $config['uri_segment'] = 7;


        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment( $config['uri_segment'])) ? $this->uri->segment( $config['uri_segment']) : 0;

        $data['search_result'] = $this->project_model->search_project($config['per_page'], $data['page'],$union_pouroshova, $economical_year, $implementar,$sector);

        $data['links'] = $this->pagination->create_links();


        $this->load->view('search',$data);

    }


    public function edit_project($project_id)
    {
        $this->form_validation->set_rules('project_name', 'প্রকল্পের নাম ', 'required');
        $this->form_validation->set_rules('executive_authority', 'বাস্তবায়নকারী কর্তৃপক্ষ ', 'required');
        $this->form_validation->set_rules('sector', 'খাত   ', 'required');
        $this->form_validation->set_rules('economical_year', 'অর্থ বছর  ', 'required');

        if ($this->form_validation->run() == true) {

            $union_pouroshova = $this->input->post('union_pouroshova');
            $word = $this->input->post('word');
            echo "union_pouroshova:$union_pouroshova word: $word<br>";
            $administration_table_reference = $this->project_model->get_administration_table_reference($union_pouroshova, $word);
            if ($administration_table_reference == null) {
                echo "No such administration area found<br>";
                echo "<script type='text/javascript'>console.log('No such administration area found');</script>";
            } else {
                echo "<script type='text/javascript'>console.log('Inserting new project');</script>";
                $data = array(
                    'project_name' => $this->input->post('project_name'),
                    'alloted_taka' => $this->input->post('alloted_taka'),
                    'alloted_food' => $this->input->post('alloted_food'),
                    'executive_authority' => $this->input->post('executive_authority'),
                    'sector' => $this->input->post('sector'),
                    'rate' => $this->input->post('rate'),
                    'economical_year' => $this->input->post('economical_year'),
                    'administrative_area_reference' => $administration_table_reference
                );

                $this->project_model->update_project($project_id,$data);
                $this->session->set_flashdata('message', "<p>project added successfully.</p>");

                redirect(base_url().'index.php/pages/search_project');
            }

        } else {
            $project = $this->project_model->get_project($project_id);

            $data = array(
                'action' => site_url('pages/edit_project') . '/' . $project_id,
                'project' => $project
            );

            $this->load->view('create_new_project', $data);
        }
    }

    public function delete_project($project_id)
    {
        $this->project_model->delete_project($project_id);
        redirect(base_url() . 'index.php/pages/search_project');
    }


    function get_words_by_union($union_pouroshova)
    {
        $union_pouroshova=urldecode($union_pouroshova);
        $subjects = $this->db->get_where('administrative_area' , array('union_pouroshova' => $union_pouroshova))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['word'] . '">' . $row['word'] . '</option>';
        }
    }

    public function union_autocomplete(){

        $keyword = $this->input->post('term');
        $this->db->select('union_pouroshova');
        $this->db->distinct();
        $this->db->order_by('id', 'DESC');
        $this->db->like('union_pouroshova', $keyword);
        $result= $this->db->get('administrative_area')->result();
        $data['response'] ='false';
        if( ! empty($result) )
        {
            $data['response'] ='true';
            foreach($result as $row) {
                $data['message'][] = $row->union_pouroshova;
            }
        }

        echo json_encode($data); //echo json string if ajax request

    }

    public function word_autocomplete(){

        $keyword = $this->input->post('term');
        $this->db->select('word');
        $this->db->distinct();
        $this->db->like('word', $keyword);
        $result= $this->db->get('administrative_area')->result();
        $data['response'] ='false';
        if( ! empty($result) )
        {
            $data['response'] ='true';
            foreach($result as $row) {
                $data['message'][] = $row->word;
            }
        }


        echo json_encode($data); //echo json string if ajax request

    }

    public function executive_authority_autocomplete()
    {


        $keyword = $this->input->post('term');
        $this->db->select('executive_authority');
        $this->db->distinct();
        $this->db->like('executive_authority', $keyword);
        $result = $this->db->get('projects')->result();
        $data['response'] ='false';
        if( ! empty($result) )
        {
            $data['response'] ='true';
            foreach($result as $row) {
                $data['message'][] = $row->executive_authority;
            }
        }
        echo json_encode($data); //echo json string if ajax request


    }

    public function sector_autocomplete()
    {

        $keyword = $this->input->post('term');
        $this->db->select('sector');
        $this->db->distinct();
        $this->db->like('sector', $keyword);
        $result= $this->db->get('projects')->result();
        $data['response'] ='false';
        if( ! empty($result) )
        {
            $data['response'] ='true';
            foreach($result as $row) {
                $data['message'][] = $row->sector;
            }
        }

        echo json_encode($data); //echo json string if ajax request


    }




}