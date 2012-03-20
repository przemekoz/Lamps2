<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
 
    
    private $module_url;
    private $msg;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
     
    }

    public function login() {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        
        $query = $this->db->query("SELECT 1 FROM users WHERE username='$username' AND password='$password' AND type='$type'");
        
        if ($query->result()) {
            $this->session->set_userdata('logged_in', true);
        } else {
            $this->session->set_userdata('logged_in', false);
        }
    }//login
    
    public function logout() {
        $this->session->set_userdata('logged_in', false);
    }//login    
    
}
