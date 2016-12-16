<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    function get_all()
    {
        $this->db->select('*');
        $query = $this->db->get('projects');
        return $query->result_array();
    }


    public function search_result_count($args)
    {
        $union_poroshova=$args['union_pouroshova'];
        $year=$args['economical_year'];
        $implementar=$args['implementar'];
        $sector=$args['sector'];

        $this->db->select('id');
        $this->db->from('administrative_area');
        $this->db->where('union_pouroshova', $union_poroshova);
        $sub_query = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->from('projects');
        if ($year != 'default') $this->db->where('economical_year', $year);
        if ($implementar != 'default') $this->db->where('executive_authority', $implementar);
        if ($sector != 'default') $this->db->where('sector', $sector);
        if ($union_poroshova != 'default')$this->db->where("administrative_area_reference IN ($sub_query)");
        $query = $this->db->get();
        return $query->num_rows();

    }

    public function search_project($limit,$start,$args)
    {
        $union_poroshova=$args['union_pouroshova'];
        $year=$args['economical_year'];
        $implementar=$args['implementar'];
        $sector=$args['sector'];

        $this->db->select('id');
        $this->db->from('administrative_area');
        $this->db->where('union_pouroshova', $union_poroshova);
        $sub_query = $this->db->get_compiled_select();
        //echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sub Query:$sub_query\n";

        $this->db->select('*');
        $this->db->limit($limit,$start);
        $this->db->from('projects');
        if ($year != 'default') $this->db->where('economical_year', $year);
        if ($implementar != 'default') $this->db->where('executive_authority', $implementar);
        if ($sector != 'default') $this->db->where('sector', $sector);
        if ($union_poroshova != 'default')$this->db->where("administrative_area_reference IN ($sub_query)");
        $compiled_query =  $this->db->get_compiled_select();
       //echo $compiled_query;

        $query = $this->db->query($compiled_query);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

    }

    public function get_all_union_pouroshova()
    {
        $this->db->select('union_pouroshova');
        $this->db->distinct();
        $query = $this->db->get('administrative_area');
        return $query->result();
    }

    public function get_all_word()
    {
        $this->db->select('union_pouroshova,word');
        $this->db->order_by('union_pouroshova','asc');
        $query = $this->db->get('administrative_area');
        return $query->result();
    }

    public function get_union_pouroshova($keyword)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->like("name", $keyword);
        return $this->db->get('administrative_area')->result();
    }

    public function get_words_by_union_pouroshova($union_pouroshova)
    {
        $this->db->select('word');
        $this->db->distinct();
        $this->db->where('union_pouroshova',$union_pouroshova);
        $query = $this->db->get('administrative_area');
        return $query->result();
    }

    public function get_all_budget_year()
    {
        $this->db->select('economical_year');
        $this->db->distinct();
        $query = $this->db->get('projects');
        return $query->result();
    }

    public function get_all_sector()
    {
        $this->db->select('sector');
        $this->db->distinct();
        $query = $this->db->get('sector_table');
        return $query->result();
    }

    public function get_all_implementar()
{
    $this->db->select('implementar');
    $this->db->distinct();
    $query = $this->db->get('implementar_table');
    return $query->result();
}

    public function get_project($project_id)
    {
        $this->db->select('projects.id,project_name,alloted_taka,alloted_food, executive_authority,sector,rate,economical_year,union_pouroshova,word');
        $this->db->from('projects');
        $this->db->where('projects.id', $project_id);

        $this->db->join('administrative_area', 'projects.administrative_area_reference = administrative_area.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_administration_table_reference($union_pouroshova, $word)
    {

        $this->db->select('id');
        $array = array('union_pouroshova' => $union_pouroshova, 'word' => $word);
        $this->db->where($array);
        $query = $this->db->get('administrative_area');
        $result_array=$query->row_array();
        if(isset($result_array)) {
            foreach ($result_array as $result_item) {
                return $result_item;
            }
        }

    }

    public function insert_project($data)
    {

        $this->db->insert('projects', $data);

        $id = $this->db->insert_id();

        return (isset($id)) ? $id : FALSE;
    }

    public function insert_implementar($data)
    {

        $data=urldecode($data);
        $this->db->select('*');
        $this->db->from('implementar_table');
        $this->db->where('implementar',$data);
        $query=$this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->insert('implementar_table',array('implementar' =>$data));
        }

    }

    public function insert_sector($data)
    {

        //$data=urldecode($data);
        $this->db->select('*');
        $this->db->from('sector_table');
        $this->db->where('sector', $data);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->insert('sector_table',array('sector' =>$data));

        }
    }

    public function update_project($project_id, $data)
    {
        $this->db->where('id', $project_id);
        $this->db->update('projects', $data);
    }

    public function edit_union_pouroshova($union_pouroshova, $data)
    {
        echo $union_pouroshova;
        $this->db->where('union_pouroshova', $union_pouroshova);
        $this->db->update('administrative_area', $data);
    }

    public function edit_word($union_pouroshova,$word, $data)
    {
        $this->db->where('union_pouroshova', $union_pouroshova);
        $this->db->where('word', $word);
        $this->db->update('administrative_area', $data);
    }

    public function edit_implementar($implementar, $data)
    {
        $this->db->where('implementar', $implementar);
        $this->db->update('implementar_table', $data);
    }

    public function edit_sector($sector, $data)
    {
        $this->db->where('sector', $sector);
        $this->db->update('sector_table', $data);
    }

    public function delete_union_pouroshova($union_pouroshova)
    {
        $this->db->where('union_pouroshova', $union_pouroshova);
        $this->db->delete('administrative_area');

    }

    public function delete_word($union_pouroshova,$word)
    {

        $this->db->where('union_pouroshova', $union_pouroshova);
        $this->db->where('word', $word);
        $this->db->delete('administrative_area');

    }

    public function delete_implementar($implementar)
    {
        $this->db->where('implementar', $implementar);
        $this->db->delete('implementar_table');
    }

    public function delete_sector($sector)
    {
        $this->db->where('sector', $sector);
        $this->db->delete('sector_table');
    }

    public function delete_project($project_id) 
    {
        $this->db->where('id', $project_id);
        $this->db->delete('projects');

        /*CREATE TABLE projects (
        id INT(6)  UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        project_name  TEXT        CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        alloted_taka TEXT         CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        alloted_food TEXT         CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        executive_authority TEXT  CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        sector TEXT               CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        rate  TEXT                CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        economical_year TEXT      CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        administrative_area_reference INT(6) UNSIGNED NOT NULL
        );


        CREATE TABLE  administrative_area(
        id INT(6)  UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        union_pouroshova TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        word TEXT             CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
        );

        CREATE TABLE  implementar_table(
        id INT(6)  UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        implementar TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
        );

         CREATE TABLE  sector_table(
        id INT(6)  UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        sector TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
        );
        */
    }

    public function insert_administrative_area($data)
    {
        $this->db->insert('administrative_area', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

}