<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tlo extends CI_Controller {

	private $module_url;

	public function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('buttons');
		$this->load->helper('input');
		$this->load->helper('form');
		$this->load->helper('notify');
		$this->load->helper('panel_utils');
		$this->load->library('session');

		/* url do modułu */
		$this->module_url = 'Tlo';

		$this->uploadDir = './uploads/';
		$this->uploadDirRelative = '/uploads/';

		/*
		 * sprawdzenie sesji
		 */

		if($this->session->userdata('logged_in')) {
			//nothing
		} else {
			redirect('/Home/login_page');
		}
	}

	public function index() {
		$this->db->select('id');
		$this->db->order_by('id', 'desc');
		$data['list'] = $this->db->get('background');

		$data['url'] = $this->module_url;

		$data['dir'] = $this->uploadDir;
		$data['dir_relative'] = $this->uploadDirRelative;

		/* jesli jest jakas informacja - wyswietlenie */
		$flashData = $this->session->flashdata('notify');
		if (!empty($flashData)) {
			notify($flashData);
		}

		$data['templateContent'] = $this->load->view($this->module_url.'/list', $data, true);
		$this->load->view('main_panel', $data);
	}//function

	public function save() {
		$this->db->insert('background', array('id'=>null));
		$id = $this->db->insert_id();

		$this->upload('background_'.$id.'.jpg');
		
		//przeskalowanie obrazka
		$this->load->library('image_lib');
		
		$config['image_library'] = 'GD2';
		$config['width'] = 800;
		$config['height'] = 600;
		$config['quality'] = '100%';
		$config['master_dim'] = 'width';
		$config['maintain_ratio'] = TRUE;

		$config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/background_'.$id.'.jpg';
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		
		
		/* ustawienie informacji do wyświetlenia */
		$this->session->set_flashdata('notify', 'Tło zostało dodane');
		
		redirect($this->module_url);
	}//save()

	public function usun($id) {
		$this->db->delete('background', array('id' => $id));

		@unlink($this->uploadDir.'background_'.$id.'.jpg');
		
		/* ustawienie informacji do wyświetlenia */
		$this->session->set_flashdata('notify', 'Tło zostało usunięte');
		
		redirect($this->module_url);
	}//usun()



	function upload($filename='')
	{
		$config['upload_path'] = $this->uploadDir;
		$config['allowed_types'] = 'jpg';
		$config['max_size']	= '2048'; //KB
		$config['max_width']  = '3000';
		$config['max_height']  = '3000';
		$config['overwrite']  = TRUE;
		if (strlen($filename)) {
			$config['file_name']  = $filename;
		}

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			echo $this->upload->display_errors();
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
	}


}
