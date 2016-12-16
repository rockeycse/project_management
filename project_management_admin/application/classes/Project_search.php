<?php

/**
 * Created by PhpStorm.
 * User: Swotsystem
 * Date: 25-Mar-16
 * Time: 4:17 PM
 */
class Project_search
{
    private $controller;

    public function __construct($controller)
    {
        $this->controller=$controller;
    }
    public function search($search_item,$search_value='')
    {
        $data['title'] = 'Search by '.$search_item;

        if( $search_value =='') {  //come from submit button
            $search_value =   $this->controller->input->post($search_item);
        }

        $args=array();
        $args['union_pouroshova']='default';
        $args['economical_year']='default';
        $args['sector']='default';
        $args['implementar']='default';
        $args[$search_item]=$search_value;

        $config = array();
        $config['base_url']    =  site_url("pages/search_by_$search_item/$search_value/");
        $config['total_rows']  =  $this->controller->project_model->search_result_count($args);
        $config['per_page']    = 10;
        $config['uri_segment'] = 4;


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
        $this->controller->pagination->initialize($config);

        $data['page'] = ( $this->controller->uri->segment( $config['uri_segment'])) ?  $this->controller->uri->segment( $config['uri_segment']) : 0;

        $data['search_result'] =  $this->controller->project_model->search_project($config['per_page'], $data['page'],$args);

        $data['links'] =  $this->controller->pagination->create_links();

        $search_page="search_by_".$search_item;
        $this->controller->load->view($search_page,$data);


    }

}