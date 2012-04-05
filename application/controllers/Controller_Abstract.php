<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_Abstract extends CI_Controller {


	protected $tablename;
	protected $module_url;
	protected $msg;
	protected $uploadDir;
	protected $uploadDirRelative;

	public function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('buttons');
		$this->load->helper('input');
		$this->load->helper('notify');
		$this->load->helper('form');
		$this->load->helper('panel_utils');
		$this->load->library('session');

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
		$this->db->select('id, title, street, garden, width, height');
		$this->db->order_by('title');
		$data['list'] = $this->db->get($this->tablename);

		/* jesli jest jakas informacja - wyswietlenie */
		$flashDataId = $this->session->flashdata('notify');
		if (!empty($this->msg[$flashDataId])) {
			notify($this->msg[$flashDataId]);		
		}
		
		$data['url'] = $this->module_url;

		$data['dir'] = $this->uploadDir;
		$data['dir_relative'] = $this->uploadDirRelative;

		//$this->load->view($this->module_url.'/list', $data);
		
		$data['templateContent'] = $this->load->view($this->module_url.'/list', $data, true);
		$this->load->view('main_panel', $data);
	}//function

	
	
	public function edycja($id) {
		$this->db->select('title, description, street, garden, width, height, mode');
		$query = $this->db->get_where($this->tablename, array('id' => $id));

		$row = $query->result_array();

		if (!count($row)) {
			$row = array(0=>array('title'=>'', 'description'=>'', 'garden'=>0, 'street'=>0, 'width'=>0, 'height'=>0, 'mode'=>'stand'));
		}



		$data = array_merge($row[0], array('id'=>$id, 'url'=>$this->module_url, 'dir'=>$this->uploadDir, 'dir_relative'=>$this->uploadDirRelative));
		$data['templateContent'] = $this->load->view($this->module_url.'/edit', $data, true);
		$this->load->view('main_panel', $data);
	}//edycja()

	public function save() {
		$id = $_POST['id'];
		if ($id > 0) {
			/*
			$data = array(
         'title' => $_POST['title']
			,'description' => $_POST['description']
			,'street' => $_POST['street']
			,'garden' => $_POST['garden']
			);
*/
			$this->db->where('id', $id);
			$this->db->update($this->tablename, $_POST);
			$msg = 'edit_success';
		}
		else {
			$this->db->insert($this->tablename, $_POST);
			$id = $this->db->insert_id();
			$msg = 'insert_success';
		}

		/* jesli zostal wrzucony plik*/
		if ($this->upload($this->tablename.'_'.$id.'.png') ) {
			/* odczytanie wymoiarów obrazka */
			list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->tablename.'_'.$id.'.png');
			
			/* odczytanie jego wymiarów i zapisanie do rekordu */
			$this->db->update($this->tablename, array('width'=>$width, 'height'=>$height), array('id' => $id));
		}
		
		/* ustawienie informacji do wyświetlenia */
		$this->session->set_flashdata('notify', $msg);
		
		redirect($this->module_url);
	}//save()

	public function usun($id) {
		$this->db->delete($this->tablename, array('id' => $id));

		@unlink($this->uploadDir.$this->tablename.'_'.$id.'.png');
		
		/* ustawienie informacji do wyświetlenia */
		$this->session->set_flashdata('notify', 'delete_success');
		
		redirect($this->module_url);
	}//usun()



	/**
	 * 
	 * Uploaduje plik
	 * @param string $filename - nazwa pliku
	 * @return boolean - true w momencie gdy zostal wrzucony plik
	 */
	function upload($filename='')
	{
		$config['upload_path'] = $this->uploadDir;
		$config['allowed_types'] = 'png';
		$config['max_size']	= '2048'; //KB
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
		$config['overwrite']  = TRUE;
		if (strlen($filename)) {
			$config['file_name']  = $filename;
		}

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('file'))
		{
			//$error = array('error' => $this->upload->display_errors());
			//echo $this->upload->display_errors();
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return true;
		}
	}


}
