<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WyborElementu extends CI_Controller {
    
    private $url;
    private $module_url;
    private $uploadDir;
    private $uploadDirRelative;    
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        /*
         * konfiguracja modułu
         */
        $this->module_url = 'wybor_elementu';
        $this->url = 'wyborelementu';
        $this->uploadDir = './uploads/';
        $this->uploadDirRelative = '/uploads/';
        
        
        /*
         * sprawdzenie sesji
         */
        
        if($this->session->userdata('logged_in')) {
            //echo 'jestes zalogowany';
        } else {
            //echo 'nie jestes zalogowany -> wylot (1)';
        } 
    }

    public function index() {
        
    }//function

    
    public function krok_a() {
        $data['id_column'] = isset($_GET['id_column']) ? intval($_GET['id_column']) : 0;
        $data['url'] = $this->url;
        $data['dir'] = $this->uploadDir; 
        $data['dir_relative'] = $this->uploadDirRelative;        
        
        $data['list'] = $this->db->query("SELECT id, code, title FROM clmn ORDER BY title");
        
        
        $this->load->view($this->module_url.'/krok_a', $data);
    }// krok_a
    
    public function krok_b() {
        $data['id_crown'] = isset($_GET['id_crown']) ? intval($_GET['id_crown']) : 0;
        $data['id_column'] = isset($_GET['id_column']) ? intval($_GET['id_column']) : 0;
        $data['url'] = $this->url;
        $data['dir'] = $this->uploadDir; 
        $data['dir_relative'] = $this->uploadDirRelative;          
        
        $data['list'] = $this->db->query("SELECT id, code, title FROM crown ORDER BY title");
        
        $this->load->view($this->module_url.'/krok_b', $data);
        
    }// krok_b
    
    public function krok_c() {
        $data['id_crown'] = isset($_GET['id_crown']) ? intval($_GET['id_crown']) : 0;
        $data['id_column'] = isset($_GET['id_column']) ? intval($_GET['id_column']) : 0;
        $data['id_fitting'] = isset($_GET['id_fitting']) ? intval($_GET['id_fitting']) : 0;
        $data['url'] = $this->url;
        $data['dir'] = $this->uploadDir; 
        $data['dir_relative'] = $this->uploadDirRelative;          
        
        $data['list'] = $this->db->query("SELECT id, code, title FROM fitting ORDER BY title");
        
        $this->load->view($this->module_url.'/krok_c', $data);
        
    }// krok_c
    
    public function save() {
        $data['id_crown'] = isset($_POST['id_crown']) ? intval($_POST['id_crown']) : 0;
        $data['id_column'] = isset($_POST['id_column']) ? intval($_POST['id_column']) : 0;
        $data['id_fitting'] = isset($_POST['id_fitting']) ? intval($_POST['id_fitting']) : 0;
        
        print_r($data);
        
    }// krok_c
    
    
    public function pdf() {
        require_once dirname(__FILE__).'../../../fpdf/fpdf.php';
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image( dirname(__FILE__).'../../../uploads/test_column_2.png',0,0,0,0);
        $pdf->Output();
    }
    
}
