<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Controller_Abstract.php';

class Slupy extends Controller_Abstract {

	public function __construct() {
		parent::__construct();

		/* nazwa tabeli db */
		$this->tablename = 'column';
		/* url do modułu */
		$this->module_url = 'Slupy';
		/* komunikaty */
		$this->msg['edit_success'] 		= 'Kolumna została zmieniona';
		$this->msg['insert_success'] 	= 'Kolumna została dodana';
		$this->msg['delete_success'] 	= 'Kolumna została usunięta';
		
	}

}
