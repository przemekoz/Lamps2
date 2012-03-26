<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->helper('input');
		$this->load->helper('url');
		$this->load->helper('buttons');
		$this->load->helper('panel_utils');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('simplelogin');

	}

	public function index() {
		$this->load->view('home');
	}

	public function contact() {
		$this->load->view('contact');
	}

	public function panel_instr() {
		$data = array('url'=>'http://mss/index.php');
		$this->load->view('panel_instruction', $data);
	}
	public function user_instr() {
		$data = array('url'=>'http://mss/index.php');
		$this->load->view('user_instruction', $data);
	}

	public function login() {
		$login = new Simplelogin();
		if ($login->login($this->input->post('username'),$this->input->post('password'), 'admin')) {
			// -- OK --
			redirect('/Slupy/');
		}
		else {
			// -- FAIL --
			redirect('/Home/login_page?fail=1');
		}
	}

	public function logout() {
		$login = new Simplelogin();
		$login->logout();
		redirect('/Home/logout_page');
	}

	public function login_page() {
		$fail = $this->input->get('fail');
		$data['msg'] = !empty($fail) ? 'Blad: bledna nazwa uzytkownika lub hasla' : '';
		$this->load->view('login_page', $data);
	}

	public function logout_page() {
		$this->load->view('logout_page');
	}

}
