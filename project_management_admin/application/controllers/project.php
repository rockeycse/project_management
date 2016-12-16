<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'classes/Project_search.php');

class Project extends CI_Controller
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
        $config['base_url'] = site_url("project/search_project/$union_pouroshova/$economical_year/$implementar/$sector/");
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