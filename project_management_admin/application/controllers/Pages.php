<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'classes/Project_search.php');

class Pages extends CI_Controller
{
    public $i = 1;
    public $project_search;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('project_model');
        $this->load->library('pagination');
        // $this->output->enable_profiler(TRUE);
        $this->project_search = new Project_search($this);
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        }

    }

    public function index()
    {
        $this->load->view('home');
    }

    public function project()
    {
        $union_pouroshova = urldecode($this->uri->segment(3));
        $economical_year = urldecode($this->uri->segment(4));
        $implementar = urldecode($this->uri->segment(5));
        $sector = urldecode($this->uri->segment(6));


        // echo "<br>Search_Project Called with $union_pouroshova/$economical_year/$implementar/$sector";

        $data['title'] = 'Search Result';

        if ($union_pouroshova == '' && $economical_year == '' && $implementar == '' && $sector == '') {  //come from submit button
            //echo "  All empty";
            $union_pouroshova = $this->input->post('union_pouroshova');
            $economical_year = $this->input->post('economical_year');
            $implementar = $this->input->post('implementar');
            $sector = $this->input->post('sector');
            //echo "<br>From input $union_pouroshova/$economical_year/$implementar/$sector";
        }
        if ($union_pouroshova == '') $union_pouroshova = 'default';
        if ($economical_year == '') $economical_year = 'default';
        if ($implementar == '') $implementar = 'default';
        if ($sector == '') $sector = 'default';

        $args = array();
        $args['union_pouroshova'] = $union_pouroshova;
        $args['economical_year'] = $economical_year;
        $args['sector'] = $sector;
        $args['implementar'] = $implementar;

        //echo "<br>After re evaluate: $union_pouroshova/$economical_year/$implementar/$sector";


        $config = array();
        $config['base_url'] = site_url("pages/search_project/$union_pouroshova/$economical_year/$implementar/$sector/");
        $config['total_rows'] = $this->project_model->search_result_count($args);
        $config['per_page'] = 10;
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

        $data['page'] = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;

        $data['search_result'] = $this->project_model->search_project($config['per_page'], $data['page'], $args);

        $data['links'] = $this->pagination->create_links();


        $this->load->view('project', $data);

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

    public function union_pouroshova_list()
    {
        $this->load->view('template/head');
        $this->load->view('template/header');
        $this->load->view('template/left_nav');
        $this->load->view('add_administrative_area/union_pouroshova_list');
        $this->load->view('template/footer');

    }

    public function edit_union_pouroshova($union_pouroshova)
    {
        $union_pouroshova = urldecode($union_pouroshova);
        $this->form_validation->set_rules('union_pouroshova', 'ইউনিয়ন/পৌরসভা ', 'required');
        if ($this->form_validation->run() == true) {
            $data = array(
                'union_pouroshova' => $this->input->post('union_pouroshova'),
            );
            $this->project_model->edit_union_pouroshova($union_pouroshova, $data);
            redirect(base_url() . 'index.php/pages/union_pouroshova_list');
        } else {
            $data = array(
                'action' => site_url('pages/edit_union_pouroshova') . "/$union_pouroshova",
                'union_pouroshova' => $union_pouroshova
            );
            $this->load->view('edit_union_pouroshova', $data);
        }

    }

    public function edit_word($union_pouroshova, $word)
    {
        $union_pouroshova = urldecode($union_pouroshova);
        $word = urldecode($word);
        $this->form_validation->set_rules('union_pouroshova', 'ইউনিয়ন/পৌরসভা ', 'required');
        if ($this->form_validation->run() == true) {
            $data = array(
                'union_pouroshova' => $this->input->post('union_pouroshova'),
                'word' => $this->input->post('word'),
            );
            $this->project_model->edit_word($union_pouroshova, $word, $data);
            redirect(base_url() . 'index.php/pages/word_list');
        } else {
            $data = array(
                'action' => site_url('pages/edit_word') . "/$union_pouroshova/$word",
                'union_pouroshova' => $union_pouroshova,
                'word' => $word
            );
            $this->load->view('edit_word', $data);
        }

    }

    public function edit_implementar($implementar)
    {
        $implementar = urldecode($implementar);
        $this->form_validation->set_rules('implementar', 'বাস্তবায়নকারী ', 'required');
        if ($this->form_validation->run() == true) {
            $data = array(
                'implementar' => $this->input->post('implementar'),
            );
            $this->project_model->edit_implementar($implementar, $data);
            redirect(base_url() . 'index.php/pages/implementar_list');
        } else {
            $data = array(
                'action' => site_url('pages/edit_implementar') . "/$implementar",
                'implementar' => $implementar
            );
            $this->load->view('edit_implementar', $data);
        }

    }

    public function edit_sector($sector)
    {
        $sector = urldecode($sector);
        $this->form_validation->set_rules('sector', 'খাত ', 'required');
        if ($this->form_validation->run() == true) {
            $data = array(
                'sector' => $this->input->post('sector'),
            );
            $this->project_model->edit_sector($sector, $data);
            redirect(base_url() . 'index.php/pages/sector_list');
        } else {
            $data = array(
                'action' => site_url('pages/edit_sector') . "/$sector",
                'sector' => $sector
            );
            $this->load->view('edit_sector', $data);
        }

    }

    public function delete_union_pouroshova($union_pouroshova)
    {
        $union_pouroshova = urldecode($union_pouroshova);
        $this->project_model->delete_union_pouroshova($union_pouroshova);
        redirect(base_url() . 'index.php/pages/union_pouroshova_list');
    }

    public function delete_word($union_pouroshova, $word)
    {
        $union_pouroshova = urldecode($union_pouroshova);
        $word = urldecode($word);
        $this->project_model->delete_word($union_pouroshova, $word);
        redirect(base_url() . 'index.php/pages/word_list');
    }

    public function delete_implementar($implementar)
    {
        $implementar = urldecode($implementar);
        $this->project_model->delete_implementar($implementar);
        redirect(base_url() . 'index.php/pages/implementar_list');
    }

    public function delete_sector($sector)
    {
        $sector = urldecode($sector);
        $this->project_model->delete_sector($sector);
        redirect(base_url() . 'index.php/pages/sector_list');
    }

    public function word_list()
    {
        $this->load->view('template/head');
        $this->load->view('template/header');
        $this->load->view('template/left_nav');
        $this->load->view('add_administrative_area/word_list');
        $this->load->view('template/footer');
    }

    public function implementar_list()
    {
       $this->load->view('template/head');
        $this->load->view('template/header');
        $this->load->view('template/left_nav');
        $this->load->view('add_implementary_panel/implementar_list');
        $this->load->view('template/footer');
    }

    public function sector_list()
    {
        $this->load->view('template/head');
        $this->load->view('template/header');
        $this->load->view('template/left_nav');
        $this->load->view('add_sector/sector_list');
        $this->load->view('template/footer');
    }

    public function add_sector()
    {
        $this->form_validation->set_rules('sector', 'খাত', 'required');

        if ($this->form_validation->run() == true) {
            $sector = $this->input->post('sector');
            $this->project_model->insert_sector($sector);
            redirect('pages/add_sector');
        } else {
            $this->load->view('add_sectors');
        }
    }

    public function add_implementary_panel()
    {
        $this->form_validation->set_rules('implementar', 'বাস্তবায়নকারি কর্তৃপক্ষ', 'required');

        if ($this->form_validation->run() == true) {
            $implementar = $this->input->post('implementar');
            $this->project_model->insert_implementar($implementar);
            redirect('pages/add_implementary_panel');
        } else {
            $this->load->view('add_implementary_panel');
        }
    }

    public function do_upload1()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';

        //  $config['max_size']	= '1000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';


        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('project_photo2')) {

            // $error = array('error' => $this->upload->display_errors());

        } else {

            $data = array('upload_data' => $this->upload->data());

            $_POST['project_photo2'] =  $data['upload_data']['file_name'];

            // echo  $_POST['project_photo'];

            // die();

            // $photo = $data['project_photo'];
        }
}

    public function do_upload()
    {

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';

        //  $config['max_size']	= '1000';
        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';


        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('project_photo')) {

           // $error = array('error' => $this->upload->display_errors());

        } else {

            $data = array('upload_data' => $this->upload->data());

            $_POST['project_photo'] =  $data['upload_data']['file_name'];

           // echo  $_POST['project_photo'];

           // die();

          // $photo = $data['project_photo'];
        }
    }

    public function create_new_project()
    {
        $this->do_upload();
        $this->do_upload1();

        $this->form_validation->set_rules('project_name', 'প্রকল্পের নাম ', 'required');
        $this->form_validation->set_rules('executive_authority', 'বাস্তবায়নকারী কর্তৃপক্ষ ', 'required');
        $this->form_validation->set_rules('sector', 'খাত   ', 'required');
        $this->form_validation->set_rules('economical_year', 'অর্থ বছর  ', 'required');


        if ($this->form_validation->run() == true) {
            $union_pouroshova = $this->input->post('union_pouroshova');
            $word = $this->input->post('word');
            $administration_table_reference = $this->project_model->get_administration_table_reference($union_pouroshova, $word);
            if ($administration_table_reference == null) {
                echo "No such administration area found<br>";
            } else {
                $data = array(
                    'project_name' => $this->input->post('project_name'),
                    'alloted_taka' => $this->input->post('alloted_taka'),
                    'alloted_food' => $this->input->post('alloted_food'),
                    'executive_authority' => $this->input->post('executive_authority'),
                    'sector' => $this->input->post('sector'),
                    'rate' => $this->input->post('rate'),
                    'economical_year' => $this->input->post('economical_year'),
                    'administrative_area_reference' => $administration_table_reference,
                    'project_photo' => $this->input->post('project_photo'),
                    'project_photo2' => $this->input->post('project_photo2')
                );

                $this->project_model->insert_project($data);
                $this->session->set_flashdata('message', "<p>project added successfully.</p>");

                $this->project_model->insert_implementar($this->input->post('executive_authority'));
                $this->project_model->insert_sector($this->input->post('sector'));

                redirect('home');
            }
        } else {
            $data = array(
                'action' => site_url('pages/create_new_project') . '/',
                'project' => array('union_pouroshova' => '', 'word' => '', 'project_name' => '', 'alloted_taka' => '', 'alloted_food' => '', 'executive_authority' => '', 'sector' => '', 'rate' => '', 'economical_year' => '')
            );

            $this->load->view('create_new_project', $data);
        }
    }

    public function search_project()
    {

        $union_pouroshova = urldecode($this->uri->segment(3));
        $economical_year = urldecode($this->uri->segment(4));
        $implementar = urldecode($this->uri->segment(5));
        $sector = urldecode($this->uri->segment(6));


        // echo "<br>Search_Project Called with $union_pouroshova/$economical_year/$implementar/$sector";

        $data['title'] = 'Search Result';

        if ($union_pouroshova == '' && $economical_year == '' && $implementar == '' && $sector == '') {  //come from submit button
            //echo "  All empty";
            $union_pouroshova = $this->input->post('union_pouroshova');
            $economical_year = $this->input->post('economical_year');
            $implementar = $this->input->post('implementar');
            $sector = $this->input->post('sector');
            //echo "<br>From input $union_pouroshova/$economical_year/$implementar/$sector";
        }
        if ($union_pouroshova == '') $union_pouroshova = 'default';
        if ($economical_year == '') $economical_year = 'default';
        if ($implementar == '') $implementar = 'default';
        if ($sector == '') $sector = 'default';

        $args = array();
        $args['union_pouroshova'] = $union_pouroshova;
        $args['economical_year'] = $economical_year;
        $args['sector'] = $sector;
        $args['implementar'] = $implementar;

        //echo "<br>After re evaluate: $union_pouroshova/$economical_year/$implementar/$sector";


        $config = array();
        $config['base_url'] = site_url("pages/search_project/$union_pouroshova/$economical_year/$implementar/$sector/");
        $config['total_rows'] = $this->project_model->search_result_count($args);
        $config['per_page'] = 10;
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

        $data['page'] = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;

        $data['search_result'] = $this->project_model->search_project($config['per_page'], $data['page'], $args);

        $data['links'] = $this->pagination->create_links();


        $this->load->view('search', $data);

    }

    public function search_by_union_pouroshova()
    {
        $value = urldecode($this->uri->segment(3));
        $this->project_search->search('union_pouroshova', $value);
    }

    public function search_by_implementar()
    {
        $value = urldecode($this->uri->segment(3));
        $this->project_search->search('implementar', $value);
    }

    public function search_by_sector()
    {
        $value = urldecode($this->uri->segment(3));
        $this->project_search->search('sector', $value);
    }

    public function search_by_economical_year()
    {
        $value = urldecode($this->uri->segment(3));
        $this->project_search->search('economical_year', $value);
    }

    public function edit_project($project_id)
    {
        $this->do_upload();
        $this->do_upload1();
        $this->form_validation->set_rules('project_name', 'প্রকল্পের নাম ', 'required');
        $this->form_validation->set_rules('executive_authority', 'বাস্তবায়নকারী কর্তৃপক্ষ ', 'required');
        $this->form_validation->set_rules('sector', 'খাত   ', 'required');
        $this->form_validation->set_rules('economical_year', 'অর্থ বছর  ', 'required');

        if ($this->form_validation->run() == true) {

            $union_pouroshova = $this->input->post('union_pouroshova');
            $word = $this->input->post('word');

            $administration_table_reference = $this->project_model->get_administration_table_reference($union_pouroshova, $word);
            if ($administration_table_reference == null) {
                echo "No such administration area found<br>";
            } else {
                $data = array(
                    'project_name' => $this->input->post('project_name'),
                    'alloted_taka' => $this->input->post('alloted_taka'),
                    'alloted_food' => $this->input->post('alloted_food'),
                    'executive_authority' => $this->input->post('executive_authority'),
                    'sector' => $this->input->post('sector'),
                    'rate' => $this->input->post('rate'),
                    'economical_year' => $this->input->post('economical_year'),
                    'administrative_area_reference' => $administration_table_reference,
                    // 'project_photo' => $data['file_name']
                    'project_photo' => $this->input->post('project_photo'),
                    'project_photo2' => $this->input->post('project_photo2')
                );

                $this->project_model->update_project($project_id, $data);
                $this->session->set_flashdata('message', "<p>project added successfully.</p>");

                $this->project_model->insert_implementar($this->input->post('executive_authority'));
                $this->project_model->insert_sector($this->input->post('sector'));

                redirect(base_url() . 'index.php/pages/search_project');
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
        $union_pouroshova = urldecode($union_pouroshova);
        $subjects = $this->db->get_where('administrative_area', array('union_pouroshova' => $union_pouroshova))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['word'] . '">' . $row['word'] . '</option>';
        }
    }

    public function union_autocomplete()
    {

        $keyword = $this->input->post('term');
        $this->db->select('union_pouroshova');
        $this->db->distinct();
        $this->db->order_by('id', 'DESC');
        $this->db->like('union_pouroshova', $keyword);
        $result = $this->db->get('administrative_area')->result();
        $data['response'] = 'false';
        if (!empty($result)) {
            $data['response'] = 'true';
            foreach ($result as $row) {
                $data['message'][] = $row->union_pouroshova;
            }
        }

        echo json_encode($data); //echo json string if ajax request

    }

    public function word_autocomplete()
    {

        $keyword = $this->input->post('term');
        $this->db->select('word');
        $this->db->distinct();
        $this->db->like('word', $keyword);
        $result = $this->db->get('administrative_area')->result();
        $data['response'] = 'false';
        if (!empty($result)) {
            $data['response'] = 'true';
            foreach ($result as $row) {
                $data['message'][] = $row->word;
            }
        }
        echo json_encode($data); //echo json string if ajax request
    }

    public function executive_authority_autocomplete()
    {
        $keyword = $this->input->post('term');
        $this->db->select('implementar');
        $this->db->distinct();
        $this->db->like('implementar', $keyword);
        $result = $this->db->get('implementar_table')->result();
        $data['response'] = 'false';
        if (!empty($result)) {
            $data['response'] = 'true';
            foreach ($result as $row) {
                $data['message'][] = $row->implementar;
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
        $result = $this->db->get('sector_table')->result();
        $data['response'] = 'false';
        if (!empty($result)) {
            $data['response'] = 'true';
            foreach ($result as $row) {
                $data['message'][] = $row->sector;
            }
        }
        echo json_encode($data); //echo json string if ajax request
    }

}