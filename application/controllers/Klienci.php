<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Klienci extends CI_Controller {
 
    
    private $module_url;
    private $msg;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('buttons');
        $this->load->helper('panel_utils');
        $this->load->helper('input');
        $this->load->library('session');
        $this->load->library('simplelogin');

        /*
         * konfiguracja modułu
         */
        
        $this->module_url = 'klienci';
        $this->msg = array(
             'insert_success'   => 'Użytkownik został dodany'
            ,'edit_success'     => 'Użytkownik został zmieniony'
            ,'delete_success'   => 'Użytkownik został usunięty'
        );
        
        /*
         * sprawdzenie sesji
         */
        
    }

    public function index() {
        $data['list'] = $this->db->query("SELECT id, username FROM users ORDER BY username");
        
        $data['msg'] = isset($_GET['msg']) ? $this->msg[$_GET['msg']] : '';
        $data['msg_css'] = (isset($_GET['msg']) && strlen($_GET['msg'])) ? $_GET['css'] : '';
        $data['url'] = $this->module_url;
        
        $this->load->view($this->module_url.'/list', $data);
    }//function
    
    public function edycja($id) {
        $query = $this->db->query("SELECT username, password as old_password FROM users WHERE id='$id'");
        $row = $query->result_array();
        
        if (!count($row)) {
            $row = array(0=>array('username'=>'', 'old_password'=>''));
        }
        
        $data = array_merge($row[0], array('id'=>$id, 'url'=>$this->module_url));
        $this->load->view($this->module_url.'/edit', $data);
    }//edycja()
    
    public function save() {
        if ($_POST['id'] > 0) {
            $data = array(
               'username' => $_POST['username'],
            );
            
            if (strlen($_POST['password']))  {
                $data['password'] = $_POST['password'];
            }
            
            $this->db->where('id', $_POST['id']);
            $this->db->update('users', $data); 
            $msg = 'edit_success';
        }
        else {
            $this->db->insert('users', $_POST);
            $msg = 'insert_success';
        }
        
        redirect($this->module_url.'/?msg='.$msg.'&css=ms');
    }//save()
    
    public function usun($id) {
        $this->db->query("DELETE FROM users WHERE id='$id' LIMIT 1 ");
        
        redirect($this->module_url.'/?msg=delete_success&css=ms');
    }//usun()
    
    
}
