<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oprawy extends CI_Controller {

	public function __construct() {
		parent::__construct();

		/* nazwa tabeli db */
		$this->tablename = 'fitting';
		/* url do modułu */
		$this->module_url = 'Oprawy';
		/* komunikaty */
		$this->msg['edit_success'] 		= 'Oprawa została dodana';
		$this->msg['insert_success'] 	= 'Oprawa została zmieniona';
		$this->msg['delete_success'] 	= 'Oprawa została usunięta';
		
	}
}
