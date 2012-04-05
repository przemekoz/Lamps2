<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Home extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->helper('input');
	}

	public function index() {
		$this->load->view('home');
	}
	
	public function contact() {
		$this->load->view('contact');
	}
	
	public function panel_instr() {
		$data = array('url'=>'http://44soft.vipserv.org/index.php');
		$this->load->view('panel_instruction', $data);
	}
	public function user_instr() {
		$data = array('url'=>'http://44soft.vipserv.org/index.php');
		$this->load->view('user_instruction', $data);
	}

}
