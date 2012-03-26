<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oprawy extends CI_Controller {


	private $module_url;
	private $msg;
	private $uploadDir;
	private $uploadDirRelative;

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('buttons');
		$this->load->helper('form');
		$this->load->helper('input');
		$this->load->helper('panel_utils');
		$this->load->library('session');

		/*
		 * konfiguracja modułu
		 */

		$this->module_url = 'oprawy';
		$this->uploadDir = './uploads/';
		$this->uploadDirRelative = '/uploads/';
		$this->msg = array(
             'insert_success'   => 'Oprawa została dodana'
             ,'edit_success'     => 'Oprawa została zmieniona'
             ,'delete_success'   => 'Oprawa została usunięta'
             );

             /*
              * sprawdzenie sesji
              */

            if($this->session->userdata('logged_in')) {
            echo '<div style="height:32px"><img src="/img/user_blue.png" width="32" height="32" style="float:left"> <div style="float:left;color:#162080;font-weight:bold;padding:8px 0 0 5px">'.$this->session->userdata('username').'</div><div style="clear:both"></div></div>';
        } else {
            redirect('/Home/login_page');
        } 
	}

	public function index() {
		$this->db->select('id, title, street, garden');
		$this->db->order_by('title');
		$data['list'] = $this->db->get('fitting');

		$data['msg'] = isset($_GET['msg']) ? $this->msg[$_GET['msg']] : '';
		$data['msg_css'] = (isset($_GET['msg']) && strlen($_GET['msg'])) ? $_GET['css'] : '';
		$data['url'] = $this->module_url;

		$data['dir'] = $this->uploadDir;
		$data['dir_relative'] = $this->uploadDirRelative;

		$this->load->view($this->module_url.'/list', $data);
	}//function

	public function edycja($id) {
		$this->db->select('title, description, street, garden');
		$query = $this->db->get_where('fitting', array('id' => $id));
		$row = $query->result_array();

		if (!count($row)) {
			$row = array(0=>array('title'=>'', 'description'=>'', 'garden'=>0, 'street'=>0));
		}



		$data = array_merge($row[0], array('id'=>$id, 'url'=>$this->module_url, 'dir'=>$this->uploadDir, 'dir_relative'=>$this->uploadDirRelative));
		$this->load->view($this->module_url.'/edit', $data);
	}//edycja()

	public function save() {
		$id = $_POST['id'];
		if ($id > 0) {
			$data = array(
				'title' => $_POST['title']
				,'description' => $_POST['description']
				,'street' => $_POST['street']
				,'garden' => $_POST['garden']
			);

			$this->db->where('id', $id);
			$this->db->update('fitting', $data);
			$msg = 'edit_success';
		}
		else {
			$this->db->insert('fitting', $_POST);
			$id = $this->db->insert_id();
			$msg = 'insert_success';
		}

		$this->upload('fitting_'.$id.'.png');
		redirect($this->module_url.'/?msg='.$msg.'&css=ms');
	}//save()

	public function usun($id) {
		$this->db->delete('fitting', array('id' => $id));

		@unlink($this->uploadDir.'fitting_'.$id.'.png');
		redirect($this->module_url.'/?msg=delete_success&css=ms');
	}//usun()



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
			$error = array('error' => $this->upload->display_errors());
			echo $this->upload->display_errors();
			print_r( $this->upload->data() );
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			print_r( $this->upload->data() );
		}
	}


}
