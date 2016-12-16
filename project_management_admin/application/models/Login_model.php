<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    //var $details;

    function validate_user($email, $password)
    {
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $login = $this->db->get()->result();


        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if (is_array($login) && count($login) > 0) {


            // Set the users details into the $details property of this class
            $details = $login[0];
            // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session($details);
            return true;
        }

        return false;
    }

    public function set_session($details)
    {
        // session->set_userdata is a CodeIgniter function that
        // stores data in a cookie in the user's browser.  Some of the values are built in
        // to CodeIgniter, others are added (like the IP address).  See CodeIgniter's documentation for details.
        $this->session->set_userdata(
            array(
                'id' => $details->id,
                'name' => $details->name,
                'mobile' => $details->mobile,
                'email' => $details->email,
                'designation' => $details->designation,
                'nid' => $details->nid,
                'password' => $details->password,
                'isLoggedIn' => true
            )
        );
    }

    public function change_session_data($id, $details)
    {
        // session->set_userdata is a CodeIgniter function that
        // stores data in a cookie in the user's browser.  Some of the values are built in
        // to CodeIgniter, others are added (like the IP address).  See CodeIgniter's documentation for details.
        $this->session->set_userdata(
            array(
                'id' => $id,
                'name' => $details['name'],
                'mobile' => $details['mobile'],
                'email' => $details['email'],
                'designation' => $details['designation'],
                'nid' => $details['nid'],
                'password' => $details['password'],
                'isLoggedIn' => true
            )
        );
    }

    public function update_profile($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('login', $data);
        $this->change_session_data($id, $data);
    }

    public function get_profile_from_db($id)
    {


    }

    /*CREATE TABLE login (
		id INT(6)  UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        name    TEXT        CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	    email         TEXT        CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	    mobile        TEXT        CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        password      TEXT        CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		designation       TEXT        CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		nid       TEXT        CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        );
*/


}